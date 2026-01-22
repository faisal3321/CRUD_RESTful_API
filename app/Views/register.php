
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 300px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button, .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        button:hover { background-color: #0056b3; }
        table {
            background: white;
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #eee; }
        a { color: #007bff; text-decoration: none; margin-top: 15px; }
    </style>
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
</html> 