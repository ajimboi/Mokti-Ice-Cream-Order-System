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

<h1>DAILY SALES</h1>
<tr>
    <th>Order Date</th>
    <th>Total Daily Sales</th>
    </tr>
'; 
$sql = "SELECT TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY') AS DATEORDER, TO_CHAR(SUM(ORDERS.AMOUNT_PAID),'$99,999.00') AS TOTALDAILY FROM ORDERS GROUP BY TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY') ORDER BY TO_DATE(ORDERS.ORDER_DATE,'DD-MM-YYYY') DESC";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["DATEORDER"].'</td>
    <td>'.$row["TOTALDAILY"].'</td>
    </tr> ';
}
      oci_close ($dbconn);
      echo '</table>';
?>