<?php 

include("include/dbconn.php");
session_start();


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $icecode = $_GET["ICECREAM_CODE"];
    $icename   = $_POST["ICECREAM_NAME"]; 
	$iceprice  = $_POST["ICECREAM_PRICE"]; 

    $query = "UPDATE ICECREAM SET ICECREAM_NAME ='$icename' , ICECREAM_PRICE = '$iceprice' WHERE ICECREAM_CODE = '$icecode'";
    
    $result = oci_parse($conn, $query);
    oci_execute($result); 

    if(!oci_parse($conn, $query_edit_cart)) {
        echo "<script>alert('Update Failed. Please Try Again.'); window.location.go(-1);</script>";
        exit();
    } else {
        header("Location: addproduct.php");
        exit();
    } 

    oci_close($conn);
}

?>

