<?php
session_start();

include_once "connection.php";
include_once "database.php";

if(isset($_POST['trans_delete_multiple_btn']))
{
    $all_id = $_POST['trans_delete_id'];
    $extract_id = implode(',' , $all_id);
    echo $extract_id;

    $query = "DELETE FROM `transaksi` WHERE id IN($extract_id) ";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
    }
}
?>