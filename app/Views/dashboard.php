<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

<h2 class="mb-4">User Dashboard</h2>

<div id="authCheck" class="mb-4">
    Checking authentication...
</div>

<table id="userTable" class="table table-bordered shadow-sm" style="display:none; width: 80%; max-width: 600px;">
    <thead class="table-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="userData"></tbody>
</table>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Check authentication on page load
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const user = localStorage.getItem('user');
        
        const authCheck = document.getElementById('authCheck');
        const userTable = document.getElementById('userTable');
        
        if (!token || !user) {
            authCheck.innerHTML = '<p class="text-danger">You are not logged in. Redirecting to login page...</p>';
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
                        <button class="btn btn-primary mb-2" onclick="updateUser()">Update</button>
                        <button class="btn btn-danger mb-2" onclick="deleteUser()">Delete</button>
                        <button class="btn btn-secondary mb-2" onclick="logout()">Logout</button>
                    </td>
                </tr>
            `;
        } catch (error) {
            authCheck.innerHTML = '<p class="text-danger">Error loading user data. Please login again.</p>';
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