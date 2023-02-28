    <?php include('partials-front/menu.php'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <div class="logo2">
            <img src="images/logo.svg" alt="Restaurant Logo" class="img-responsive">
            </div>
        </div>
    </section>
    <style>
            /* Three image containers (use 25% for four, and 50% for two, etc) */
            .imgmenu {
            width: 100%;
            padding: 5px;
            }
            table {
            border-collapse: collapse;
            width: 95%;
            margin-bottom: 100px;
            border: 1px solid #ddd;
            }

            th, td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
            background-color: #cf2e2e;
            color: white;
            }
            .center {
            margin-left: auto;
            margin-right: auto;
            }
            </style>
            <div class="imgmenu">
            <img src="images/menu.jpg" alt="menu" style="width:100%">
            </div>
    <!-- fOOD MEnu Section Starts Here -->
        <?php 
            $conn = oci_connect('PROJECT502', 'system', 'localhost/XE');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            $sql = "SELECT * FROM ICECREAM";
            $result = oci_parse($conn, $sql);
        
            oci_define_by_name($result, 'ICECREAM_NAME', $iname);
            oci_define_by_name($result, 'ICECREAM_PRICE', $iprice);
            oci_define_by_name($result, 'ICECREAM_CODE', $icecode);
            

            oci_execute($result); ?>

              <table class="center">
                <thead>
                  <tr>
                    <th scope="col">NAME</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
        <?php
         while($row = oci_fetch_assoc($result)) {
            
         ?> 
            <div class="clearfix"></div>
            <style>
            .container {
            padding: 2rem 0rem;
            }

            .table-image td, th {
                vertical-align: middle;
            }
            </style>     
        <tbody>
          <tr>
          <form action="../moktis/function/addCartfunc.php" method="POST">
            <td><?php echo $row["ICECREAM_NAME"]?></td>
            <td>RM <?php echo number_format($row["ICECREAM_PRICE"], 2); ?></td>
            <td><input type="number" value="1" name="quantity"></td>
            <td>
            <input type="hidden" value="<?php echo $row["ICECREAM_CODE"]; ?>" name="icecode">
            <button type="submit" class="btn" style="padding: 8px;"><i class="fa fa-cart-plus"></i>  Add to cart</button>
            </form>
            </td>
          </tr>
        </tbody>
    <!-- fOOD Menu Section Ends Here -->
    <?php } ?>
      </table>
    </div>
  </div>
</div>
<?php include('partials-front/footer.php'); 
?>
