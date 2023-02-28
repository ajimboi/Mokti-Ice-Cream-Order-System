<?php
include ('config/dbconn.php');

echo '

<style>
body {
  background-image: url(../images/bg.png);
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

h1 {
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
    <th>Phone Number</th>
    <th>Home Address</th>
    <th>Amount Paid</th>
    <th>Payment Mode</th>
    <th colspan=2></th>
    <th colspan=2></th>
    </tr>
'; 
$sql = "SELECT ORDER_ID, TO_CHAR((TO_TIMESTAMP(ORDERS.ORDER_DATE,'DD-MM-RR HH12:MI:SS.FF6 AM')),'YY-MON-DD') AS DATEORDER, USER_ID, USER_PHONE_NUM, USER_ADDRESS, TO_CHAR(AMOUNT_PAID,'$99,999.00') AS AMOUNTPAID, PAYMENT_MODE FROM ORDERS";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["ORDER_ID"].'</td>
    <td>'.$row["DATEORDER"].'</td>
    <td>'.$row["USER_ID"].'</td>
    <td>'.$row["USER_PHONE_NUM"].'</td>
    <td>'.$row["USER_ADDRESS"].'</td>
    <td>'.$row["AMOUNTPAID"].'</td>
    <td>'.$row["PAYMENT_MODE"].'</td>
    <td colspan=2><a href="order/receipt.php?ORDER_ID='.$row["ORDER_ID"].'"><i <i class=\'fas fa-receipt\' style=\'font-size:20px;color:black\'></i></a></td>
    </td>
    <td colspan=2><a href="order/deleteorder.php?ORDER_ID='.$row["ORDER_ID"].'"><i class=\'fas fa-trash-alt\' style=\'font-size:20px;color:black\'></i></a></td>
    </tr> ';
}
      oci_close ($dbconn);
      echo '</table>';
?>