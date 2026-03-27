<?php
require "connection.php";

if (isset($_POST["submit"])) {
   $username = $_POST['username'];
   $nama = $_POST['nama'];
   $password = $_POST['password'];
   $level = $_POST['level'];
   $encrypted = md5($password);
   if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['level']) || empty($_POST['nama'])) {
        require "failed.php";
   } else {
      $query = mysql_query("SELECT 'username' FROM 'users' WHERE 'username'='$username'");
      if (mysql_num_rows($query) != 0)
      {
         require "failed.php";
      } else {
         $sql = "INSERT INTO `users`(`username`, `nama`, `password`, `level`) VALUES ('$username', '$nama', '$encrypted', '$level')";
         $result = mysqli_query($conn, $sql);
      }
   }
   
   if ($result) {
      require "succes.php";
      header("Location:index.php?pengaturan_akun.php");
   } 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <div class="container">
      <div class="page-header">
                <h1>
                    Buat Akun
                </h1>
            </div>
      <div class="text-center">
         <h2 class="text-muted">Lengkapi data dan informasi untuk pengguna baru</h2>
      </div>
      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Username :</label>
                  <input type="text" class="form-control" name="username" placeholder="User">
               </div>

               <div class="col">
                  <label class="form-label">Password :</label>
                  <input type="text" class="form-control" name="password" placeholder="">
               </div>
               <div class="mb-3">
                  <label class="form-label">Nama :</label>
                  <input type="text" class="form-control" name="nama" placeholder="IT Manager">
               </div>
               </div>

            <div class="from-group mb-3">
                  <label for="">Level</label>
                  <select name="level" class="form-control">
                     <option value="">--Pilih Level--</option>
                     <option value="1">Admin</option>
                     <option value="2">User</option>
                  </select>
            </div>
            <div>
               <button type="submit" class="btn btn-success" name="submit">Simpan</button>
               <a href="index.php?menu=pengaturan_akun" class="btn btn-danger">Batal</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>