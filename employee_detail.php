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

<h1>EMPLOYEE DETAILS</h1>
<tr>
    <th>Employee ID</th>
    <th>Full Name</th>
    <th>Phone Number</th>
    <th>Home Address</th>
    <th colspan=2></th>
    <th colspan=2></th>
    </tr>
'; 
$sql = "SELECT * FROM EMPLOYEE";
$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
    echo '<tr>
    <td>'.$row["EMP_ID"].'</td>
    <td>'.$row["EMP_NAME"].'</td>
    <td>'.$row["EMP_PHONE_NUM"].'</td>
    <td>'.$row["EMP_ADDRESS"].'</td>
    <td colspan=2><a href="employee/editemployee.php?EMP_ID='.$row["EMP_ID"].'"><i class=\'fas fa-edit\' style=\'font-size:20px;color:black\'></i></a></td>
    </td>
    <td colspan=2><a href="employee/deleteemployee.php?EMP_ID='.$row["EMP_ID"].'"><i class=\'fas fa-trash-alt\' style=\'font-size:20px;color:black\'></i></a></td>
    </tr> ';
}
      oci_close ($dbconn);
      echo '</table>';
?>