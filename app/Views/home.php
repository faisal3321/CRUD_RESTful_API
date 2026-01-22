<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Keeping only the styles that aren't replaceable by Bootstrap */
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        /* Keeping the original button hover effect */
        button:hover { background-color: #0056b3; }
    </style>
</head>

<body class="d-flex flex-column align-items-center pt-5">
    <h1 class="mb-3">Welcome to Broomees Home page</h1>
    <p class="mb-4">Learning keeps you ahead and motivated for all the time</p>

    <div class="d-flex flex-column" style="width: 300px;">
        <a href="register" class="btn btn-primary mb-2 text-center">Register</a>
        <a href="login" class="btn btn-primary text-center">Login</a>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>