
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

<h2>User Dashboard</h2>

<div id="authCheck">
    Checking authentication...
</div>

<table id="userTable" style="display:none;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="userData"></tbody>
</table>

<script>
    // Check authentication on page load
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const user = localStorage.getItem('user');
        
        const authCheck = document.getElementById('authCheck');
        const userTable = document.getElementById('userTable');
        
        if (!token || !user) {
            authCheck.innerHTML = '<p style="color:red;">You are not logged in. Redirecting to login page...</p>';
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
            return;
        }
        
        try {
            const userData = JSON.parse(user);
            authCheck.style.display = 'none';
            userTable.style.display = 'table';
            
            document.getElementById('userData').innerHTML = `
                <tr>
                    <td>${userData.userName}</td>
                    <td>${userData.userEmail}</td>
                    <td>
                        <button onclick="updateUser()">Update</button>
                        <button onclick="deleteUser()">Delete</button>
                        <button onclick="logout()">Logout</button>
                    </td>
                </tr>
            `;
        } catch (error) {
            authCheck.innerHTML = '<p style="color:red;">Error loading user data. Please login again.</p>';
            localStorage.clear();
            setTimeout(() => {
                window.location.href = '/login';
            }, 2000);
        }
    });

    async function updateUser() {
        const user = JSON.parse(localStorage.getItem('user'));
        const token = localStorage.getItem('token');
        
        const newName = prompt("Enter new name", user.userName);
        if (!newName || newName.trim() === '') return;
        
        try {
            const res = await fetch(`http://localhost:8080/api/user/${user.id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify({ userName: newName })
            });
            
            const data = await res.json();
            
            if (res.ok) {
                user.userName = newName;
                localStorage.setItem('user', JSON.stringify(user));
                alert('Profile updated successfully!');
                location.reload();
            } else {
                alert(data.message || 'Update failed');
                if (res.status === 401) {
                    localStorage.clear();
                    window.location.href = '/login';
                }
            }
        } catch (error) {
            alert('Network error. Please check your connection.');
            console.error('Update error:', error);
        }
    }

    async function deleteUser() {
        if (!confirm("Are you sure you want to delete your account? This action cannot be undone.")) return;
        
        const user = JSON.parse(localStorage.getItem('user'));
        const token = localStorage.getItem('token');
        
        try {
            const res = await fetch(`http://localhost:8080/api/user/${user.id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });
            
            const data = await res.json();
            
            if (res.ok) {
                localStorage.clear();
                alert('Account deleted successfully!');
                window.location.href = '/register';
            } else {
                alert(data.message || 'Delete failed');
            }
        } catch (error) {
            alert('Network error. Please check your connection.');
            console.error('Delete error:', error);
        }
    }

    function logout() {
        localStorage.clear();
        alert('Logged out successfully!');
        window.location.href = '/login';
    }
</script>

</body>
</html>