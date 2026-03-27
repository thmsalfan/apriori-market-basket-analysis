<?php
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
include_once "koneksi.php";

if($_SESSION['apriori_level']==2){
    include_once "hasiluser.php";
    header("location:index.php?menu=hasiluser");
}

if($_SESSION['apriori_level']==1){
    include_once "hasil.php";
    header("location:index.php?menu=hasil");
}
?>