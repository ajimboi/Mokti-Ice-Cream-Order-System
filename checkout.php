<?php include('partials-front/menu.php'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<body>
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
            body {
                background-image: url(../images/fullicecream.png);
                background-size:contain;
                background-repeat:no-repeat;
                background-position: center;
            }
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

            /* START LOGIN FORM CSS */

            .Login {
                height: 4000px;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family:Arial; 
            }

            .loginForm{
            height: 750px;
            margin-top: 200px;
            margin-bottom: 500px;
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
            
            }
            .loginForm h1{
            text-align: center;
            font-size: 40px;
            padding: 15px 0 15px;
            border-bottom: 1px solid silver;
            font-weight: 1000px;
            }
            .loginForm form{
            padding: 0 40px;
            box-sizing: border-box;
            }
            input[type], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            }

            input[type="submit"]{
            margin-top: 30px;
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #cf2e2e;
            border-radius: 25px;
            font-size: 18px;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            }
            input[type="submit"]:hover{
            border-color: rgb(130, 132, 239);
            transition: .5s;
            }
            .signup_link{
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #666666;
            }
            .signup_link a{
            color: #444546;
            text-decoration: none;
            }
            .signup_link a:hover{
            text-decoration: underline;
            color: #cf2e2e;
            }

            h4 {
                text-align: left;
            }

            h5, h3 {
                text-align: center;
            }
            textarea {
                resize: none;
                height :100px;
                width: 100%;
            }
            /* END CSS */
            </style>
            <section class="login">
            <div class="loginForm">
        <h1>Complete your order!</h1>
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
        
        $product = array();
        oci_execute($result); 
        while ($row = oci_fetch_assoc($result)) {
                $total_price     += $row["TOTAL_PRICE"];
                $productName[]   = $row["ICECREAM_NAME"];
        }
        $allProducts = implode(', ', $productName);
        ?>
        <div><br>
          <h3><b>Product(s) : <?php echo $allProducts; ?></b></h3>
          <h5><b>Delivery Charge : </b>Free</h5>
          <h5><b>Total Amount Payable :RM <?php echo $total_price;?> </b></h5>
        </div>
        <?php 
        $userID = $_SESSION["USER_ID"];
        $sql = "SELECT * FROM USERS WHERE USER_ID = '$userID'";
        $result = oci_parse($dbconn, $sql);
        oci_execute($result); 
        if($row = oci_fetch_assoc($result)) {
        ?>
        <form action="checkoutfunc.php" method="POST" id="placeOrder">
          <div class="form-group">
          <h4>Name :</h4>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $row["USER_NAME"]; ?>" required readonly>
          </div>
          <div class="form-group">
          <h4>Email :</h4>
            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" value="<?php echo $row["USER_EMAIL"]; ?>" required readonly>
          </div>
          <div class="form-group">
          <h4>Phone Number :</h4>
            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo $row["USER_PHONE_NUM"]; ?>" required readonly>
          </div>
          <div class="form-group">
          <h4>Home Address :</h4>
            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..." readonly><?php echo $row["USER_ADDRESS"]?></textarea>
          </div>
          <?php } ?>
          <h4>Select Payment Mode</h4>
          <div class="form-group">
            <select name="pmode" class="form-control">
              <option value="" selected disabled>-Select Payment Mode-</option>
              <option value="Cash On Delivery">Cash On Delivery</option>
              <option value="Net Banking">Net Banking</option>
              <option value="Debit/Credit Card">Debit/Credit Card</option>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" value="<?php echo $rowID["USER_ID"]; ?>" name="USER_ID">
            
            <input type="hidden" value="<?php echo $total_price?>" name="TOTAL_PRICE">

            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>
            </section>
        </body>
<?php include('partials-front/footer.php'); ?>
