<?php

    include('config/dbconn.php'); 
    session_start();

    if (isset($_POST['submit'])) 
    {
      $userID = $_SESSION['USER_ID'];
      $usernum = $_POST['phone'];
      $useraddress = $_POST['address'];
      $pmode = $_POST['pmode'];
      $totalprice =$_POST['TOTAL_PRICE'];
      $ordertime = date("h:i");
      $orderdate = date("d-m-Y");

      $sql= oci_parse($dbconn, "INSERT INTO ORDERS (ORDER_DATE, ORDER_TIME, PAYMENT_MODE,AMOUNT_PAID, USER_PHONE_NUM, USER_ADDRESS,USER_ID) VALUES  ('$orderdate','$ordertime','$pmode','$totalprice','$usernum','$useraddress','$userID')");
      $result=oci_execute($sql);

      $sql2= oci_parse($dbconn, "INSERT INTO ORDERICECREAM (USER_ID, ORDER_QTY, ICECREAM_CODE, ORDER_DATE, ORDER_TIME) SELECT USER_ID, ORDER_QTY, ICECREAM_CODE, ORDER_DATE, ORDER_TIME FROM CART");
      $result2=oci_execute($sql2);

      $sql3= oci_parse($dbconn, "DELETE FROM CART");
      $result3=oci_execute($sql3);

      $sql4= oci_parse($dbconn, "SELECT ORDER_ID FROM ORDERS WHERE USER_ID = '$userID' AND ORDER_DATE='$orderdate' AND ORDER_TIME='$ordertime'");
      $result4=oci_execute($sql4);
      while (oci_fetch($sql4)) {
        $orderID = oci_result($sql4, 'ORDER_ID');
        $_SESSION["ORDER_ID"]=$orderID;
        $sql5= oci_parse($dbconn, "UPDATE ORDERICECREAM SET ORDER_ID='$orderID' WHERE USER_ID='$userID' AND ORDER_DATE='$orderdate' AND ORDER_TIME='$ordertime'");
        $result5=oci_execute($sql5);
    }
 
      if($result && $result2 && $result3 && $result4){
        echo "<script>alert('Order Succesfully Created!');
          window.location='receipt.php'</script>";
      }
      else{
       echo "<script>alert('Error!');
          window.location='index.php'</script>";
      }
    }
?>