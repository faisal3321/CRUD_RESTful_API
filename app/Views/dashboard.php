<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Broomees</title>
    <style>
        /* Internal CSS for Dashboard Page */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a2980 0%, #26d0ce 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Dashboard Container */
        .dashboard-wrapper {
            width: 100%;
            max-width: 1000px;
            padding: 30px;
        }

        /* Authentication Check */
        #authCheck {
            background: white;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #1a2980;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        /* Main Content Container */
        .dashboard-content {
            display: none;
        }

        /* Account Information Section */
        .account-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.6s ease-out;
        }

        .section-title {
            font-size: 1.8rem;
            color: #1a2980;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 3px solid #f0f0f0;
        }

        .section-title::before {
            content: "👤";
            font-size: 1.5rem;
        }

        /* User Info Grid */
        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #1a2980;
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            background: linear-gradient(135deg, #1a2980 0%, #26d0ce 100%);
            color: white;
        }

        .info-card:hover .info-label,
        .info-card:hover .info-value {
            color: white;
        }

        .info-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .info-value {
            font-size: 1.4rem;
            color: #1a2980;
            font-weight: 600;
            word-break: break-word;
        }

        /* Quick Actions Section */
        .actions-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.8s ease-out;
        }

        .actions-title {
            font-size: 1.8rem;
            color: #1a2980;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 15px;
            border-bottom: 3px solid #f0f0f0;
        }

        .actions-title::before {
            content: "⚡";
            font-size: 1.5rem;
        }

        /* Actions Grid */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .action-btn {
            border: none;
            padding: 20px 25px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .action-btn:hover::before {
            left: 100%;
        }

        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .action-btn:active {
            transform: translateY(-2px);
        }

        .action-btn.update {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .action-btn.update:hover {
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .action-btn.delete {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
            color: white;
        }

        .action-btn.delete:hover {
            box-shadow: 0 12px 30px rgba(255, 126, 95, 0.4);
        }

        .action-btn.logout {
            background: linear-gradient(135deg, #1a2980 0%, #26d0ce 100%);
            color: white;
        }

        .action-btn.logout:hover {
            box-shadow: 0 12px 30px rgba(26, 41, 128, 0.4);
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

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                padding: 20px;
            }

            .account-section,
            .actions-section {
                padding: 30px 20px;
            }

            .user-info-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .section-title,
            .actions-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .dashboard-wrapper {
                padding: 15px;
            }

            .account-section,
            .actions-section {
                padding: 25px 15px;
            }

            .info-card {
                padding: 20px;
            }

            .action-btn {
                padding: 18px 20px;
                font-size: 1rem;
            }
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateX(150%);
            transition: transform 0.5s ease;
            z-index: 1000;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left: 5px solid #4CAF50;
        }

        .toast.error {
            border-left: 5px solid #f44336;
        }

        .toast.info {
            border-left: 5px solid #2196F3;
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Authentication Check -->
        <div id="authCheck">
            <div class="loading-spinner"></div>
            <h3>Checking authentication...</h3>
            <p>Please wait while we verify your credentials</p>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content" id="dashboardContent">
            <!-- Account Information Section -->
            <div class="account-section">
                <h2 class="section-title">Account Information</h2>
                
                <div class="user-info-grid">
                    <div class="info-card">
                        <div class="info-label">Full Name</div>
                        <div class="info-value" id="userName">Loading...</div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-label">Email Address</div>
                        <div class="info-value" id="userEmail">Loading...</div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-label">Account Status</div>
                        <div class="info-value" style="color: #4CAF50;">✅ Active</div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-label">Last Login</div>
                        <div class="info-value" id="lastLogin">Just now</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="actions-section">
                <h2 class="actions-title">Quick Actions</h2>
                
                <div class="actions-grid">
                    <button class="action-btn update" onclick="updateUser()">
                        <span>✏️</span> Update Profile
                    </button>
                    
                    <button class="action-btn delete" onclick="deleteUser()">
                        <span>🗑️</span> Delete Account
                    </button>
                    
                    <button class="action-btn logout" onclick="logout()">
                        <span>🚪</span> Logout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastContainer"></div>

    <script>
        // Toast Notification Function
        function showToast(message, type = 'info') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <span>${type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'}</span>
                <span>${message}</span>
            `;
            toastContainer.appendChild(toast);
            
            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // Check authentication on page load
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('token');
            const user = localStorage.getItem('user');
            
            const authCheck = document.getElementById('authCheck');
            const dashboardContent = document.getElementById('dashboardContent');
            
            // Simulate loading
            setTimeout(() => {
                if (!token || !user) {
                    authCheck.innerHTML = `
                        <div style="color: #f44336; font-size: 2rem; margin-bottom: 15px;">🔒</div>
                        <h3 style="color: #f44336;">Authentication Required</h3>
                        <p>You are not logged in. Redirecting to login page...</p>
                        <button onclick="window.location.href='/login'" style="margin-top: 15px; padding: 12px 25px; background: #1a2980; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                            Go to Login
                        </button>
                    `;
                    return;
                }
                
                try {
                    const userData = JSON.parse(user);
                    
                    // Hide auth check, show content
                    authCheck.style.display = 'none';
                    dashboardContent.style.display = 'block';
                    
                    // Update user information
                    document.getElementById('userName').textContent = userData.userName || 'Not provided';
                    document.getElementById('userEmail').textContent = userData.userEmail || 'Not provided';
                    
                    // Show welcome toast
                    showToast(`Welcome back, ${userData.userName}!`, 'success');
                    
                } catch (error) {
                    console.error('Error loading user data:', error);
                    authCheck.innerHTML = `
                        <div style="color: #ff9800; font-size: 2rem; margin-bottom: 15px;">⚠️</div>
                        <h3 style="color: #ff9800;">Session Error</h3>
                        <p>Error loading user data. Please login again.</p>
                        <button onclick="window.location.href='/login'" style="margin-top: 15px; padding: 12px 25px; background: #1a2980; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                            Go to Login
                        </button>
                    `;
                    localStorage.clear();
                }
            }, 1000);
        });

        // Update User Function
        async function updateUser() {
            const user = JSON.parse(localStorage.getItem('user'));
            const token = localStorage.getItem('token');
            
            // Create a styled prompt
            const newName = prompt("✏️ Update Your Name\n\nEnter your new name:", user.userName);
            if (!newName || newName.trim() === '' || newName === user.userName) {
                if (newName === null) return;
                showToast('No changes made or name unchanged', 'info');
                return;
            }
            
            try {
                showToast('Updating profile...', 'info');
                
                const res = await fetch(`http://localhost:8080/api/user/${user.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({ userName: newName.trim() })
                });
                
                const data = await res.json();
                
                if (res.ok) {
                    // Update local storage
                    user.userName = newName.trim();
                    localStorage.setItem('user', JSON.stringify(user));
                    
                    // Update UI
                    document.getElementById('userName').textContent = newName.trim();
                    
                    showToast('Profile updated successfully!', 'success');
                } else {
                    showToast(data.message || 'Update failed. Please try again.', 'error');
                    if (res.status === 401) {
                        localStorage.clear();
                        setTimeout(() => window.location.href = '/login', 1500);
                    }
                }
            } catch (error) {
                console.error('Update error:', error);
                showToast('Network error. Please check your connection.', 'error');
            }
        }

        // Delete User Function
        async function deleteUser() {
            const confirmed = confirm(`⚠️ DELETE ACCOUNT CONFIRMATION\n\nAre you sure you want to delete your account?\n\nThis action will permanently delete all your data and cannot be undone.`);
            
            if (!confirmed) {
                showToast('Account deletion cancelled', 'info');
                return;
            }
            
            const user = JSON.parse(localStorage.getItem('user'));
            const token = localStorage.getItem('token');
            
            try {
                showToast('Deleting account...', 'info');
                
                const res = await fetch(`http://localhost:8080/api/user/${user.id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                });
                
                const data = await res.json();
                
                if (res.ok) {
                    showToast('Account deleted successfully!', 'success');
                    localStorage.clear();
                    
                    setTimeout(() => {
                        window.location.href = '/register';
                    }, 2000);
                } else {
                    showToast(data.message || 'Delete failed. Please try again.', 'error');
                }
            } catch (error) {
                console.error('Delete error:', error);
                showToast('Network error. Please check your connection.', 'error');
            }
        }

        // Logout Function
        function logout() {
            showToast('Logging out...', 'info');
            
            setTimeout(() => {
                localStorage.clear();
                showToast('Logged out successfully!', 'success');
                
                setTimeout(() => {
                    window.location.href = '/login';
                }, 1500);
            }, 1000);
        }
    </script>
</body>
</html>







<!-- Original -->
<!-- <!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>User Dashboard</h2>

<div id="authCheck">
    Checking authentication...
</div>

<table border="1" id="userTable" style="display:none;">
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
</html> -->