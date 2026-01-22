<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - Broomees</title>
    <style>
        /* Internal CSS for Register Page */
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
            overflow-x: hidden;
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
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 40%);
            z-index: -1;
        }

        /* Main container */
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            margin: 20px;
            animation: slideUp 0.5s ease-out;
        }

        /* Heading */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2rem;
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(to right, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Input fields */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input::placeholder {
            color: #999;
        }

        /* Button styling */
        button[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Login link section */
        p {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 15px;
        }

        p a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
            position: relative;
            padding: 2px 0;
        }

        p a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s ease;
        }

        p a:hover {
            color: #764ba2;
        }

        p a:hover::after {
            width: 100%;
        }

        /* Animations */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Form field focus effects */
        .input-group {
            position: relative;
        }

        .input-group label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 5px;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 12px;
            color: #667eea;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .container {
                margin: 10px;
                padding: 30px 20px;
                border-radius: 15px;
            }

            h2 {
                font-size: 1.8rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                padding: 12px;
                font-size: 15px;
            }

            button[type="submit"] {
                padding: 14px;
                font-size: 16px;
            }
        }

        /* Loading animation for button */
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

        /* Error message styling */
        .error-message {
            color: #ff4757;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        input.error {
            border-color: #ff4757;
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
    <div class="container">
        <h2>Create Account</h2>

        <form id="registerForm">
            <input type="text" id="name" placeholder="Full Name" required><br>
            <input type="email" id="email" placeholder="Email Address" required><br>
            <input type="password" id="password" placeholder="Create Password" required><br>
            <button type="submit">Join Broomees</button>
        </form>

        <p>Already have an account? <a href="login">Sign In</a></p>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;

            try {
                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        userName: document.getElementById('name').value,
                        userEmail: document.getElementById('email').value,
                        userPassword: document.getElementById('password').value
                    })
                });

                const data = await res.json();

                if (res.status === 201) {
                    // Success animation
                    submitBtn.style.background = 'linear-gradient(135deg, #4CAF50 0%, #45a049 100%)';
                    submitBtn.textContent = '✓ Success!';
                    
                    setTimeout(() => {
                        alert(data.message);
                        window.location.href = '/login';
                    }, 1000);
                } else {
                    // Show error
                    alert(JSON.stringify(data.errors || data.message));
                    
                    // Reset button
                    submitBtn.classList.remove('loading');
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                alert('Network error. Please try again.');
                submitBtn.classList.remove('loading');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });

        // Add focus effects to inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>




<!-- Original -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <form id="registerForm">
        <input type="text" id="name" placeholder="Name" required><br>
        <input type="email" id="email" placeholder="Email" required><br>
        <input type="password" id="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login">Login</a></p>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const res = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    userName: document.getElementById('name').value,
                    userEmail: document.getElementById('email').value,
                    userPassword: document.getElementById('password').value
                })
            });

            const data = await res.json();
            console.log(data);

            if (res.status === 201) {
                alert(data.message);
                window.location.href = '/login';
            } else {
                alert(JSON.stringify(data.errors || data.message));
            }
        });
</script>

</body>
</html> -->