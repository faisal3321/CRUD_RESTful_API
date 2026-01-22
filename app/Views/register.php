<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    <h2 class="mb-4">Register</h2>

    <form id="registerForm" class="bg-white p-4 rounded shadow-sm" style="width: 300px;">
        <div class="mb-3">
            <input type="text" id="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <input type="email" id="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" id="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    <p class="mt-3">Already have an account? <a href="login">Login</a></p>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
</html>