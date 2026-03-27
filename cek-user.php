<?php
use database;
session_start();
$path_to_root = "";
include $path_to_root . 'database.php';

$db = new database($path_to_root . 'koneksi.php');

$user = strip_tags(trim($_POST['username']));

$sql = get_sql_cek_user($user);

$result = $db->db_query($sql);
$num_rows = $db->db_num_rows($result);

if ($num_rows > 0) {
    $rows = $db->db_fetch_array($result);

        unset($_POST);
        $_SESSION['apriori_id_reset'] = $rows['id'];
        $_SESSION['apriori_username'] = $rows['username'];
        $_SESSION['apriori_level'] = $rows['level'];
        $_SESSION['apriori_nama'] = $rows['nama'];

        header("location:reset.php");
} else {
    header("location:cek.php?cek=1");
}

function get_sql_cek_user($user){
    $sql = "SELECT * FROM users"
        . " WHERE username = '" . $user . "'";
        echo $sql;
    return $sql;
}

?>
