<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | ChipiChapa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Custom Styles -->
    <style>
        body {
            background: #f4f7fc; /* Soft gray-blue */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
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
        .error-message {
            font-size: 12px;
            color: #dc3545;
            text-align: left;
            margin-top: 5px;
        }
    </style>
</head>
 
<body>
    <div class="container">
        <div class="title">Create an Account</div>
        <div class="subtitle">Join us and start your journey</div>

        <form id="registerForm" action="/register-user" method="POST" enctype="multipart/form-data">
            @csrf {{-- CSRF Protection --}}

            <div class="mb-3 text-start">
                <label for="name" class="form-label">Full Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter your full name">
                <span class="error-message" id="name-error"></span>
            </div>

            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email Address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                <span class="error-message" id="email-error"></span>
            </div>

            <div class="mb-3 text-start">
                <label for="phone" class="form-label">Phone Number</label>
                <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                <span class="error-message" id="phone-error"></span>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Create a password">
                <span class="error-message" id="password-error"></span>
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>

            <div class="register-link">
                Already have an account? <a href="/login">Login Here</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Form Validation -->
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            let isValid = true;

            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let phone = document.getElementById("phone").value.trim();
            let password = document.getElementById("password").value.trim();

            document.getElementById("name-error").innerText = "";
            document.getElementById("email-error").innerText = "";
            document.getElementById("phone-error").innerText = "";
            document.getElementById("password-error").innerText = "";

            if (name === "") {
                document.getElementById("name-error").innerText = "Name is required.";
                isValid = false;
            }

            if (!email.match(/^\S+@\S+\.\S+$/)) {
                document.getElementById("email-error").innerText = "Invalid email format.";
                isValid = false;
            }

            if (!phone.match(/^08\d{8,}$/)) {
                document.getElementById("phone-error").innerText = "Phone number must start with '08' and have at least 10 digits.";
                isValid = false;
            }

            if (password.length < 6) {
                document.getElementById("password-error").innerText = "Password must be at least 6 characters.";
                isValid = false;
            }

            if (isValid) {
                this.submit();
            }
        });
    </script>
</body>
</html>
