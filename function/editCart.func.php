<?php 

include("../config/dbconn.php");
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $quantity = $_POST["QUANTITY"];
    $icecode   = $_GET["ICECREAM_CODE"];

    if(empty($quantity) || $quantity< 1) {
        echo "<script>alert('Please Enter A Minimum of 1 Quantity'); window.location.go(-1);</script>";
        exit();
    }
    
    $query_edit_cart = "UPDATE CART SET ORDER_QTY = '$quantity' WHERE ICECREAM_CODE = '$icecode'";
    $result = oci_parse($dbconn, $query_edit_cart);
    oci_execute($result); 

    if(!oci_parse($dbconn, $query_edit_cart)) {
        echo "<script>alert('Update Failed. Please Try Again.'); window.location.go(-1);</script>";
        exit();
    } else {
        header("Location: ../index.php");
        exit();
    } 

    oci_close($conn);
}

?>