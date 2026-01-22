<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Broomees</title>
    <style>
        /* Internal CSS for Login Page */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Arial', sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            z-index: -1;
            animation: floatBackground 15s ease-in-out infinite alternate;
        }

        /* Main container */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 75px rgba(0, 0, 0, 0.3);
            padding: 50px 40px;
            width: 100%;
            max-width: 420px;
            margin: 20px;
            animation: slideIn 0.6s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Heading */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 35px;
            font-size: 2.2rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 20px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 4px;
            background: linear-gradient(to right, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        /* Input fields */
        .input-group {
            position: relative;
        }

        input[type="email"],
        input[type="password"] {
            padding: 16px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
            background: #f8f9fa;
            color: #333;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            transform: translateY(-1px);
        }

        input::placeholder {
            color: #aaa;
        }

        /* Input icons */
        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        /* Remember me and forgot password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 5px 0 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Button styling */
        button[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.6);
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        button[type="submit"]:active {
            transform: translateY(-1px);
        }

        /* Register link */
        .register-link {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 15px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: color 0.3s ease;
            position: relative;
            padding: 2px 0;
        }

        .register-link a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s ease;
        }

        .register-link a:hover {
            color: #764ba2;
        }

        .register-link a:hover::after {
            width: 100%;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes floatBackground {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(20px, 20px);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        /* Logo/Brand */
        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            font-size: 40px;
            color: #667eea;
            margin-bottom: 10px;
        }

        .brand-name {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Password visibility toggle */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        /* Loading animation */
        .loading {
            position: relative;
            color: transparent;
        }

        .loading::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
                padding: 40px 25px;
                border-radius: 15px;
            }

            h2 {
                font-size: 1.8rem;
            }

            input[type="email"],
            input[type="password"] {
                padding: 14px 18px;
                font-size: 15px;
            }

            button[type="submit"] {
                padding: 16px;
                font-size: 16px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        /* Success animation */
        .success {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%) !important;
            animation: pulse 2s infinite;
        }

        /* Error styling */
        .error-shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Brand/Logo -->
        <div class="brand">
            <div class="brand-logo">🎓</div>
            <div class="brand-name">Broomees</div>
        </div>

        <h2>Welcome Back</h2>

        <form id="loginForm">
            <div class="input-group">
                <input type="email" id="email" placeholder="Email Address" required>
                <div class="input-icon">✉️</div>
            </div>
            
            <div class="input-group">
                <input type="password" id="password" placeholder="Password" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">👁️</button>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" id="remember">
                    Remember me
                </label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit">Sign In to Broomees</button>
        </form>

        <div class="register-link">
            New to Broomees? <a href="register">Create Account</a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleBtn.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleBtn.textContent = '👁️';
            }
        }

        // Enhanced form submission
        document.getElementById('loginForm').addEventListener('submit', async(e) => {
            e.preventDefault();
            
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        userEmail: document.getElementById('email').value,
                        userPassword: document.getElementById('password').value
                    })
                });

                const data = await res.json();

                if (data.token) {
                    // Success state
                    submitBtn.classList.remove('loading');
                    submitBtn.classList.add('success');
                    submitBtn.textContent = '✓ Login Successful!';
                    
                    // Store data
                    localStorage.setItem('token', data.token);
                    localStorage.setItem('user', JSON.stringify(data.User));
                    
                    // Check if "Remember me" is checked
                    if (document.getElementById('remember').checked) {
                        localStorage.setItem('rememberedEmail', document.getElementById('email').value);
                    }
                    
                    // Redirect after short delay
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1000);
                } else {
                    // Error handling
                    submitBtn.classList.remove('loading');
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    
                    // Add error animation
                    submitBtn.classList.add('error-shake');
                    setTimeout(() => submitBtn.classList.remove('error-shake'), 500);
                    
                    alert(data.message || 'Login failed. Please try again.');
                }
            } catch (error) {
                submitBtn.classList.remove('loading');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                alert('Network error. Please check your connection.');
            }
        });

        // Check for remembered email
        window.onload = function() {
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            if (rememberedEmail) {
                document.getElementById('email').value = rememberedEmail;
                document.getElementById('remember').checked = true;
            }
        };

        // Add focus effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>





<!-- Original -->
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form id="loginForm">
        
        <input type="email" id="email" placeholder="Email" required><br>
        <input type="password" id="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async(e) => {
            e.preventDefault();

            const res = await fetch('/api/login', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    userEmail: document.getElementById('email').value,
                    userPassword: document.getElementById('password').value
                })
            })

            const data = await res.json();
            console.log(data);

            if (data.token) {
                localStorage.setItem('token', data.token),
                localStorage.setItem('user', JSON.stringify(data.User)),
                window.location.href = '/dashboard'
            } else {
                alert(data.message);
            }
        })
    </script>

</body>
</html> -->