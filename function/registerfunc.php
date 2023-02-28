<?php
    $dbconn = oci_connect("PROJECT502", "system", "localhost/XE");

    if (isset($_POST['submit'])) 
    {
      $custid=$_POST['custid'];
      $custname=$_POST['custname'];
      $custphone=$_POST['custphone'];
      $custemail=$_POST['custemail'];
      $custadd=$_POST['custadd'];
      $custusername = $_POST['custusername'];
      $custpass = $_POST['custpass'];

      $sql= oci_parse($dbconn, "INSERT INTO USERS(USER_ID,USER_USER,USER_PASS,USER_NAME,USER_PHONE_NUM,USER_EMAIL,USER_ADDRESS) VALUES  ('$custid','$custusername','$custpass','$custname','$custphone','$custemail','$custadd')");
      $result=oci_execute($sql);
      if($result){
        echo "<script>alert('Succesful!');
           window.location='../login.php'</script>";
      }
      else{
      echo "<script>alert('Error!');
        window.location='../signup.php'</script>";
      }
    }
?>