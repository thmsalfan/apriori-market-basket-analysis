<?php
require "connection.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
   $username = $_POST['username'];
   $nama = $_POST['nama'];
   $password = $_POST['password'];
   $level = $_POST['level'];
   $encrypted = md5($password);
   if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['level']) || empty($_POST['nama'])) {
        require "failed.php";
   } else {
      $sql = "UPDATE `users` SET `username`='$username',`nama`='$nama',`password`='$encrypted',`level`='$level' WHERE id = $id";
      $result = mysqli_query($conn, $sql);
   }

  if ($result) {
    require "succes.php";
    header("Location: index.php?pengaturan_akun.php");
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <div class="page-header">
                <h1>
                    Edit Akun
                </h1>
            </div>
    <div class="text-center mb-4">
      <h2>Edit Informasi Akun</h2>
    </div>

    <?php
    $sql = "SELECT * FROM 'users' WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Username :</label>
            <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>">
          </div> 

          <div class="col">
            <label class="form-label">Password :</label>
            <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Nama :</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $row['nama'] ?>">
        </div>

        <div class="from-group mb-3">
                  <label for="">Level</label>
                  <select name="level" class="form-control">
                     <option value="">--Pilih Level--</option>
                     <option id="admin" value="1" <?php echo ($row["level"] == '1') ? "checked" : ""; ?>>Admin</option>
                     <option id="user" value="2" <?php  echo ($row["level"] == '2') ? "checked" : ""; ?>>User</option>
                  </select>
        </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Perbarui</button>
          <a href="index.php?menu=pengaturan_akun" class="btn btn-danger">Batal</a>
        </div>
      </form>
    </div>
  </div>


</body>