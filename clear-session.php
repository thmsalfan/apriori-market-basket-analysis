<?php

$status = $_GET["s"];

if ($status == 1) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
} else {
    session_start();
    session_unset();
    session_destroy();

    echo "<script> alert('Password Berhasil Diubah'); document.location.href = 'login.php' </script>";
}


exit();
?>