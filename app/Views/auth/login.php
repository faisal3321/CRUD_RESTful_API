<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form id="loginForm">

        <label>Email</label><br>
        <input type="email" id="userEmail" required /><br><br>
    
        <label>Password</label><br>
        <input type="password" id="userPassword" required /><br><br>

        <button type="submit" >Login</button>

    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch("<?= base_url('api/login') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userEmail: document.getElementById('userEmail').value,
                    userPassword: document.getElementById('userPassword').value
                })
            }) 
            .then(res => res.json())
            .then(data => {
                if(data.token) {
                    localStorage.setItem('token', data.token);
                    window.location.href = "<?= base_url('users') ?>";
                } else {
                    alert(data.message);
                }
            })
        })
    </script>
    
</body>
</html>