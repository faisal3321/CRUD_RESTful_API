<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
    <h2 class="mb-4">Login</h2>

    <form id="loginForm" class="bg-white p-4 rounded shadow-sm" style="width: 300px;">
        <div class="mb-3">
            <input type="email" id="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" id="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
</html>