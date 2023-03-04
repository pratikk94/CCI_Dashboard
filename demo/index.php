<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DCPCR FLN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
<body class="img js-fullheight" style="background-image: url(login.jpg);">
<section class="ftco-section">
    <div class="container">
        <img src="logo_dcpcr.jpg"/>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">CCI Panel</h2>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">

                    <form class="pt-3" action="login_action.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="uname" required>
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" class="form-control" name="password"
                                   placeholder="Password" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="form-control btn btn-primary submit px-3">Sign
                                In
                            </button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
