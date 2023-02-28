<?php 
global $uid;
$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");
if(isset($_GET['USER_ID'])){
  $uid= $_GET['USER_ID']; 
}
$query = "SELECT * FROM USERS WHERE USER_ID ='$uid'";
$result = oci_parse($dbconn, $query);
oci_execute($result,OCI_DEFAULT);
while($row = oci_fetch_array($result,OCI_ASSOC)) {
?>
<!DOCTYPE html>
<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<style>
    h2, h3 {
  font-family: Fredoka, sans-serif;
  text-align :center;
}
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #cf2e2e;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: white;
  color:black;
  border :black;
}

div {
    font-family: arial, sans-serif;
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h2>EDIT CUSTOMER DETAILS</h2>

<div>
  <form action="">
    <h3>Mokti's ID : <?php echo $row["USER_ID"]; ?></h3><br>
    <h3>Username : <?php echo $row["USER_USER"]; ?></h3><br>
    <input type="hidden" name="userID" value="<?php echo $row["USER_ID"]; ?>">
    <label>Full Name</label>
    <input type="text" name="userName" value="<?php echo $row["USER_NAME"]; ?>">
    <label>Email</label>
    <input type="text" name="userEmail" value="<?php echo $row["USER_EMAIL"]; ?>">
    <label>Phone Number</label>
    <input type="text" name="userPh" value="<?php echo $row["USER_PHONE_NUM"]; ?>">
    <label>Home Address</label>
    <input type="text" name="userAdd" value="<?php echo $row["USER_ADDRESS"]; ?>">
    <label>Password</label>
    <input type="text" name="userPass" value="<?php echo $row["USER_PASS"]; ?>">
  
    <input type="submit" name="submit" value="Submit">
  </form>
</div>

</body>
</html>








<?php
}
if(isset($_GET['submit']))
    {
    $name = $_GET["userName"];
    $ID = $_GET["userID"];
    $email = $_GET["userEmail"];
    $address = $_GET["userAdd"];
    $phno = $_GET["userPh"];
    $pass = $_GET["userPass"];

    $query = "UPDATE USERS SET USER_NAME ='$name', USER_EMAIL = '$email', USER_ADDRESS = '$address', USER_PHONE_NUM = '$phno', USER_PASS = '$pass' WHERE USER_ID = '$ID'";
    
    $result = oci_parse($dbconn, $query);
    oci_execute($result); 

    if(!oci_parse($dbconn, $query)) {
      echo "<script>alert('Error!');
        window.location='adminpage.php'</script>";
        exit();
    } else {
        echo "<script>alert('Succesful!');
           window.location='../customer_detail.php'</script>";
        exit();
    } 
    oci_close($dbconn);
  } 
?>
