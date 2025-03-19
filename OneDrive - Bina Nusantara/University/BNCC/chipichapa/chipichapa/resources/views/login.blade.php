<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | ChipiChapa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom Styles -->
    <style>
        /* Background */
        body {
            background: #f4f7fc; /* Soft gray-blue background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        /* Centering container */
        .container {
            width: 100%;
            max-width: 360px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        /* Title */
        .title {
            font-size: 24px;
            font-weight: 600;
            color: #1E3A8A;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }
        /* Form */
        .form-label {
            font-weight: 500;
            color: #374151;
            text-align: left;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #d1d5db;
            box-shadow: none;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0px 0px 8px rgba(37, 99, 235, 0.2);
        }
        /* Button */
        .btn-primary {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            background-color: #2563EB;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #1E3A8A;
        }
        /* Register Link */
        .register-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #6b7280;
        }
        .register-link a {
            color: #2563EB;
            font-weight: 500;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
 
<body>
    <div class="container">
        <div class="title">Welcome Back</div>
        <div class="subtitle">Login to continue</div>
        
        <form action="/login" method="POST">
            @csrf {{-- CSRF Protection --}}
            
            <div class="mb-3 text-start">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
            
            <div class="register-link">
                Don't have an account? <a href="/register">Sign up here</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
