<?php 

include("../config/dbconn.php");
session_start();


//VALIDATE IF NO LOGIN, USER CANNOT ADD TO CART


if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $quantity  = $_POST["quantity"];
    $userID    = $_SESSION["USER_ID"];
    $icecode = $_POST["icecode"];
    $ordertime = date("h:i");
    $orderdate = date("d-m-Y");



    $sql= "INSERT INTO CART (USER_ID, ORDER_QTY, ICECREAM_CODE, ORDER_DATE, ORDER_TIME) VALUES ('$userID','$quantity','$icecode','$orderdate','$ordertime')";
    $result = oci_parse($dbconn, $sql);
    oci_execute($result); 

    if(!oci_parse($dbconn, $sql)) {
        echo $sql;
        exit();
        echo "<script>alert('Succesful!');
           window.location='../index.php'</script>";
        exit();
    } 

    oci_close($dbconn);
}

header("Location:../index.php");
?>