<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ChipiChapa Inventory</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background: linear-gradient(135deg, #e3e6eb, #f7f9fc);
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container {
                background: rgba(255, 255, 255, 0.7);
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                text-align: center;
                width: 100%;
                max-width: 400px;
            }
            .btn-custom {
                width: 100%;
                font-size: 16px;
                padding: 12px;
                border-radius: 10px;
                font-weight: 600;
                transition: 0.3s;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .btn-custom:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="mb-4" style="font-weight: 700; color: #333;">Welcome to ChipiChapa Inventory</h1>
            <a href="/login" class="btn btn-success btn-custom mb-3">Login</a>
            <a href="/register" class="btn btn-warning btn-custom">Register</a>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
