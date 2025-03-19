<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER FORM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
 
<body>
    <div class="container col-md-6" style="padding-top: 20px">
        <div class="card shadow">
        <div class="card-header text-center">{{ __('REGISTER') }} </div>
        <div class="card-body">
                <form id="registerForm" action="/register-user" method="POST" enctype="multipart/form-data">
                    @csrf {{-- biar data aman --}}

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <span class="error-message text-danger" id="name-error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="email">
                        <span class="error-message text-danger" id="email-error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input name="phone" type="text" class="form-control" id="phone">
                        <span class="error-message text-danger" id="phone-error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <span class="error-message text-danger" id="password-error"></span>
                    </div>

                    <button type="submit" class="btn btn-danger">Insert</button>

                    <small>Already have an account? 
                        <a href="/login">Login Here!</a>
                    </small>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Mencegah form langsung submit

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