 <?php   
if (!isset($_SESSION['apriori_id'])) {
    header("location:index.php?menu=forbidden");
}
include_once "database.php";
include_once "koneksi.php";

 if (isset($_GET['id'])) {  
      $id = $_GET['id'];
      $db_object = new database();

      $query = "DELETE FROM `transaksi` WHERE id = '$id'";  
      }  
 if ($query=$db_object->db_query($query)) { 
          include_once "data_transaksi.php";
          header("location:index.php?menu=hasil");
          include_once "succes.php"; 
      }else{  
           echo "Error, Terjadi Kesalahan".mysqli_error($conn);  
      }  
 ?> 