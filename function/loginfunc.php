<?php
    session_start();
    if(count($_POST)>0) {
        $conn = oci_connect('PROJECT502', 'system', 'localhost/XE');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            
        $sql = "SELECT * FROM USERS WHERE USER_USER ='" . $_POST["username"] . "' and USER_PASS = '". $_POST["password"]."'"; 
        $result = oci_parse($conn, $sql);

        oci_execute($result); 
        $row  = oci_fetch_assoc($result);
        if(is_array($row)) {
        $_SESSION["USER_ID"] = $row['USER_ID'];
        $_SESSION["USER_NAME"] = $row['USER_NAME'];
        $_SESSION['USER_LEVEL']  = $row['USER_LEVEL'];
        header("Location:../index.php");
          }
          else{
          echo "<script>alert('Error!');
            window.location='../login.php'</script>";
          }
    }
?>