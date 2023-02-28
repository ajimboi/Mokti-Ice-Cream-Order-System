<?php include('config/dbconn.php'); 
session_start();?>

<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.svg">
    <title>Mokti's Ordering System</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.svg" alt="Restaurant Logo" class="img-responsive">
                </a>
                
            </div>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="menu text-right">
                <ul>
                <li><a style="float: left; margin-left:180px">Welcome <?php echo $_SESSION['USER_NAME']; ?> !</a></li>
                <?php if(empty($_SESSION['USER_NAME'])) { ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <?php } else { ?>
                    <li>
                    <a class="button" href="#popup1"><i class="fa fa-shopping-cart" style="font-size:20px"></i></a>
                    </li>
                    <li>
                        <a href="logout.php"><i class='fas fa-sign-out-alt' style='font-size:20px'></i></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
    <!-- Cart start Here -->
    <section>
        <style>
            .button {
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.overlay {
    margin-top: 40px;
  position: fixed;
  overflow: scroll;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {

  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 70%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color:#cf2e2e;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
        </style>
    <div id="popup1" class="overlay">
	<div class="popup">
		<a class="close" href="#">&times;</a>
		<div class="content">
			<?php include('cart.php'); ?>
		</div>
	</div>
</div>
                    </section>