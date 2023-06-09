<?php

include 'koneksi.php';

session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($koneksi, $_POST['username']);
   $usermail = ($_POST['usermail']);
   $pass = ($_POST['password']);
   $cpass = ($_POST['cpassword']);

   $select = " SELECT * FROM tbl_login WHERE username = '$username' && usermail = '$usermail' && password = '$pass'";

   $result = mysqli_query($koneksi, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist';
   }else{
      if($pass != $cpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO tbl_login(username, usermail, password) VALUES('$username','$usermail','$pass')";
         mysqli_query($koneksi, $insert);
         header('location:index.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="form-container">

   <form action="" method="post">
      <h3 class="title">register now</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <input type="text" name="username" placeholder="enter your username" class="box" required>
      <input type="usermail" name="usermail" placeholder="enter your usermail" class="box" required>
      <input type="password" name="password" placeholder="enter your password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm your password" class="box" required>
      <input type="submit" value="register now" class="form-btn" name="submit">
      <p>already have an account? <a href="login.php">login now!</a></p>
   </form>

</div>

</body>
</html>