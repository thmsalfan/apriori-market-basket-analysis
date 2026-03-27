<?php
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
include_once "koneksi.php";

if($_SESSION['apriori_level']==2){
    include_once "akun_user.php";
    header("location:index.php?menu=akun_user");
}

if($_SESSION['apriori_level']==1){
    include_once "akun_admin.php";
    header("location:index.php?menu=akun_admin");
}
?>