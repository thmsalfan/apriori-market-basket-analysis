 <?php   
if (!isset($_SESSION['apriori_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "koneksi.php";
include_once "database.php";


 if (isset($_GET['id'])) {  
      $id = $_GET['id'];
      $db_object = new database();

      $query = "DELETE FROM `users` WHERE id = '$id'";  
      }  
 if ($query=$db_object->db_query($query)) { 
          include_once "pengaturan_akun.php";
          header("location:index.php?menu=pengaturan_akun");
          include_once "succes.php"; 
      }else{  
           echo "Error, Terjadi Kesalahan".mysqli_error($conn);  
      }  
 ?> 