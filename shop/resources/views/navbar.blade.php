<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar a img {
            max-width: 80px;
            max-height: 50px;
        }

        .navbar {
            background-color:rgb(0, 127, 253);
        }

        .navbar .container {
            width: 100% !important;
            background: red;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light">
    <div class="container">
        <div class="row row-cols-12">
            <div class="col-3">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('img/logo.png') }}" class="d-inline-block align-top" alt="">
                </a>
            </div>
            <div class="col-6">
            2 of 3 (wider)
            </div>
            <div class="col-3">
            3 of 3
            </div>
        </div>
    </div>
</nav>
</body>
</html>