<html>
	<head>
	<link rel="icon" type="image/x-icon" href="images/cine.jpg">
	</head>
	<style>
.mySlides {display: none;}
img {vertical-align: middle;}
/*slide*/
/* Slideshow container */
.slideshow-container {
	max-width: 1400px;
	position: relative;
	margin: auto;

  }
  

  /* Number text (1/3 etc) */
  .numbertext {
	color: #f2f2f2;
	font-size: 12px;
	padding: 8px 12px;
	position: absolute;
	top: 0;
  }
  
  /* The dots/bullets/indicators */
  .dot {
	height: 15px;
	width: 15px;
	margin: 0 2px;
	background-color: #bbb;
	border-radius: 50%;
	display: inline-block;
	transition: background-color 0.6s ease;
  }
  
  .active {
	background-color: #717171;
  }
  
  /* Fading animation */
  .fade {
	animation-name: fade;
	animation-duration: 1.5s;
  }
  
  @keyframes fade {
	from {opacity: .4} 
	to {opacity: 1}
  }
  
  /* On smaller screens, decrease text size */
  @media only screen and (max-width: 300px) {
	.text {font-size: 11px}
  }
</style>
<body>
<?php
include('header.php');
?>
<div class="slideshow-container">

<div class="mySlides fade">
  <img src="images/sl1.jpeg" width="1400" height ="500">
</div>

<div class="mySlides fade">
  <img src="images/sl2.jpeg" width="1400" height="500">
</div>

<div class="mySlides fade">
  <img src="images/sl3.jpeg" width="1400" height="500">
</div>

<div class="mySlides fade">
    <img src="images/sl4.jpeg" width="1400" height="500">
</div>

<div class="mySlides fade">
    <img src="images/sl5.jpeg" width="1400" height="500">
</div>
  

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<div class="content">
	<div class="wrap">
		<div class="content-top">
				<div class="listview_1_of_3 images_1_of_3">
					<h3>Upcoming Movies</h3>
					<?php 
					$qry3=mysqli_query($con,"select * from tbl_news");
					
					while($n=mysqli_fetch_array($qry3))
					{
					?>
				<div class="content-left">
					<div class="listimg listimg_1_of_2">
						 <img src="admin/<?php echo $n['attachment'];?>">
					</div>
					<div class="text list_1_of_2">
						  <div class="extra-wrap">
						  	<span style="text-color:#000" class="data"><strong><?php echo $n['name'];?></strong><br>
						  	<span style="text-color:#000" class="data"><strong>Cast :<?php echo $n['cast'];?></strong><br>
                                <div class="data">Release Date :<?php echo $n['news_date'];?></div>
                                
                                
                                
                                <span class="text-top"><?php echo $n['description'];?></span>
                          </div>
					</div>
					<div class="clear"></div>
				</div>
				<?php
				}
				?>
				
			
		</div>				
		<div class="listview_1_of_3 images_1_of_3">
					<h3>Trending Trailers</h3>
						<div class="middle-list">
					<?php 
					$qry4=mysqli_query($con,"select * from tbl_movie order by rand() limit 4");
				
					while($nm=mysqli_fetch_array($qry4))
					{
					?>
					
						<div class="listimg1">
							 <a target="_blank" href="<?php echo $nm['video_url'];?>"><img src="<?php echo $nm['image'];?>" alt=""/></a>
							 <a target="_blank" href="<?php echo $nm['video_url'];?>" class="link"><?php echo $nm['movie_name'];?></a>
						</div>
						<?php
					}
					?>
					</div>
					
					
		</div>			
		<?php include('movie_sidebar.php');?>
	</div>
</div>
<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script>
<?php include('footer.php');?>
</div>
<?php include('searchbar.php');?>