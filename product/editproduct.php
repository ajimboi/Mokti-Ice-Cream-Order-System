<?php 
global $id;
$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");
if(isset($_GET['ICECREAM_CODE'])){
  $id= $_GET['ICECREAM_CODE']; 
}
$query = "SELECT * FROM ICECREAM WHERE ICECREAM_CODE ='$id'";
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

<h2>EDIT ICE CREAM DETAILS</h2>

<div>
  <form action="">
    <h3>Ice Cream Code : <?php echo $row["ICECREAM_CODE"]; ?></h3><br>
    <input type="hidden" name="ID" value="<?php echo $row["ICECREAM_CODE"]; ?>">
    <label>Ice Cream Name</label>
    <input type="text" name="name" value="<?php echo $row["ICECREAM_NAME"]; ?>">
    <label>Ice Cream Price</label>
    <input type="text" name="price" value="<?php echo $row["ICECREAM_PRICE"]; ?>">
 <input type="submit" name="submit" value="Submit">
  </form>
</div>

</body>
</html>








<?php
}

if(isset($_GET['submit']))
    {
    $name = $_GET["name"];
    $price = $_GET["price"];
    $cid = $_GET["ID"];

    $query = "UPDATE ICECREAM SET ICECREAM_NAME ='$name' , ICECREAM_PRICE = '$price' WHERE ICECREAM_CODE = '$cid'";
    
    $result = oci_parse($dbconn, $query);
    oci_execute($result); 

    if(!oci_parse($dbconn, $query)) {
      echo "<script>alert('Error!');
      window.location='../product_detail.php'</script>";
        exit();
    } else {
      echo "<script>alert('Succesful!');
      window.location='../product_detail.php'</script>";
        exit();
    } 

    oci_close($dbconn);
}
?>
