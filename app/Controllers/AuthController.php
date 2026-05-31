<?php
/**
 * Authentication Controller
 */

namespace App\Controllers;

use App\Models\User;
use App\Helpers\Auth;

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Show login page
     */
    public function showLogin()
    {
        if (Auth::isLoggedIn()) {
            header('Location: /Intergrated-school-mngmnt-sysm/public/dashboard/');
            exit;
        }

        $this->render('auth/login');
    }

    /**
     * Show registration page
     */
    public function showRegister()
    {
        if (Auth::isLoggedIn()) {
            header('Location: /Intergrated-school-mngmnt-sysm/public/dashboard/');
            exit;
        }

        $this->render('auth/register');
    }

    /**
     * Handle login
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die('Method not allowed');
        }

        // Validate CSRF
        if (!Auth::validateCSRFToken($_POST['csrf_token'] ?? '')) {
            $this->json(['error' => 'Invalid CSRF token'], 403);
        }

        $username = Auth::sanitizeInput($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validate input
        if (empty($username) || empty($password)) {
            $this->json(['error' => 'Username and password are required'], 400);
        }

        // Get user
        $user = $this->userModel->getByUsername($username);

        if (!$user) {
            // Log failed attempt
            $this->json(['error' => 'Invalid username or password'], 401);
        }

        // Check if account is locked
        if ($this->userModel->isAccountLocked($user['id'])) {
            $this->json(['error' => 'Account is locked. Try again later'], 423);
        }

        // Verify password
        if (!Auth::verifyPassword($password, $user['password_hash'])) {
            $this->userModel->incrementLoginAttempts($user['id']);
            
            if ($user['login_attempts'] >= 5) {
                $this->userModel->lockAccount($user['id']);
            }

            $this->json(['error' => 'Invalid username or password'], 401);
        }

        // Check if user is active
        if (!$user['is_active']) {
            $this->json(['error' => 'Account is inactive'], 403);
        }

        // Reset login attempts
        $this->userModel->resetLoginAttempts($user['id']);

        // Update last login
        $this->userModel->updateLastLogin($user['id']);

        // Get user role
        $userWithRole = $this->userModel->getUserWithRole($user['id']);

        // Login user
        Auth::login($user['id'], $userWithRole['role_name'], $user['first_name'] . ' ' . $user['last_name']);

        $this->json(['success' => true, 'redirect' => '/Intergrated-school-mngmnt-sysm/public/dashboard/']);
    }

    /**
     * Handle registration
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die('Method not allowed');
        }

        // Validate CSRF
        if (!Auth::validateCSRFToken($_POST['csrf_token'] ?? '')) {
            $this->json(['error' => 'Invalid CSRF token'], 403);
        }

        $data = [
            'username' => Auth::sanitizeInput($_POST['username'] ?? ''),
            'email' => Auth::sanitizeInput($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'password_confirm' => $_POST['password_confirm'] ?? '',
            'first_name' => Auth::sanitizeInput($_POST['first_name'] ?? ''),
            'last_name' => Auth::sanitizeInput($_POST['last_name'] ?? ''),
        ];

        // Validate input
        $errors = $this->validateRegistration($data);

        if (!empty($errors)) {
            $this->json(['error' => implode(', ', $errors)], 400);
        }

        // Check if username exists
        if ($this->userModel->usernameExists($data['username'])) {
            $this->json(['error' => 'Username already exists'], 409);
        }

        // Check if email exists
        if ($this->userModel->emailExists($data['email'])) {
            $this->json(['error' => 'Email already exists'], 409);
        }

        // Hash password
        $hashedPassword = Auth::hashPassword($data['password']);

        // Create user (default role: Student)
        $userId = $this->userModel->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password_hash' => $hashedPassword,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role_id' => 6, // Student role
            'is_active' => true,
        ]);

        if ($userId) {
            $this->json(['success' => true, 'message' => 'Registration successful. Please login.', 'redirect' => '/Intergrated-school-mngmnt-sysm/public/auth/login']);
        } else {
            $this->json(['error' => 'Registration failed. Please try again'], 500);
        }
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Validate registration data
     */
    private function validateRegistration($data)
    {
        $errors = [];

        if (empty($data['username']) || strlen($data['username']) < 3) {
            $errors[] = 'Username must be at least 3 characters';
        }

        if (!Auth::validateEmail($data['email'])) {
            $errors[] = 'Invalid email address';
        }

        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        }

        if ($data['password'] !== $data['password_confirm']) {
            $errors[] = 'Passwords do not match';
        }

        $passwordStrength = Auth::validatePasswordStrength($data['password']);
        if ($passwordStrength !== true) {
            $errors = array_merge($errors, $passwordStrength);
        }

        if (empty($data['first_name'])) {
            $errors[] = 'First name is required';
        }

        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required';
        }

        return $errors;
    }

    /**
     * Render view
     */
    private function render($view)
    {
        $viewFile = APPPATH . 'Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die("View not found: {$viewFile}");
        }

        include $viewFile;
    }

    /**
     * Output JSON
     */
    private function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
