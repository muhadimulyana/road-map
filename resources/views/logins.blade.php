<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Road Map PAN ERA GROUP</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="assets/login/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="assets/login/css/iofrm-theme10.css">
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="form-holder">
                <div class="form-content" style="padding: 20px;">
                    <div class="form-items" style="padding: 30px; background-color: rgba(255, 255, 255, 0.18); border-radius: 20px">
                        <img class="logo-size" src="assets/img/p.png" width="80px" alt="">
                        <h3 style="margin-top: 20px">Road Map</h3>
                        <div class="page-links">
                            <a href="javascript:void(0)" class="active">Login</a>
                        </div>
                        <form method="POST" action={{ route('login') }}>
                            @csrf
                            <input class="form-control @error('username') is-invalid @enderror" type="text" value="{{ old('username') }}" name="username" autocomplete="off" placeholder="Usename" required>
                            <input class="form-control" type="password" name="password" autocomplete="off" placeholder="Password" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                        @error('username')
                        <div class="other-links">
                            <span style="font-weight: 700; margin-right: 0 !important;">{{ $message }}</span>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="assets/login/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/login/js/popper.min.js"></script>
<script type="text/javascript" src="assets/login/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/login/js/main.js"></script>
</body>
</html>