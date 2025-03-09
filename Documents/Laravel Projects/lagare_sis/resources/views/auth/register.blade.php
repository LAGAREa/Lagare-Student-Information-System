<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - SIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        }
        .register-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }
        h2 {
            color: #444;
            font-size: 24px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 25px;
        }
        .form-control, .form-select {
            height: 45px;
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 6px;
            padding: 8px 15px;
            font-size: 14px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4c6ef5;
            box-shadow: 0 0 0 3px rgba(76, 110, 245, 0.1);
        }
        .form-control::placeholder {
            color: #999;
        }
        .btn-register {
            background: #4c6ef5;
            color: white;
            width: 100%;
            padding: 12px;
            font-size: 15px;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            margin-top: 10px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: #4263eb;
            transform: translateY(-1px);
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .login-link a {
            color: #4c6ef5;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: #dc3545;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
        }
        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }
        select.form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23999' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1em 1em;
            padding-right: 2.5rem;
        }
        select.form-select:focus {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%234c6ef5' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        }
        .social-login {
            margin-top: 20px;
            text-align: center;
        }
        .btn-google {
            background: #fff;
            color: #666;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .btn-google:hover {
            background: #f8f9fa;
            border-color: #ccc;
        }
        .btn-google img {
            width: 18px;
            height: 18px;
        }
    </style>
</head>

<body>
    <div class="register-form">
        <h2>Register account</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" placeholder="Full Name" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" placeholder="Email Address" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                name="student_id" value="{{ old('student_id') }}" placeholder="Student ID" required>
            @error('student_id')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <select class="form-select @error('course') is-invalid @enderror" name="course" required>
                <option value="" disabled selected>Select Course</option>
                <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BS Information Technology</option>
                <option value="BSCS" {{ old('course') == 'BSCS' ? 'selected' : '' }}>BS Computer Science</option>
                <option value="BSIS" {{ old('course') == 'BSIS' ? 'selected' : '' }}>BS Information Systems</option>
                <option value="BSEMC" {{ old('course') == 'BSEMC' ? 'selected' : '' }}>BS Entertainment and Multimedia Computing</option>
            </select>
            @error('course')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <select class="form-select @error('year_level') is-invalid @enderror" name="year_level" required>
                <option value="" disabled selected>Select Year Level</option>
                <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
            </select>
            @error('year_level')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" placeholder="Password" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="password" class="form-control" 
                name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit" class="btn btn-register">Register</button>

            <div class="social-login">
                <button type="button" class="btn btn-google">
                    <img src="https://www.google.com/favicon.ico" alt="Google icon">
                    Continue with Google
                </button>
            </div>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
