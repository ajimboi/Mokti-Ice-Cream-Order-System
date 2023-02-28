<?php
	include('../config/dbconn.php');

	$query = oci_parse($dbconn, "DELETE FROM CART WHERE ICECREAM_CODE ='".$_GET["ICECREAM_CODE"]."'");
	$result = oci_execute($query, OCI_DEFAULT);  
	if($result)  
	{  
		oci_commit($dbconn); //*** Commit Transaction ***// 
		echo "Data Deleted Successfully.";
        header("Location:../index.php");
	}
	else{
		echo "Error.";
	}
?>