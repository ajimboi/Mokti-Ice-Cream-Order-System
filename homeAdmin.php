<?php
session_start();
$username = $_SESSION['USER_NAME'];
?>

<!DOCTYPE html>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
    <head>
    <style>
body {
  background-image: url(../images/bg.png);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
h2, h3 {
  font-family: Fredoka, sans-serif;
  text-align :center;
}

.welcome {
  margin-top: 250px;
}
</style>
    </head>
    <body>
<?php
include ('dbconn.php');

$sql = "SELECT USER_NAME FROM USERS WHERE USER_NAME='$username'";
$result = oci_parse($dbconn, $sql);
oci_execute($result);

while($row = oci_fetch_array($result,OCI_ASSOC))
{
 echo '
        <div class="welcome">
        <h2>Mokti\'s Ice Cream Management System</h2>
        <h3>Welcome '.$row["USER_NAME"].'</h3>
        </div>
      ';
}
?>
    </body>