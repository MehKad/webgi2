<?php
session_start();
$path = "../config/users.json"; // the path of the json file
$users = json_decode(file_get_contents($path), true); // get the data from the path
$check = true;
if (isset($_POST["sbmt"])) { // condition for checking the value submit
   if (isset($_POST["uname"], $_POST["pswd"], $_POST["confpswd"])) {
      if ($_POST["pswd"] == $_POST["confpswd"]) {
         foreach ($users as $u) {
            if ($_POST["uname"] == $u["username"]) {
               $check = false;
               break;
            }
         }
         if ($check) {
            $user = array("username" => $_POST["uname"], "password" => $_POST["pswd"], "score" => 0);
            array_push($users, $user);
            file_put_contents($path, json_encode($users));
         } else {
            echo "username already exists";
         }
      } else {
         echo "not the same password";
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
   <title>Register</title>
</head>

<body>
   <form action="register.php" method="post">
      <label for="uname">username</label>
      <input type="text" name="uname" id="uname">
      <br><br>
      <label for="pswd">Password</label>
      <input type="password" name="pswd" id="pswd">
      <br><br>
      <label for="confpswd">Confirm password</label>
      <input type="password" name="confpswd" id="confpswd">
      <br><br>
      <input type="submit" value="register" name="sbmt">
   </form>
</body>

</html>