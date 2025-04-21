<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sisfo Kepegawaian</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
        }

        .login-container h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .login-container .form-control {
            margin-bottom: 15px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4e73df;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #3751a6;
        }

        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }

        .forgot-password a {
            color: #4e73df;
            text-decoration: none;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #666;
        }

        .footer a {
            color: #4e73df;
            text-decoration: none;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="login-container">
        <h1>LOGIN</h1>
        <form action="/sesi/login" method="POST">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Username" value="{{ Session::get('email') }}" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        <div class="forgot-password">
            <a href="#">Forgot your password?</a>
        </div>
        <div class="footer">
            <a href="https://codelatte.org">AgungPajar</a>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>