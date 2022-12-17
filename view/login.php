<?php
session_start();
if (array_key_exists("username", $_SESSION)) {
   header("localtion:../index.php");
}

$path = "../config/users.json";

$users = json_decode(file_get_contents($path), true);
$check = false;
if (isset($_POST["sbmt"])) {
   if (isset($_POST["uname"], $_POST["pswd"])) {
      foreach ($users as $i) {
         if ($i["username"] == $_POST["uname"] && $i["password"] == $_POST["pswd"]) {
            $check = true;
            break;
         }
      }
      if ($check) {
         $_SESSION["username"] = $_POST["uname"];
         header("location:../index.php");
      } else {
         echo "username and or password is incorrect";
      }
   }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
</head>

<body>
   <form action="login.php" method="post">
      <label for="uname">username</label>
      <input type="text" name="uname" id="uname">
      <br><br>
      <label for="pswd">Password</label>
      <input type="password" name="pswd" id="pswd">
      <br><br>
      <input type="submit" value="Login" name="sbmt">
      <button><a href="register.php">Register</a></button>
   </form>
</body>

</html>