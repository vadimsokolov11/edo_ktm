<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8" />
    <title>АСУП ООО "УК"Кузбасстрансмет"</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/edo_kuzbasstransmet/img/favicon/ktm.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/edo_kuzbasstransmet/css/style.css">

    <!-- App css -->
    <link href="/edo_kuzbasstransmet/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/edo_kuzbasstransmet/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/edo_kuzbasstransmet/assets/css/theme.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="navbar-brand-box d-flex align-items-left">
                    <a href="" class="logo">
                        <span>
                            АСУП ООО "УК"Кузбасстрансмет"
                        </span>
                    </a>

                    <button type="button"
                        class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect waves-light"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="/<?= APP_BASE_PATH ?>/auth/login" class="waves-effect"><i
                                    class="feather-log-in"></i><span>Вход</span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="feather-info"></i><span>Информация о
                                    компании</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <!-- <div class="page-title-box d-flex align-items-center justify-content-between"> -->
                            <?php echo $content; ?>
                            <!-- </div> -->
                        </div>
                    </div>

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2024 © АСУП ООО "УК"Кузбасстрансмет".
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="/edo_kuzbasstransmet/assets/js/jquery.min.js"></script>
    <script src="/edo_kuzbasstransmet/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/edo_kuzbasstransmet/assets/js/metismenu.min.js"></script>

    <!-- App js -->
    <script src="/edo_kuzbasstransmet/assets/js/theme.js"></script>

</body>

</html>