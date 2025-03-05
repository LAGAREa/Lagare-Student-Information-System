<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIS</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url('/img/buksu-bg.png') !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .page-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            border-radius: 24px;
            padding: 0.75rem 1rem;
            border: 1px solid #dadce0;
            background: rgba(255, 255, 255, 0.9);
            margin-bottom: 1rem;
            font-size: 14px;
            height: 40px;
            font-family: 'Google Sans', 'Roboto', sans-serif;
        }
        .btn-primary {
            background: white;
            color: #3c4043;
            width: 100%;
            padding: 0.75rem;
            border-radius: 24px;
            font-weight: 500;
            border: 1px solid #dadce0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Google Sans', 'Roboto', sans-serif;
            font-size: 14px;
            height: 40px;
            padding-left: 24px;
            padding-right: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            background-color: #4e73df;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            color: white;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .google-btn {
            background: white;
            color: #3c4043;
            width: 100%;
            padding: 0.75rem;
            border-radius: 24px;
            font-weight: 500;
            border: 1px solid #dadce0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Google Sans', 'Roboto', sans-serif;
            font-size: 14px;
            height: 40px;
            padding-left: 24px;
            padding-right: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .google-btn:hover {
            background: #f8f9fa;
            color: #3c4043;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        .google-btn img {
            width: 18px;
            height: 18px;
        }
        .links {
            margin-top: 1rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-family: 'Google Sans', 'Roboto', sans-serif;
            color: #3c4043;
        }
        .links a {
            color: #4e73df;
            text-decoration: none;
            transition: color 0.2s;
            font-weight: 500;
        }
        .links a:hover {
            color: #2e59d9;
            text-decoration: none;
        }
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="register-container">
            <h2 class="text-center mb-4">Create account</h2>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <select name="role" class="form-control" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <span>Register Account</span>
                </button>
            </form>

            <form method="GET" action="{{ route('auth.google') }}">
                <button type="submit" class="google-btn">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=" alt="Google logo">
                    Sign up with Google
                </button>
            </form>

            <div class="links">
                Have an account?
                <a href="{{ route('login') }}">Log in</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if background image is loading
            const img = new Image();
            img.onload = function() {
                console.log('Background image loaded successfully');
            };
            img.onerror = function() {
                console.error('Background image failed to load');
                // Try to load with asset helper
                const assetImg = new Image();
                assetImg.src = "{{ asset('img/buksu-bg.png') }}";
                assetImg.onload = () => console.log('Image loaded with asset helper');
                assetImg.onerror = () => console.error('Image failed to load with asset helper');
            };
            img.src = '/img/buksu-bg.png';
        });
    </script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
