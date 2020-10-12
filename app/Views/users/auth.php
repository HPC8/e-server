<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="<?php echo base_url() ?>/" />

    <title>Login - กรุณาลงชื่อเพื่อเข้าใช้งานระบบ</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css" href="./node_modules/bootstrap/dist/css/bootstrap.css">
    <link href="./assets/fonts/sarabun.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./node_modules/@fortawesome/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="./node_modules/@fortawesome/fontawesome-free/css/regular.css">
    <link rel="stylesheet" type="text/css" href="./node_modules/@fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" type="text/css" href="./node_modules/@fortawesome/fontawesome-free/css/solid.css">

    <link rel="stylesheet" type="text/css" href="./node_modules/jquery-loading/loading.min.css">


    <!-- include vendor stylesheets used in "Login" page. see "application/views/default/pages/partials/page-login/@vendor-stylesheets.hbs" -->


    <!-- include fonts -->
    <link rel="stylesheet" type="text/css" href="./dist/css/ace-font.css">



    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="./dist/css/ace.css">


    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/favicon.png" />

    <!-- "Login" page styles, specific to this page for demo only -->
    <link rel="stylesheet" type="text/css" href="./application/views/default/pages/partials/page-login/@page-style.css">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body>
    <div class="body-container">

        <div class="main-container container bgc-transparent">

            <div class="main-content minh-100 justify-content-center">
                <div class="p-2 p-md-4">
                    <div class="row" id="row-1">
                        <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">

                            <div class="row" id="row-2">

                                <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
                                    <!-- the left side section is carousel in this demo, to show some example variations -->

                                    <div id="loginBgCarousel" class="carousel slide minw-100 h-100">
                                        <ol class="d-none carousel-indicators">
                                            <li data-target="#loginBgCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#loginBgCarousel" data-slide-to="1"></li>
                                            <li data-target="#loginBgCarousel" data-slide-to="2"></li>
                                            <li data-target="#loginBgCarousel" data-slide-to="3"></li>
                                        </ol>

                                        <div class="carousel-inner minw-100 h-100">
                                            <div class="carousel-item active minw-100 h-100">
                                                <div class="px-3 bgc-blue-l4 d-flex flex-column align-items-center justify-content-center">
                                                    <a class="mt-3 text-center">
                                                        <img src="./assets/image/logo/logo8.png" width="60%" />
                                                    </a>
                                                    <h4 class="mt-4 text-primary-d1">
                                                        E-Service <span class="text-80 text-dark-l1">Application</span>
                                                    </h4>

                                                    <div class="text-center mx-4 text-dark-tp3">
                                                        <span class="text-90">
                                                            ระบบสนับสนุนการปฏิบัติงานของเจ้าหน้าที่
                                                            <p>ศูนย์อนามัยที่ 8 อุดรธานี</p>
                                                        </span>
                                                        <hr class="mb-1 brc-black-tp10" />
                                                    </div>
                                                    <div class="text-center text-90 text-dark-tp2">
                                                        <small>
                                                            ศูนย์อนามัยที่ 8 อุดรธานี | กรมอนามัย | กระทรวงสาธารณสุข
                                                            <p>© Copyright 2019, ICT ศูนย์อนามัยที่ 8 อุดรธานี</p></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">
                                    <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">
                                        <div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                                            <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                                                <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-110">
                                                    <i class="fa fa-coffee text-orange-m1 mr-1"></i>
                                                    กรุณาลงชื่อเพื่อเข้าใช้งานระบบ
                                                </h4>
                                            </div>

                                            <div class="d-lg-none text-secondary-m1 my-4 text-center">
                                                <a class="mt-3 text-center">
                                                    <img src="./assets/image/logo/logo8.png" width="50%" />
                                                </a>
                                                <h1 class="text-170">
                                                    <span class="mt-4 text-blue-d1">
                                                        E-Service <span class="text-70 text-dark-tp3">Application</span>
                                                    </span>
                                                </h1>
                                            </div>

                                            <form autocomplete="off" class="form-row mt-4" id="auth-form" method="post">

                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                                        <input type="text" class="form-control auth-account pr-4 shadow-none" id="auth-account" name="account" />
                                                        <label class="floating-label text-grey-l1 ml-n3" for="auth-account">
                                                            Account
                                                        </label>
                                                    </div>
                                                    <input type="hidden" class="form-control auth-account-err">
                                                </div>

                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
                                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                                        <input type="password" name="password" class="form-control auth-password pr-4 shadow-none" spellcheck="false" id="auth-password" />
                                                        <label class="floating-label text-grey-l1 ml-n3" for="auth-password">
                                                            Password
                                                        </label>
                                                        <a href="#" id="toggle-password" class="btn btn-sm border-0 btn-white btn-h-light-orange btn-a-light-orange text-100 ml-n5 no-underline radius-1 d-style">
                                                            <i class="fa fa-eye-slash text-90 d-n-active w-3"></i>
                                                            <i class="fa fa-eye text-90 d-active w-3"></i>
                                                        </a>
                                                    </div>
                                                    <input type="hidden" class="form-control auth-password-err">
                                                </div>


                                                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-right text-md-right mt-n2 mb-2">
                                                    <a href="#" class="text-primary-m1 text-95" data-toggle="tab" data-target="#id-tab-forgot">
                                                        Forgot Password?
                                                    </a>
                                                </div>


                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">

                                                    <button id="auth-submit" type="button" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4">
                                                        Sign In
                                                    </button>
                                                </div>
                                            </form>

                                            <div class="form-row">
                                                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                                                    <hr class="brc-default-l2 w-100 mb-2" />
                                                    <div class="mt-n4 bgc-white-tp2 px-3 py-1 text-secondary-d3 text-90">
                                                        Login with Social Media</div>
                                                    <div class="my-2">
                                                        <a href='https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=<?php echo $line['client_id']; ?>&redirect_uri=<?php echo $line['redirect_uri']; ?>&state=ci&scope=profile%20openid&nonce=_ls978_&max_age=0' class="btn btn-bgc-white btn-lighter-success btn-h-success btn-a-success btn-lg px-25 mx-1">
                                                            <i class="fab fa-line text-190"></i>
                                                        </a>
                                                        <a href='#' class="btn btn-bgc-white btn-lighter-primary btn-h-primary btn-a-primary btn-lg px-25 mx-1">
                                                            <i class="fab fa-facebook text-190"></i>
                                                        </a>
                                                        <a href='#' class="btn btn-bgc-white btn-lighter-danger btn-h-danger btn-a-danger btn-lg px-25 mx-1">
                                                            <i class="fab fa-google-plus text-190"></i>
                                                        </a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                        <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
                                            <div class="position-tl ml-3 mt-2">
                                                <a href="#" class="btn btn-light-default btn-h-light-default btn-a-light-default btn-bgc-tp" data-toggle="tab" data-target="#id-tab-login">
                                                    <i class="fa fa-arrow-left"></i>
                                                </a>
                                            </div>


                                            <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5 px-0">
                                                <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l2 pb-1 text-130">
                                                    <i class="fa fa-key text-brown-m1 mr-1"></i>
                                                    Recover Password
                                                </h4>
                                            </div>


                                            <form autocomplete="off" class="form-row mt-4">
                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                                    <label class="text-secondary-d3 mb-3">
                                                        Enter your email address and we'll send you the instructions:
                                                    </label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="email" class="form-control form-control-lg pr-4 shadow-none" id="id-recover-email" placeholder="Email" />
                                                        <i class="fa fa-envelope text-grey-m2 ml-n4"></i>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-1">
                                                    <button type="button" class="btn btn-orange btn-block px-4 btn-bold mt-2 mb-4">
                                                        Continue
                                                    </button>
                                                </div>
                                            </form>


                                            <div class="form-row w-100">
                                                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex flex-column align-items-center justify-content-center">

                                                    <hr class="brc-default-l2 mt-0 mb-2 w-100" />

                                                    <div class="p-0 px-md-2 text-dark-tp4 my-3">
                                                        <a class="text-blue-d1 text-600 btn-text-slide-x" data-toggle="tab" data-target="#id-tab-login" href="#">
                                                            <i class="btn-text-2 fa fa-arrow-left text-110 align-text-bottom mr-2"></i>Back
                                                            to Login
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-lg-none my-3 text-white-tp1 text-center">
                        <small>
                            ศูนย์อนามัยที่ 8 อุดรธานี | กรมอนามัย | กระทรวงสาธารณสุข
                            <p>© Copyright <?= date("Y") + 543; ?>, ICT ศูนย์อนามัยที่ 8 อุดรธานี</p></small>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        var baseurl = "<?php echo base_url() ?>/";
    </script>
    <!-- include common vendor scripts used in demo pages -->
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="./node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <script src="./node_modules/jquery-loading/jquery.loading.min.js"></script>

    <!-- include ace.js -->
    <script src="./dist/js/ace.js"></script>

    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
    <script src="./assets/js/demo.js"></script>

    <!-- "Login" page script to enable its demo functionality -->
    <script src="./application/views/default/pages/partials/page-auth/@page-script.js"></script>
</body>

</html>