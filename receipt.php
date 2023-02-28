<html><?php
include ('config/dbconn.php');
session_start();
    $oid = $_SESSION["ORDER_ID"];

$sql = "SELECT ORDERS.ORDER_ID, ORDERS.USER_ID, USERS.USER_NAME, USERS.USER_PHONE_NUM, USERS.USER_EMAIL, ORDERS.PAYMENT_MODE, ORDERS.ORDER_DATE, TO_CHAR(ORDERS.AMOUNT_PAID,'$99,999.00') AS AMOUNTPAID FROM ORDERS
INNER JOIN USERS ON ORDERS.USER_ID = USERS.USER_ID
WHERE ORDERS.ORDER_ID = '$oid'";

$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
echo '
<!DOCTYPE html>
<html>
	<head>
	<link rel = "icon" href = "logo2.png" type = "image/x-icon">
		<meta charset="utf-8" />
		<title>Receipt</title>

		<style>
			body {
				background-color: #cbcdd5;
			}
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: Arial, sans-serif;
				color: #555;
				background-color: white;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: rgb(0, 0, 0);
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="3">
						<table>
							<tr>
								<td class="title" style="font-size: 40px; font-weight:800;">
									<img src="images/logo2.png" style="width: auto; height:160px; max-width: 300px; margin-top:0px;" /><br>
									Receipt
								</td>

								<td>
									Order  : #'.$row["ORDER_ID"].'<br />
									Created: '.$row["ORDER_DATE"].'<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td>
                                Moktis HQ Malaysia<br />
								</td>

								<td>
								'.$row["USER_NAME"].'<br />
								'.$row["USER_PHONE_NUM"].'<br />
								'.$row["USER_EMAIL"].'
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>
					<td>              </td>
					<td>              </td>
				</tr>

				<tr class="details">
					<td>'.$row["PAYMENT_MODE"].'</td>
				</tr>

				<tr class="heading">
					<td>Detail</td>
					<td style="text-align: center;">Quantity</td>
					<td style="text-align: right;">Price</td>
				</tr> ';
				$sql = "SELECT ICECREAM.ICECREAM_NAME, ORDERICECREAM.ORDER_QTY, TO_CHAR((ORDERICECREAM.ORDER_QTY * ICECREAM.ICECREAM_PRICE),'$99,999.00') AS PRICE
				FROM ORDERS
				INNER JOIN ORDERICECREAM ON ORDERS.ORDER_ID = ORDERICECREAM.ORDER_ID
				INNER JOIN ICECREAM ON ORDERICECREAM.ICECREAM_CODE = ICECREAM.ICECREAM_CODE
				WHERE ORDERS.ORDER_ID = '$oid'";
				$result = oci_parse($dbconn, $sql);
				oci_execute($result);
				while($row = oci_fetch_array($result,OCI_ASSOC))
				{
				echo'
				<tr class="item">
					<td>'.$row["ICECREAM_NAME"].'</td>
					<td style="text-align: center;">'.$row["ORDER_QTY"].'</td>
					<td style="text-align: right;">'.$row["PRICE"].'</td>
				</tr>
				'; }
				$sql = "SELECT TO_CHAR(AMOUNT_PAID,'$99,999.00') AS AMOUNTPAID FROM ORDERS
WHERE ORDER_ID = '$oid'";

$result = oci_parse($dbconn, $sql);
oci_execute($result);
while($row = oci_fetch_array($result,OCI_ASSOC))
{
			echo '
				<tr class="total">
					<td></td>
					<td colspan=3>Total:&nbsp;&nbsp;&nbsp; '.$row["AMOUNTPAID"].'</td>
				</tr>
			</table>
		</div>
	</body>
	';
}
}
?>
</html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<style>
.btn {
	margin: 0;
  position: absolute;
  top: 120%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
.button{
  font-family: Fredoka, sans-serif;
  text-align :center;
  width: 100px;
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
  } </style>
  <br>
  <div class="btn">
<button class="button" onclick="printFunction()">Print</button>
<button class="button" onclick="window.location='index.php'">Home</button>​​
    <script>
      function printFunction() { 
        window.print(); 
      }
    </script>
  </div>