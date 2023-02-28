<?php 
global $uid;
$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");
if(isset($_GET['EMP_ID'])){
  $uid= $_GET['EMP_ID']; 
}
$query = "SELECT * FROM EMPLOYEE WHERE EMP_ID ='$uid'";
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

<h2>EDIT EMPLOYEE DETAILS</h2>

<div>
  <form action="">
    <h3>Employee ID : <?php echo $row["EMP_ID"]; ?></h3><br>
    <input type="hidden" name="EMPID" value="<?php echo $row["EMP_ID"]; ?>">
    <label>Full Name</label>
    <input type="text" name="EMPName" value="<?php echo $row["EMP_NAME"]; ?>">
    <label>Phone Number</label>
    <input type="text" name="EMPPh" value="<?php echo $row["EMP_PHONE_NUM"]; ?>">
    <label>Home Address</label>
    <input type="text" name="EMPAdd" value="<?php echo $row["EMP_ADDRESS"]; ?>">
  
    <input type="submit" name="submit" value="Submit">
  </form>
</div>

</body>
</html>








<?php
}
if(isset($_GET['submit']))
    {
    $name = $_GET["EMPName"];
    $ID = $_GET["EMPID"];
    $address = $_GET["EMPAdd"];
    $phno = $_GET["EMPPh"];

    $query = "UPDATE EMPLOYEE SET EMP_NAME ='$name', EMP_ADDRESS = '$address', EMP_PHONE_NUM = '$phno' WHERE EMP_ID = '$ID'";
    
    $result = oci_parse($dbconn, $query);
    oci_execute($result); 

    if(!oci_parse($dbconn, $query)) {
      echo "<script>alert('Error!');
        window.location='../adminpage.php'</script>";
        exit();
    } else {
        echo "<script>alert('Succesful!');
           window.location='../employee_detail.php'</script>";
        exit();
    } 
    oci_close($dbconn);
  } 
?>
