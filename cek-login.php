<?php
session_start();
$path_to_root = "";
include $path_to_root . 'database.php';

$db = new database();

$user = strip_tags(trim($_POST['username']));
$pass = strip_tags(trim($_POST['password']));

$sql = get_sql_login_admin_page($user, $pass);

$result = $db->db_query($sql);
$num_rows = $db->db_num_rows($result);

if ($num_rows > 0) {
    $rows = $db->db_fetch_array($result);

        unset($_POST);
        $_SESSION['apriori_id'] = $rows['id'];
        $_SESSION['apriori_username'] = $rows['username'];
        $_SESSION['apriori_level'] = $rows['level'];
        $_SESSION['apriori_nama'] = $rows['nama'];

        $level_name = ($_SESSION['apriori_level']==1)?"admin":"user";
        $_SESSION['apriori_level_name'] = $level_name;
        header("location:index.php");
} else {
    header("location:login.php?login=1");
}

function get_sql_login_admin_page($user, $pass){
    $sql = "SELECT * FROM users"
        . " WHERE username = '" . $user . "' AND password = MD5('" . $pass . "')";
        echo $sql;
    return $sql;
}

?>
