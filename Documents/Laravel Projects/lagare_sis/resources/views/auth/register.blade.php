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
            padding: 15px;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 1.25rem;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 320px;
        }
        .form-control {
            border-radius: 16px;
            padding: 0.4rem 0.875rem;
            border: 1px solid #dadce0;
            background: #ffffff;
            margin-bottom: 0.5rem;
            font-size: 12px;
            height: 32px;
            width: 100%;
        }
        .btn-primary {
            background-color: #4e73df;
            color: white;
            padding: 0.4rem 0.875rem;
            border-radius: 16px;
            border: none;
            font-size: 12px;
            font-weight: 500;
            height: 32px;
            width: 100%;
            margin-top: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
        }
        .google-btn {
            background: white;
            color: #3c4043;
            padding: 0.4rem 0.875rem;
            border-radius: 16px;
            border: 1px solid #dadce0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            font-size: 12px;
            font-weight: 500;
            height: 32px;
            width: 100%;
            cursor: pointer;
        }
        .google-btn:hover {
            background: #f8f9fa;
        }
        .google-btn img {
            width: 14px;
            height: 14px;
        }
        .links {
            margin-top: 0.75rem;
            text-align: center;
            font-size: 12px;
            color: #3c4043;
        }
        .links a {
            color: #4e73df;
            text-decoration: none;
            margin-left: 4px;
        }
        .links a:hover {
            color: #2e59d9;
        }
        h2 {
            color: #202124;
            font-size: 18px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .form-check {
            margin: 0.75rem 0;
        }
        .form-check-input {
            margin-right: 0.5rem;
        }
        .form-check-label {
            font-size: 12px;
        }
        select.form-control {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23202124' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.75em;
        }
        .col-form-label {
            display: none;
        }
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0;
        }
        .invalid-feedback {
            font-size: 11px;
            color: #dc3545;
            margin-top: -0.4rem;
            margin-bottom: 0.4rem;
            padding-left: 1rem;
        }
        #student-fields {
            margin-top: 0.25rem;
        }
        .form-control::placeholder {
            color: #5f6368;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="register-container">
            <h2 class="text-center">Create account</h2>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus 
                    placeholder="Full Name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autocomplete="email" 
                    placeholder="Email Address">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div id="student-fields" style="display: {{ old('role', 'student') === 'student' ? 'block' : 'none' }};">
                    <input id="student_id" type="text" class="form-control @error('student_id') is-invalid @enderror" 
                        name="student_id" value="{{ old('student_id') }}" placeholder="Student ID">
                    @error('student_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" 
                        name="course" value="{{ old('course') }}" placeholder="Course">
                    @error('course')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <select id="year_level" class="form-control @error('year_level') is-invalid @enderror" name="year_level">
                        <option value="" disabled selected>Select Year Level</option>
                        <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                    </select>
                    @error('year_level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                    name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input id="password-confirm" type="password" class="form-control" 
                    name="password_confirmation" required autocomplete="new-password" 
                    placeholder="Confirm Password">

                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </form>

            <form method="GET" action="{{ route('auth.google') }}" class="mt-3">
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

        document.getElementById('role').addEventListener('change', function() {
            var studentFields = document.getElementById('student-fields');
            if (this.value === 'student') {
                studentFields.style.display = 'block';
            } else {
                studentFields.style.display = 'none';
            }
        });
    </script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
