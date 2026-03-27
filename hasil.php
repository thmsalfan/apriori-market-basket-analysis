<?php
if (!isset($_SESSION['apriori_toko_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
include_once "koneksi.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Hasil
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
         process_log ";
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
                <th>Start Date</th>
                <th>End Date</th>
                <th>Min Support</th>
                <th>Min Confidence</th>
                <th>View</th>
                <th>PDF</th>
                <th>Delete</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                        echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['start_date'])."</td>";
                            echo "<td>".format_date2($row['end_date'])."</td>";
                            echo "<td>".$row['min_support']."%"."</td>";
                            echo "<td>".$row['min_confidence']."%"."</td>";
                            $view = "<a href='index.php?menu=view_rule&id_process=".$row['id']."'><i class='ace-icon fa fa-eye bigger-200'></i></a>";
                            echo "<td>".$view."</td>";
                            echo "<td>";
                            echo "<a href='export/CLP.php?id_process=".$row['id']."' "
                                    . "class='btn btn-app btn-light btn-xs' target='blank'>
                                    <i class='ace-icon fa fa-print bigger-160'></i>
                                    Print
                                </a>";
                            echo "</td>";
                            if($_SESSION['apriori_level']==2){
                                $delete = "<a><i class='ace-icon fa-color fa fa-lock bigger-200'></a>";
                            }else{
                                $delete = "<a href='index.php?menu=delete_record&id=".$row['id']."'><i class='ace-icon fa-color fa fa-trash-o bigger-200'></i></a>";
                            }
                            echo "<td>".$delete."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
            </table>
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