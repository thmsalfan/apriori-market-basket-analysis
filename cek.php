<?php
session_start();

if ( isset($_SESSION['apriori_id_reset']) ) {
    header("location:reset.php");
}

$cek = 0;
if (isset($_GET['cek'])) {
    $cek = $_GET['cek'];
}

if ($cek == 1) {
    $komen = "Silahkan Cek Username";
}

include_once "fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Data Mining Apriori</title>
        <link href="assets/images/icon/favicon.png" rel="shortcut icon" />
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <script src="assets/js/ace-extra.min.js"></script>
    </head>

    <body class="no-skin">
        <!--HEADER-->
        <?php
        include "header.php";
        ?>
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <!--CONTENT MAIN-->
            <div class="main-content">
                <div class="main-content-inner">
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">

                                    <?php
                                if (isset($komen)) {
                                    display_error("Username Tidak Ditemukan");
                                }
                                ?>
                                    <div class="space-6"></div>
                                    <div class="col-sm-6">
                                        <img width="320px" hight="auto" src="img/xyz.jpg">
                                        <h1>
                                            Aplikasi Data Mining Algoritma Apriori
                                        </h1>
                                        <p class="lead">
                                            Penerapan Data mining dalam penjualan produk dengan menggunakan Algoritma Apriori pada Minimarket Aciak Mart
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="header blue lighter bigger">
                                            <i class="ace-icon fa fa-key"></i>
                                            Reset Password Akun
                                        </h4>
                                        <form method="post" action="cek-user.php" >
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" class="form-control"
                                                            name="username" placeholder="Username" />
                                                        <i class="ace-icon fa fa-user"></i>
                                                    </span>
                                                </label>

                                                <div class="space"></div>

                                                <div class="clearfix">
                                                    <a href="login.php">Batal</a>
                                                    <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                        <i class="ace-icon fa fa-key"></i>
                                                        <span class="bigger-110">Cek</span>
                                                    </button>
                                                </div>

                                                <div class="space-4"></div>
                                            </fieldset>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include "footer.php";
            ?>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement)
                    document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-ui.custom.min.js"></script>
        <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/js/jquery.easypiechart.min.js"></script>
        <script src="assets/js/jquery.sparkline.index.min.js"></script>
        <script src="assets/js/jquery.flot.min.js"></script>
        <script src="assets/js/jquery.flot.pie.min.js"></script>
        <script src="assets/js/jquery.flot.resize.min.js"></script>
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>


    </body>
</html>


