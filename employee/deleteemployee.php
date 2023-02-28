<?php
	$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");

	$query = oci_parse($dbconn, "DELETE FROM EMPLOYEE WHERE EMP_ID ='".$_GET["EMP_ID"]."'");
	$result = oci_execute($query, OCI_DEFAULT);  
	if($result)  
	{  
		oci_commit($dbconn); //*** Commit Transaction ***// 
        echo "<script>alert('Succesful!');
           window.location='../employee_detail.php'</script>";
	}
	else{
		echo "Error.";
	}
?>