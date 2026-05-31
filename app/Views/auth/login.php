<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NTURUBA School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Intergrated-school-mngmnt-sysm/public/css/auth.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-container {
            width: 100%;
            max-width: 450px;
        }
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .auth-header p {
            color: #666;
            font-size: 14px;
        }
        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            margin: 0 auto 15px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .form-check-input {
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        .forgot-password {
            text-align: right;
            margin-bottom: 20px;
        }
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 13px;
        }
        .spinner-border {
            display: none;
        }
        .loading .spinner-border {
            display: inline-block;
        }
        .loading .btn-login {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="logo">
                    🎓
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to your account</p>
            </div>

            <div id="alertContainer"></div>

            <form id="loginForm" method="POST" action="/Intergrated-school-mngmnt-sysm/public/auth/login">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(Auth::generateCSRFToken()); ?>">

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label ms-2" for="remember">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Sign In
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="/Intergrated-school-mngmnt-sysm/public/auth/register">Sign up here</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const loginForm = document.getElementById('loginForm');
        const alertContainer = document.getElementById('alertContainer');

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(loginForm);
            const btn = loginForm.querySelector('.btn-login');
            btn.classList.add('loading');

            try {
                const response = await fetch('/Intergrated-school-mngmnt-sysm/public/auth/login', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showAlert('Login successful!', 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1000);
                } else {
                    showAlert(data.error || 'Login failed', 'danger');
                }
            } catch (error) {
                showAlert('An error occurred. Please try again.', 'danger');
            } finally {
                btn.classList.remove('loading');
            }
        });

        function showAlert(message, type) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.setAttribute('role', 'alert');
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            alertContainer.innerHTML = '';
            alertContainer.appendChild(alert);
        }
    </script>
</body>
</html>
