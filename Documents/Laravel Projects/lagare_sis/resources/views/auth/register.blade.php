<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - SIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .btn-register {
            width: 100%;
            padding: 10px;
            background: #4e73df;
            border: none;
        }
        .btn-register:hover {
            background: #2e59d9;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .form-control {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="register-form">
            <h2 class="text-center mb-4">Student Registration</h2>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                @csrf
                
                <div class="form-group">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name') }}" placeholder="Full Name" required>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                        name="student_id" value="{{ old('student_id') }}" placeholder="Student ID" required>
                    @error('student_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control @error('course') is-invalid @enderror" name="course" required>
                        <option value="" disabled selected>Select Course</option>
                        <option value="BSIT" {{ old('course') == 'BSIT' ? 'selected' : '' }}>BS Information Technology</option>
                        <option value="BSCS" {{ old('course') == 'BSCS' ? 'selected' : '' }}>BS Computer Science</option>
                        <option value="BSIS" {{ old('course') == 'BSIS' ? 'selected' : '' }}>BS Information Systems</option>
                        <option value="BSEMC" {{ old('course') == 'BSEMC' ? 'selected' : '' }}>BS Entertainment and Multimedia Computing</option>
                    </select>
                    @error('course')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <select class="form-control @error('year_level') is-invalid @enderror" name="year_level" required>
                        <option value="" disabled selected>Select Year Level</option>
                        <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                    </select>
                    @error('year_level')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                        name="password" placeholder="Password" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" 
                        name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-register">Register</button>

                <div class="text-center mt-3">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
