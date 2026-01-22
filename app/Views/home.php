<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Internal CSS for Home Page */
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
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Add a subtle background effect */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
        }

        h1 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            padding: 0 20px;
        }

        /* Decorative underline for heading */
        h1::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            margin: 15px auto;
            border-radius: 2px;
        }

        p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            line-height: 1.6;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        /* Link container */
        a {
            display: inline-block;
            text-decoration: none;
            margin: 0 15px;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Register button */
        a[href="register"] {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
            color: white;
            border: none;
        }

        /* Login button */
        a[href="login"] {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        /* Hover effects */
        a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        a[href="register"]:hover {
            background: linear-gradient(135deg, #feb47b 0%, #ff7e5f 100%);
        }

        a[href="login"]:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: white;
        }

        /* Pulse animation for register button */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 126, 95, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 126, 95, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 126, 95, 0);
            }
        }

        a[href="register"] {
            animation: pulse 2s infinite;
        }

        /* Fade in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body > * {
            animation: fadeIn 1s ease-out;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            p {
                font-size: 1.1rem;
                padding: 0 30px;
            }
            
            a {
                display: block;
                margin: 10px auto;
                max-width: 200px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.6rem;
            }
            
            p {
                font-size: 1rem;
                padding: 0 20px;
            }
            
            a {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to Broomees Home page</h1>
    <p>Learning keeps you ahead and motivated for all the time</p>

    <a href="register">Register</a>
    <a href="login">Login</a>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to Broomees Home page</h1>
    <p>Learning keeps you ahead and motivated for all the time</p>

    <a href="register">Register</a>
    <a href="login">Login</a>
</body>
</html> -->