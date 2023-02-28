<?php
	$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");

	$query = oci_parse($dbconn, "DELETE FROM USERS WHERE USER_ID =" . $_GET["USER_ID"] . "");
	$result = oci_execute($query, OCI_DEFAULT);  
	if($result)  
	{  
		oci_commit($dbconn); //*** Commit Transaction ***// 
        echo "<script>alert('Succesful!');
           window.location='../customer_detail.php'</script>";
	}
	else{
		echo "Error.";
	}
?>