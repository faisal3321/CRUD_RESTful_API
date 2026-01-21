<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form id="registerForm">
    <label>User Name</label><br>
    <input type="text" id="userName" required><br><br>

    <label>User Email</label><br>
    <input type="email" id="userEmail" required><br><br>

    <label>Password</label><br>
    <input type="password" id="userPassword" required><br><br>

    <button type="submit">Register</button>
</form>

<p>
    Already registered?
    <a href="<?php echo base_url('login'); ?>">Login here</a>
</p>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    fetch("<?= base_url('api/register') ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            userName: document.getElementById('userName').value,
            userEmail: document.getElementById('userEmail').value,
            userPassword: document.getElementById('userPassword').value
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    });
});
</script>

</body>
</html>