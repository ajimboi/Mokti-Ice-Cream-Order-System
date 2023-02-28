<?php
	$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");

	$query = oci_parse($dbconn, "DELETE FROM ICECREAM WHERE ICECREAM_CODE ='".$_GET["ICECREAM_CODE"]."'");
	$result = oci_execute($query, OCI_DEFAULT);  
	if($result)  
	{  
		oci_commit($dbconn); //*** Commit Transaction ***// 
        echo "<script>alert('Succesful!');
      window.location='../product_detail.php'</script>";
	}
	else{
		echo "Error.";
	}
?>