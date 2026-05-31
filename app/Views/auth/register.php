<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NTURUBA School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .auth-container {
            width: 100%;
            max-width: 550px;
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
            margin-bottom: 18px;
        }
        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .btn-register {
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
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
            font-size: 14px;
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
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
            display: none;
        }
        .strength-meter {
            width: 100%;
            height: 4px;
            background: #ddd;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 5px;
        }
        .strength-meter-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }
        .spinner-border {
            display: none;
        }
        .loading .spinner-border {
            display: inline-block;
        }
        .loading .btn-register {
            opacity: 0.8;
        }
        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .auth-card {
                padding: 25px;
            }
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
                <h1>Create Account</h1>
                <p>Join NTURUBA School Management System</p>
            </div>

            <div id="alertContainer"></div>

            <form id="registerForm" method="POST" action="/Intergrated-school-mngmnt-sysm/public/auth/register">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(Auth::generateCSRFToken()); ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" minlength="3" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a strong password" required>
                    <div class="strength-meter">
                        <div class="strength-meter-fill" id="strengthMeter"></div>
                    </div>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirm">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn-register">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Create Account
                </button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="/Intergrated-school-mngmnt-sysm/public/auth/login">Sign in here</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const registerForm = document.getElementById('registerForm');
        const alertContainer = document.getElementById('alertContainer');
        const passwordInput = document.getElementById('password');
        const strengthMeter = document.getElementById('strengthMeter');
        const passwordStrengthDiv = document.getElementById('passwordStrength');

        // Password strength meter
        passwordInput.addEventListener('input', (e) => {
            const password = e.target.value;
            let strength = 0;
            let strengthText = '';
            let strengthColor = '';

            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[!@#$%^&*()_+\-=\[\]{};:\'",.<>?\/\\|`~]/.test(password)) strength++;

            switch(strength) {
                case 0:
                    strengthText = '';
                    strengthColor = '';
                    strengthMeter.style.width = '0%';
                    passwordStrengthDiv.style.display = 'none';
                    break;
                case 1:
                    strengthText = 'Very Weak';
                    strengthColor = '#dc3545';
                    strengthMeter.style.width = '20%';
                    break;
                case 2:
                    strengthText = 'Weak';
                    strengthColor = '#fd7e14';
                    strengthMeter.style.width = '40%';
                    break;
                case 3:
                    strengthText = 'Fair';
                    strengthColor = '#ffc107';
                    strengthMeter.style.width = '60%';
                    break;
                case 4:
                    strengthText = 'Strong';
                    strengthColor = '#20c997';
                    strengthMeter.style.width = '80%';
                    break;
                case 5:
                    strengthText = 'Very Strong';
                    strengthColor = '#28a745';
                    strengthMeter.style.width = '100%';
                    break;
            }

            if (strengthText) {
                strengthMeter.style.backgroundColor = strengthColor;
                passwordStrengthDiv.textContent = strengthText;
                passwordStrengthDiv.style.color = strengthColor;
                passwordStrengthDiv.style.display = 'block';
            }
        });

        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(registerForm);
            const btn = registerForm.querySelector('.btn-register');
            btn.classList.add('loading');

            try {
                const response = await fetch('/Intergrated-school-mngmnt-sysm/public/auth/register', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    showAlert(data.error || 'Registration failed', 'danger');
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
