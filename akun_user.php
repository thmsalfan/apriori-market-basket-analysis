<?php
include_once "database.php";
include_once "koneksi.php";
include_once "fungsi.php";

$nama = $_SESSION['apriori_nama'];
$level = $_SESSION['apriori_level'];
?>


<div class="main-content">
    <div class="main-content-inner">
        
        <div class="page-content">
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="error-container">
                        <div class="well">
                            <h1 class="grey lighter smaller">
                                <span class="blue bigger-125">
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                                Informasi Akun
                            </h1>

                            <hr />
                            <h3 class="lighter smaller">
                                Nama : <?php echo "$nama"; ?>
                            </br>
                            	Akses : Level <?php echo "$level"; ?>
                            </h3>

                            <div class="space"></div>

                            

                            <hr />
                            <div class="space"></div>

                            <div class="center">
                                <a href="javascript:history.back()" class="btn btn-grey">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Kembali
                                </a>

                                <a href="index.php" class="btn btn-primary">
                                    <i class="ace-icon fa fa-home"></i>
                                    Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

