<?php
$dbconn = oci_connect("PROJECT502", "system", "LOCALHOST/XE");

echo '

<style>
body {
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  font-size :12px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #cf2e2e;
  color: white;
}

h1, h3{
  font-family: Fredoka, sans-serif;
  text-align :center;
}
            </style>
<table>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<link rel=\'stylesheet\' href=\'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css\' />

<h1>ORDER DETAILS</h1>
<tr>
    <th>Order ID</th>
    <th>Order Date</th>
    <th>Moktis ID</th>
    <th>Amount Paid</th>
    </tr>
'; 

$oid =  $_GET["ORDER_ID"];
$sql = "SELECT ORDER_ID, TO_CHAR((TO_TIMESTAMP(ORDERS.ORDER_DATE,'DD-MM-RR HH12:MI:SS.FF6 AM')),'YY-MON-DD') AS DATEORDER, USER_ID, TO_CHAR(AMOUNT_PAID,'$99,999.00') AS AMOUNTPAID FROM ORDERS WHERE ORDER_ID = '$oid'";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["ORDER_ID"].'</td>
    <td>'.$row["DATEORDER"].'</td>
    <td>'.$row["USER_ID"].'</td>
    <td>'.$row["AMOUNTPAID"].'</td>
    ';
}
      oci_close ($dbconn);
      echo '</table>';

      echo '
      <table>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
      <link rel=\'stylesheet\' href=\'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css\' />
      
      <h3>ICE CREAM LIST</h3>
      <tr>
          <th>No.</th>
          <th>Ice Cream Name</th>
          <th>Quantity</th>
          <th>Price</th>
          </tr>
      '; 
$oid =  $_GET["ORDER_ID"];
$i = 1;
$sql = "SELECT ICECREAM.ICECREAM_NAME, ORDERICECREAM.ORDER_QTY, TO_CHAR((ORDERICECREAM.ORDER_QTY * ICECREAM.ICECREAM_PRICE),'$99,999.00') AS PRICE
FROM ORDERS
INNER JOIN ORDERICECREAM ON ORDERS.ORDER_ID = ORDERICECREAM.ORDER_ID
INNER JOIN ICECREAM ON ORDERICECREAM.ICECREAM_CODE = ICECREAM.ICECREAM_CODE
WHERE ORDERS.ORDER_ID = '$oid'";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$i.'</td>
    <td>'.$row["ICECREAM_NAME"].'</td>
    <td>'.$row["ORDER_QTY"].'</td>
    <td>'.$row["PRICE"].'</td>
    ';
    $i++;
} 
?>