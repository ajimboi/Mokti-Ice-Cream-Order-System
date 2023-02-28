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

.button{
  font-family: Fredoka, sans-serif;
  text-align :center;
  width: 100%;
  height: 50px;
  margin-bottom: 10px;
  border: 1px solid;
  background: #cf2e2e;
  border-radius: 12px;
  font-size: 18px;
  color: #ffffff;
  cursor: pointer;
  outline: none;
  padding:8px;
  text-decoration:none;
  }
  .button:hover{
  border-color: rgb(130, 132, 239);
  transition: .5s;
  }
            </style>
            <h1>ICE CREAM DETAILS</h1>
<a type="button" href="product/addproduct.php"  target=content class="button">Add Product</a><br><br>
<table>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<link rel=\'stylesheet\' href=\'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css\' />


<tr>
    <th>Ice Cream Code</th>
    <th>Ice Cream Name</th>
    <th>Ice Cream Price</th>
    <th colspan=2></th>
    <th colspan=2></th>
    </tr>
'; 
$sql = "SELECT ICECREAM_CODE, ICECREAM_NAME, TO_CHAR(ICECREAM_PRICE,'$99,999.00') AS PRICE FROM ICECREAM ORDER BY ICECREAM_CODE";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["ICECREAM_CODE"].'</td>
    <td>'.$row["ICECREAM_NAME"].'</td>
    <td>'.$row["PRICE"].'</td>
    <td colspan=2><a href="product/editproduct.php?ICECREAM_CODE='.$row["ICECREAM_CODE"].'"><i class=\'fas fa-edit\' style=\'font-size:20px;color:black\'></i></a></td>
    </td>
    <td colspan=2><a href="product/deleteproduct.php?ICECREAM_CODE='.$row["ICECREAM_CODE"].'"><i class=\'fas fa-trash-alt\' style=\'font-size:20px;color:black\'></i></a></td>
    </tr> ';
}
      oci_close ($dbconn);
      echo '</table>';
?>