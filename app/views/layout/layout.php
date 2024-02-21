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

    <!-- Plugins css -->
    <link href="/edo_kuzbasstransmet/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
        <link href="/edo_kuzbasstransmet/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="/edo_kuzbasstransmet/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/edo_kuzbasstransmet/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
        <link href="/edo_kuzbasstransmet/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="/edo_kuzbasstransmet/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                    <a href="/<?= APP_BASE_PATH ?>/main" class="logo">
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

                <div class="d-flex align-items-center">


                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect waves-light"
                            id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-3.jpg"
                                alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1">Madhly</span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Настройки
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                <span>Профиль</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="/<?= APP_BASE_PATH ?>/auth/logout">
                                <span>Выход</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="#" class="waves-effect"><span>АСУП ООО "УК"Кузбасстрансмет"</span></a>
                        </li>
                        <li>
                            <a href="/<?= APP_BASE_PATH ?>/main" class="waves-effect"><i
                                    class="feather-home"></i><span>Главная</span></a>
                        </li>

                        <li>
                            <a href="/<?= APP_BASE_PATH ?>/monitoring" class="waves-effect"><i
                                    class="feather-monitor"></i><span>Мониторинг</span></a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="feather-briefcase"></i><span>Документы</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="#">Наряды</a></li>
                                <li><a href="#">Приказы</a></li>
                                <li><a href="#">Распоряжения</a>
                                <li><a href="#">Чертежи</a>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="feather-airplay"></i><span>ТОиР</span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="feather-airplay"></i><span>Нерабочее
                                    оборудование</span></a>
                        </li>
                        <li>
                            <a href="/<?= APP_BASE_PATH ?>/product" class="waves-effect"><i
                                    class="feather-airplay"></i><span>Продукция</span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="feather-user"></i><span>Склад</span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect"><i class="feather-user"></i><span>Больничные</span></a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="feather-user"></i><span>Пользователи</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/<?= APP_BASE_PATH ?>/users">Пользователи</a></li>
                                <li><a href="/<?= APP_BASE_PATH ?>/roles">Роли</a></li>
                                <li><a href="/<?= APP_BASE_PATH ?>/positions">Должности</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/<?= APP_BASE_PATH ?>/pages" class="waves-effect"><i
                                    class="feather-book-open"></i><span>Страницы</span></a>
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
            <!-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2024 © АСУП ООО "УК"Кузбасстрансмет".
                        </div>
                    </div>
                </div>
            </footer> -->

        </div>

    </div>

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="/edo_kuzbasstransmet/assets/js/jquery.min.js"></script>
    <script src="/edo_kuzbasstransmet/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/edo_kuzbasstransmet/assets/js/metismenu.min.js"></script>

    <!-- Plugins js -->
    <script src="/edo_kuzbasstransmet/plugins/autonumeric/autoNumeric-min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/moment/moment.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/select2/select2.min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/switchery/switchery.min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="/edo_kuzbasstransmet/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <!-- App js -->
    <script src="/edo_kuzbasstransmet/assets/js/theme.js"></script>

</body>

</html>