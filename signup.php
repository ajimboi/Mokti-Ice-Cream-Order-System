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
            <video id="myVideo" width="1900" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="../moktis/images/MOKTI.mp4" type="video/mp4">
            </div>
        </div>
    </section>
    <style>
            /* Three image containers (use 25% for four, and 50% for two, etc) */
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
                height: 5000px;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family:Arial; 
            }

            .loginForm{
            height: 740px;
            margin-top: 200px;
            margin-bottom: 200px;
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
            
            }
            .loginForm h1{
            text-align: center;
            font-size: 40px;
            padding: 10px 0 10px;
            border-bottom: 1px solid silver;
            font-weight: 1000px;
            }
            .loginForm form{
            padding: 0 40px;
            box-sizing: border-box;
            }
            form .txt_field{
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
            }
            .txt_field input{
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: none;
            background: none;
            outline: none;
            }
            .txt_field label{
            position: absolute;
            top: 50%;
            left: 5px;
            color: #444546;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: .5s;
            }
            .txt_field span::before{
            content: '';
            position: absolute;
            top: 40px;
            left: 0;
            width: 0%;
            height: 2px;
            background: #cf2e2e;
            transition: .5s;
            }
            .txt_field input:focus ~ label,
            .txt_field input:valid ~ label{
            top: -5px;
            color: #cf2e2e;
            }
            .txt_field input:focus ~ span::before,
            .txt_field input:valid ~ span::before{
            width: 100%;
            }
            .pass{
            margin: -5px 0 20px 5px;
            color: #a6a6a6;
            cursor: pointer;
            }
            .pass:hover{
            text-decoration: underline;
            }
            input[type="submit"]{
            width: 100%;
            height: 50px;
            margin-bottom: 10px;
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

            /* END LOGIN FORM CSS */
            </style>
            <section class="login">
            <div class="loginForm">
            <h1>Sign Up</h1>
            <form action="function/registerfunc.php" method="post" class="signup">
                    <!-- REGISTER -->
                    <div class="txt_field">
                        <input type="text" name="custid" required required="">
                        <span></span>
                    <label>Mokti's ID (*5 Digit of Number Only)</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="custusername" required required="">
                        <span></span>
                    <label>Username (*Username to log in)</label>
                    </div>
                    <div class="txt_field">
                        <input type="password" name="custpass" required required="">
                        <span></span>
                    <label>Password</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="custname" required required="">
                        <span></span>
                    <label>Full Name (*as per in IC)</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="custphone" required required="">
                        <span></span>
                    <label>Phone Number (*60123456789)</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="custemail" required required="">
                        <span></span>
                    <label>Email (*abc@gmail.com)</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="custadd" required required="">
                        <span></span>
                    <label>Home Address</label>
                    </div>
                    <div>
                        <input name="submit" type="submit" value="Sign Up">
                    </div>
            </div>
        </body>
<?php include('partials-front/footer.php'); ?>
