<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            background: url('/img/buksu-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 28px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 448px;
        }
        h2 {
            color: #202124;
            font-size: 24px;
            font-weight: 400;
            line-height: 1.3333;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            height: 48px;
            padding: 12px 16px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #202124;
            transition: border-color 0.2s;
            width: 100%;
            background: #fff;
        }
        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 1px #1a73e8;
            outline: none;
        }
        .form-control::placeholder {
            color: #5f6368;
            opacity: 0.8;
        }
        .btn-primary {
            width: 100%;
            height: 48px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            margin-top: 24px;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background: #1557b0;
        }
        .links {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #5f6368;
        }
        .links a {
            color: #1a73e8;
            text-decoration: none;
            font-weight: 500;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .saved-info-dropdown {
            display: none;
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #dadce0;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            margin-top: 4px;
            z-index: 1000;
            padding: 8px 0;
        }
        .saved-info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 16px;
            border-bottom: 1px solid #dadce0;
        }
        .saved-info-header h6 {
            margin: 0;
            font-size: 14px;
            color: #202124;
        }
        .saved-info-close {
            cursor: pointer;
            font-size: 18px;
            color: #5f6368;
            padding: 4px;
        }
        .saved-info-item {
            padding: 8px 16px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .saved-info-item:hover {
            background: #f8f9fa;
        }
        .saved-info-email {
            font-size: 14px;
            color: #202124;
        }
        .saved-info-name {
            font-size: 12px;
            color: #5f6368;
        }
        .last-used {
            font-size: 12px;
            color: #1a73e8;
            background: #e8f0fe;
            padding: 2px 8px;
            border-radius: 12px;
            margin-left: 8px;
            display: inline-block;
        }
        .manage-info-link {
            padding: 8px 16px;
            border-top: 1px solid #dadce0;
        }
        .manage-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
        }
        .manage-link:hover {
            text-decoration: none;
            color: #1557b0;
        }
        .input-wrapper {
            position: relative;
            margin-bottom: 16px;
        }
        .form-check {
            margin: 16px 0;
        }
        .form-check-input {
            margin-right: 8px;
        }
        .form-check-label {
            color: #5f6368;
            font-size: 14px;
        }
    </style>
</head>
<body>
        <div class="login-container">
        <h2>Login account</h2>
            
            <form method="POST" action="{{ route('login') }}" autocomplete="on">
                @csrf
            <div class="input-wrapper">
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="form-control" 
                           placeholder="Enter Email Address..." 
                           required 
                           value="{{ old('email') }}" 
                           autocomplete="username">
                <div class="saved-info-dropdown" id="savedInfoDropdown">
                    <div class="saved-info-header">
                        <h6>Saved Info</h6>
                        <span class="saved-info-close">×</span>
                    </div>
                    <div class="saved-info-content">
                        <!-- Saved credentials will be dynamically added here -->
                    </div>
                    <div class="manage-info-link">
                        <a href="#" class="manage-link">
                            <i class="fas fa-cog"></i>
                            Manage personal info
                        </a>
                    </div>
                </div>
            </div>

            <div class="input-wrapper">
                    <input type="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Password" 
                           required 
                           autocomplete="current-password">
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <span>Login</span>
                </button>

            <div class="links">
                No account?
                <a href="{{ route('register') }}">Sign up</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const savedInfoDropdown = document.getElementById('savedInfoDropdown');
            const closeBtn = document.querySelector('.saved-info-close');

            // Sample saved credentials
            const savedCredentials = [
                { email: 'jungkook@gmail.com', name: 'Jeon Jungkook', isLastUsed: true },
                { email: 'vonlib@yahoo.com', name: '122444 • vonlib', isLastUsed: false },
                { email: '2201100346@student.buksu.edu.ph', name: 'Angel', isLastUsed: false }
            ];

            // Show dropdown when input is focused
            emailInput.addEventListener('focus', function() {
                savedInfoDropdown.style.display = 'block';
                renderSavedCredentials();
            });

            // Close dropdown when close button is clicked
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                savedInfoDropdown.style.display = 'none';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!emailInput.contains(e.target) && !savedInfoDropdown.contains(e.target)) {
                    savedInfoDropdown.style.display = 'none';
                }
            });

            function renderSavedCredentials() {
                const content = document.querySelector('.saved-info-content');
                content.innerHTML = '';

                savedCredentials.forEach(cred => {
                    const item = document.createElement('div');
                    item.className = 'saved-info-item';
                    
                    let html = 
                        <div class="saved-info-email">
                            ${cred.email}
                            ${cred.isLastUsed ? '<span class="last-used">Last Used</span>' : ''}
                        </div>;
                    
                    if (cred.name) {
                        html += <div class="saved-info-name">${cred.name}</div>;
                    }

                    item.innerHTML = html;

                    item.addEventListener('click', function() {
                        emailInput.value = cred.email;
                        savedInfoDropdown.style.display = 'none';
                    });

                    content.appendChild(item);
                });
            }
        });
    </script>
</body>
</html>