<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<link rel="stylesheet" href="css/style.css">
<?php 
    $page = "Cart";
?>

<body>
<style>
            /* Three image containers (use 25% for four, and 50% for two, etc) */
            h2 {
            text-align: center;
            font-size: 40px;
            padding: 10px 0 10px;
            border-bottom: 1px solid silver;
            font-weight: 1000px;
            font-family: 'Fredoka', sans-serif;
            }
            table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 100px;
            border: 1px solid #ddd;
            }

            th, td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            }

            th {
            background-color: #cf2e2e;
            color: white;
            }
            .center {
            margin-left: auto;
            margin-right: auto;
            }
            </style>
          <table class="center">
            <thead>
                  <h2 style="font-family: 'Fredoka', sans-serif;">Products in your cart!</h2>
         <tr>
                <th>#</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th colspan=2>Quantity</th>
                <th colspan=2>Delete</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                 include('config/dbconn.php');
                 $sql = "SELECT i.ICECREAM_CODE, i.ICECREAM_NAME, i.ICECREAM_PRICE,
                 SUM(o.ORDER_QTY) AS QUANTITY , (i.ICECREAM_PRICE * SUM(o.ORDER_QTY)) AS TOTAL_PRICE
                 FROM ICECREAM i, CART o
                 WHERE o.ICECREAM_CODE = i.ICECREAM_CODE
                 AND o.USER_ID = " . $_SESSION["USER_ID"] . "
                 GROUP BY i.ICECREAM_CODE,i.ICECREAM_NAME, i.ICECREAM_PRICE";
                 
                
              
                $result = oci_parse($dbconn, $sql);
                
                $total_price = 0;
                $counter = 1;
                oci_execute($result); 
                while ($row = oci_fetch_assoc($result)) {
                        $total_price += $row["TOTAL_PRICE"];
                        $total_row_price = $row["TOTAL_PRICE"];
                ?>
                <tr>
                    <td><?php echo $counter++;?></td>
                    <td><?php echo $row["ICECREAM_CODE"]; ?></td>
                    <td><?php echo $row["ICECREAM_NAME"]; ?></td>
                    <td>RM<?php echo $row["ICECREAM_PRICE"]; ?></td>
                    <td colspan=2>
                    <form action="function/editCart.func.php?ICECREAM_CODE=<?php echo $row["ICECREAM_CODE"]; ?>" method="POST">
                    <input type="number" value="<?php echo $row["QUANTITY"]; ?>" name="QUANTITY" style="text-align:center; width:30px; height:30px;">
                    <button type="submit" style='background: none; border: none;'><i class='fas fa-edit' style='font-size:20px;color:black'></i></a>
                    </form>
                    </td>
                    <td colspan=2><a href="function/deleteCart.func.php?ICECREAM_CODE=<?php echo $row["ICECREAM_CODE"]; ?>"><i class='fas fa-trash-alt' style='font-size:20px;color:black'></i></a></td>
                </tr>

                <?php } ?>

                <tr>
                <td colspan="3">
                <a href="index.php" style='font-size:15px;color:black'><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Continue Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b>RM&nbsp;&nbsp;<?php echo number_format($total_price,2);?></b></td>
                <td>
                <a href="checkout.php" style='font-size:15px;color:black'><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
                <td>
                </td>
              </tr>
            </tbody>
          </table>

    <!-- footer -->

    <!-- //footer -->

</body>

</html>