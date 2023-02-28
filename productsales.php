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

<h1>MONTHLY PRODUCT SALES</h1>
<tr>
    <th>Month</th>
    <th>Ice Cream Name</th>
    <th>Sold Quantity</th>
    <th>Total Sales</th>
    </tr>
'; 
$sql = "SELECT EXTRACT(MONTH FROM TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY')) AS MONTH, ICECREAM.ICECREAM_NAME, SUM(ORDERICECREAM.ORDER_QTY) AS TOTAL, TO_CHAR(((SUM(ORDERICECREAM.ORDER_QTY))*(ICECREAM.ICECREAM_PRICE)),'$99,999.00') AS TOTALSALES FROM ICECREAM INNER JOIN ORDERICECREAM ON ICECREAM.ICECREAM_CODE = ORDERICECREAM.ICECREAM_CODE INNER JOIN ORDERS ON ORDERICECREAM.ORDER_ID = ORDERS.ORDER_ID GROUP BY EXTRACT(MONTH FROM TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY')), ICECREAM.ICECREAM_NAME, ORDERICECREAM.ORDER_QTY, ICECREAM.ICECREAM_PRICE ORDER BY EXTRACT(MONTH FROM TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY'))";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["MONTH"].'</td>
    <td>'.$row["ICECREAM_NAME"].'</td>
    <td>'.$row["TOTAL"].'</td>
    <td>'.$row["TOTALSALES"].'</td>
    </tr> ';
}
      oci_close ($dbconn);
      echo '</table>';
?>