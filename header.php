<?php
include('config.php');
session_start();
date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Cineplex</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" type="image/x-icon" href="images/cine.jpg">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
<link href="review/review.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link type="text/css" rel="stylesheet" href="http://www.dreamtemplate.com/dreamcodes/tabs/css/tsc_tabs.css" />
<link rel="stylesheet" href="css/tsc_tabs.css" type="text/css" media="all" />
<link rel="stylesheet" href="tstyle.css" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='js/jquery.color-RGBa-patch.js'></script>
<script src='js/example.js'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="tscript.js"></script>

<style>
		/*navigation*/
.headern{
	display: block;
    font-family:Arial, Helvetica, sans-serif;
    margin: -10px;

  }
  .headern {
	background: #070720;
}
  .rown {
	display: block;

  }
  .header__logon {
	padding: 20px 0 17px;
}

.header__logon a {
	display: inline-block;
}

.header__menun {
	text-align: center;
    align-items:center;
    justify-content: center;
    
}

.header__menun ul li {
	list-style: none;
	display: inline-block;
	position: relative;
	margin-right: 16px;
}


.header__menun ul li:hover a {
	color: #ffffff;
}

.header__menun ul li:hover .dropdown {
	top: 62px;
	opacity: 1;
	visibility: visible;
}

.header__menun ul li:hover .dropdown li a {
	background: transparent;
}

.header__menun ul li:last-child {
	margin-right: 0;
}

.header__menun ul li .dropdown {
	position: absolute;
	left: 0;
	top: 82px;
	width: 150px;
	background: #ffffff;
	text-align: left;
	padding: 5px 0;
	z-index: 9;
	opacity: 0;
	visibility: hidden;
	-webkit-transition: all, 0.3s;
	-o-transition: all, 0.3s;
	transition: all, 0.3s;
}

.header__menun ul li .dropdown li {
	display: block;
	margin-right: 0;
}

.header__menun ul li .dropdown li a {
	font-size: 14px;
	color: #111111;
	font-weight: 500;
	padding: 5px 20px;
}

.header__menun ul li a {
	font-size: 15px;
	color: #b7b7b7;
	display: block;
	font-weight: 700;
	-webkit-transition: all, 0.5s;
	-o-transition: all, 0.5s;
	transition: all, 0.5s;
	padding: 20px;
    text-decoration: none;
}

.header__menun ul li a span {
	position: relative;
	font-size: 17px;
	top: 2px;
}


.col-lg-8n {
	position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

.sea{
	width:300px;
	height:40px;
	max-width:700px;
	background:rgba(255,255,255,0.2);
	display: flex;
	align-items: center;
	border-radius: 60px;
	padding: 10px 20px;
}
.sea input{
	background:transparent;
	flex: 1;
	border: 0;
	outline: none;
	padding: 24px 20px;
	font-size: 15px;
	color: #cac7ff;

}
.co{
	margin-top:10px;
}
.sea button img{
	width: 20px;
}

.sea button{
	border:0 ;
	border-radius: 50%;
	width: 30px;
	height: 30px;
	background: #58629b;
	cursor: pointer;
	
	
}

::placeholder{
	color: #cac7ff;
}

html[data-theme='dark'] body {
    background: hsl(260, 15%, 8%);
	color:#fff;
}

html[data-theme='dark'] body *:not(.num):not(.stars):not(.rating):not(.total):not(h4):not(h3):not(.headern):not(.footer):not(img):not(.chatbox):not(.robo):not(.chatbox__content--header):not(.chatbox__heading--header):not(.chatbox__description--header):not(.chatbox__send--footer):not(.myy):not(.chatbox__image--header):not(.send__button) {
    background-color: hsl(260, 15%, 8%);
	color:#fff;
}
	</style>
</head>
<body>
	
<div class="headern" style="margin-top: -40px;">
        <div class="containern">
            <div class="rown">
                <div class="col-lg-2n">
                    <div class="header__logon">
                        <a href="./index.html">
                            
                        </a>
                    </div>
                </div>
                <div class="col-lg-8n">
                    <div class="header__navn">
                        <nav class="header__menun mobile-menun ">
                            <ul>
								<li style="float:left;"><img width=50px; height=50px; style="float:left;margin-top:10px;" src="images/cines.png" alt=""><a style="color:orange;float:left;margin-left:-20px;" href="#">Cineplex</a></li>
                                <li><a href="index.php">Homepage</a></li>
                                <li><a href="#">Movies <span class="arrow_carrot-down"></span></a>
									<ul class="dropdown">
									<li><a href="movies_events.php">All movies</a>
                                    <li><a href="genre.php">Genre</a></li>
									<li><a href="lang.php">Language</a>
            
									</ul>
                                </li>
								<li><a href="about3.php">About</a></li>
								<li><a href="contact.php">Contact Us</a></li>
								<li>
  <input type="checkbox" id="theme-toggle">
  <label for="theme-toggle"><a>Light/Dark</a></label>
</li>
								<li style="float:right;"><a href="#"><span class="glyphicon glyphicon-user"></span><span class="arrow_carrot-down"></span>Profile</a>
                                         <ul class="dropdown">
                                          <li><?php if(isset($_SESSION['user'])){  $us=mysqli_query($con,"select * from tbl_registration where user_id='".$_SESSION['user']."'");
                                             $user=mysqli_fetch_array($us);?><a href="profile.php">Booking history</a></li>
											 <li><a href="manage.php">View Profile</a>
                                            <li><a href="logout.php">Logout</a></li>
                                         <?php }else{?><li><a href="login.php">Login</a></li><?php }?></ul>   
                                      </li>
									  <li style="float:right;">
										<div class="co">
										<form action="process_search.php" method="post" onsubmit="myFunction()" class="sea">
											<input type="text" placeholder="Search Movies Here..."required id="search111"  name="search">
											<button type="submit"><img src="images/sea.png">
											</form>
										</div>
									  </li>
                            </ul>
                        </nav>
						

                    </div>
                </div>
            </div>
        </div>
		</div>

    <div class="block">
		
	

</div>
<script>
function myFunction() {
     if($('#hero-demo').val()=="")
        {
            alert("Please enter movie name...");
            return false;
        }
    else{
        return true;
    }

}
window.addEventListener('DOMContentLoaded', function() {
  const themeToggle = document.getElementById('theme-toggle');
  const htmlEl = document.documentElement;
  const currentTheme = localStorage.getItem('theme');

  if (currentTheme === 'dark') {
    htmlEl.setAttribute('data-theme', 'dark');
    themeToggle.checked = true;
  }

  themeToggle.addEventListener('change', function() {
    if (this.checked) {
      htmlEl.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    } else {
      htmlEl.removeAttribute('data-theme');
      localStorage.removeItem('theme');
    }
  });
});


</script>