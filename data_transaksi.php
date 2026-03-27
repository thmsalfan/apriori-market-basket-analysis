<?php
if (!isset($_SESSION['apriori_id'])) {
    header("location:index.php?menu=forbidden");
}

require "connection.php";
include_once "koneksi.php";
include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    Data Transaksi
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

if(isset($_POST['submit'])){
    $data = new Spreadsheet_Excel_Reader($_FILES['file_data_transaksi']['tmp_name']);

        $baris = $data->rowcount($sheet_index=0);
        $column = $data->colcount($sheet_index=0);
        for ($i=2; $i<=$baris; $i++) {
            for($c=1; $c<=$column; $c++){
                $value[$c] = $data->val($i, $c);
            }
            $table = "transaksi";
            $temp_date = format_date($value[1]);
            $produkIn = $value[2];
                    
            $produkIn = str_replace(" ,", ",", $produkIn);
            $produkIn = str_replace("  ,", ",", $produkIn);
            $produkIn = str_replace("   ,", ",", $produkIn);
            $produkIn = str_replace("    ,", ",", $produkIn);
            $produkIn = str_replace(", ", ",", $produkIn);
            $produkIn = str_replace(",  ", ",", $produkIn);
            $produkIn = str_replace(",   ", ",", $produkIn);
            $produkIn = str_replace(",    ", ",", $produkIn);
            $produkIn = str_replace(", ", ",", $produkIn);
            $produkIn = str_replace(",  ", ",", $produkIn);
            $produkIn = str_replace(",   ", ",", $produkIn);
            $produkIn = str_replace(",    ", ",", $produkIn);

            $sql = "INSERT INTO transaksi (transaction_date, produk) VALUES ";
            $value_in = array();

            $sql .= " ('$temp_date', '$produkIn')";
            $db_object->db_query($sql);
        }
        ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data berhasil disimpan"); </script>
        <?php
}

if(isset($_POST['delete'])){
    $sql = "TRUNCATE transaksi";
    $db_object->db_query($sql);
    ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data berhasil dihapus"); </script>
        <?php
}
if (isset($_POST["btn-input"])) {
   $tanggal = $_POST['tanggal'];
   $produk = $_POST['produk'];
   if (empty($_POST['tanggal']) || empty($_POST['produk'])) {
        require "failed.php";
   } else {
      $sql = "INSERT INTO `transaksi`(`transaction_date`, `produk`) VALUES ('$tanggal', '$produk')";
      $result = mysqli_query($conn, $sql);
   } 
}
$sql = "SELECT
        *
        FROM
         transaksi";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>            
<div class="row">
    <div class="col-sm-4">
        <div class="widget-box">
        <form method="post" enctype="multipart/form-data" action="">
            <div class="widget-body">
                <div class="widget-main">
                    <div class="form-group">
                        <input type="file" id="id-input-file-2" name="file_data_transaksi" accept="csv"/>

                        <button name="submit" type="submit" value="" class="btn btn-app btn-purple btn-sm">
                            <i class="ace-icon fa fa-cloud-upload bigger-200"></i> Upload
                        </button>
                        <button name="delete" type="submit"  class="btn btn-app btn-danger btn-sm" 
                                onclick="return confirm('Apakah anda yakin ingin menghapus data transaksi?')" >
                            <i class="ace-icon fa fa-trash-o bigger-200"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div>
<form action="" method="post">
    <label>Input Data Transaksi</label>
            <div class="form-group">
                    <Label>Tanggal :</Label><br/>
                    <input class="input-tanggal" name="tanggal" type="date"  placeholder="(DD/MM/YYYY)">
                </div>
                <div class="form-group">
                    <label>Daftar Produk :</label><br/>
                    <input class="input-produk" name="produk" type="text" placeholder="(A, B, ...)">
                    <button type="submit" class="btn btn-success btn" name="btn-input">Simpan</button>
                </div>
    </form>
</div>

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
            
            echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                echo "Data kosong...";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th></th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                        echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['transaction_date'])."</td>";
                            echo "<td>".$row['produk']."</td>";
                            $delete = "<a href='index.php?menu=delete_trans&id=".$row['id']."'><i class='ace-icon fa-color fa fa-trash-o bigger-200'></i></a>";
                            echo "<td>".$delete."</td>";"</td>";
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
        </div>
    </div>
</div>

<?php
function get_produk_to_in($produk){
    $ex = explode(",", $produk);
    for ($i=0; $i < count($ex); $i++) { 

        $jml_key = array_keys($ex, $ex[$i]);
        if(count($jml_key)>1){
            unset($ex[$i]);
        }
    }
    return implode(",", $ex);
if ($result) {
      require "succes.php";
   }
}

?>
<style type="text/css">
    .input-produk{
        width: 50%;
    }
    .hapus{
        text-align: center;
    }
</style>