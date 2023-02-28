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

<h2>ADD NEW ICE CREAM DETAILS</h2>

<div>
  <form action="">
    <label>Ice Cream Code</label>
    <input type="text" name="ID" placeholder="ex : M01">
    <label>Ice Cream Name</label>
    <input type="text" name="name">
    <label>Ice Cream Price</label>
    <input type="text" name="price" placeholder="number only">
 <input type="submit" name="submit" value="Submit">
  </form>
</div>

</body>
</html>

<?php
$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");

if(isset($_GET['submit']))
    {
    $name = $_GET["name"];
    $price = $_GET["price"];
    $id = $_GET["ID"];

    $query = "INSERT INTO ICECREAM (ICECREAM_NAME, ICECREAM_CODE, ICECREAM_PRICE) VALUES ('$name','$id','$price')";
    
    $result = oci_parse($dbconn, $query);
    oci_execute($result); 

    if(!oci_parse($dbconn, $query)) {
      echo "<script>alert('Error!');
      window.location='../customer_detail.php'</script>";
        exit();
    } else {
      echo "<script>alert('Succesful!');
      window.location='../product_detail.php'</script>";
        exit();
    } 

    oci_close($dbconn);
}
?>
