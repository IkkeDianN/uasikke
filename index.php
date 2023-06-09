<?php

include 'koneksi.php';

session_start();

 if(isset($_POST['submit'])){
    
   $username = $koneksi->real_escape_string($_POST['username']);
   $pass = ($_POST['password']);

  
   $st=$koneksi->prepare("SELECT * FROM tbl_login WHERE username = ? && password = ?");
   $st->bind_param("ss",$username,$pass);
   $st->execute();
   $hasil=$st->get_result();
  

   if($hasil->num_rows > 0){
      $_SESSION['username'] = $username;
      header('Location: home.php');
   }else{
      echo "<script language='javascript'>";
        echo "alert('User atau Password tidak sesuai');";
        echo "window.location.href = 'index.php';";
        echo '</script>';
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
        <h3 class="title">login now</h3>
        <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
        <input type="name" name="username" placeholder="enter your username" class="box" required>
        <input type="password" name="password" placeholder="enter your password" class="box" required>
        <input type="submit" value="login now" class="form-btn" name="submit">
        <p>don't have an account? <a href="register.php">register now!</a></p>
    </form>

</div>

</body>
</html>