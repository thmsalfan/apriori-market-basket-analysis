<?php
//session_start();
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "koneksi.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Pengaturan Akun
                </h1>
            </div>
<?php
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

$sql = "SELECT
        *
        FROM
         users ";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }
            if($_SESSION['apriori_level']==2){
                $deletetbn = "";
            }else{
                $deletetbn = "Delete";
            }
            if($jumlah==0){
                    echo "Data masih kosong";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Edit</th>
                <th>Hapus</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['password']."</td>";
                            echo "<td>".$row['nama']."</td>";
                            echo "<td>".$row['level']."</td>";
                            $edit = "<a href='index.php?menu=edit_akun&id=".$row['id']."'><i class='ace-icon fa fa-cog bigger-200'></i></a>";
                            echo "<td>".$edit."</td>";
                            if($_SESSION['apriori_level']==2){
                                $hapus = "<a><i class='ace-icon fa-color fa fa-lock bigger-200'></a>";
                            }else{
                                $hapus = "<a href='index.php?menu=delete_akun&id=".$row['id']."'><i class='ace-icon fa-color fa fa-trash-o bigger-200'></i></a>";
                            }
                            echo "<td>".$hapus."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
            </table>
            <div class="center">
                <a href="javascript:history.back()" class="btn btn-grey">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Kembali
                                </a>

                <a href="index.php?menu=buat_akun" class="btn btn-yellow">
                    <i class="ace-icon fa fa-pencil"></i>
                        Buat Akun Baru
                </a>
            </div>
            <?php
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.fa-color{
    color: red;
    text-align: center;
}
</style>