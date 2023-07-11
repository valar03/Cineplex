<?php include('header.php');?>
</div>
<style>
	.order{
		padding:5px;
		width:33.33%;
		height:100%;
  float:left;
  display:flex;

	}
	.order::after{
		content:"";
		clear:both;
		display:table;
	}
	.im{
		width:500px;
		height:300px;
		flex:33.33%;
	}
	</style>
<div class="content">
	<div class="wrap">
		<div class="content-top">
			<h3>Movies</h3>
			<br><br>
			<?php
          	 $today=date("Y-m-d");
          	 $qry2=mysqli_query($con,"select * from  tbl_movie ");
		
          	  while($m=mysqli_fetch_array($qry2))
                   {
                    ?>
                    <div class="order"><br>
                 
						  		<?php
						
						?>
						<div class="movie-text">
						  		<h4 class="h-text"><a href="about.php?id=<?php echo $m['movie_id'];?>"><?php echo $m['movie_name'];?></a></h4>
						  		Cast:<Span class="color2"><?php echo $m['cast'];?></span><br><br><br>
						  		
						  	</div>
						  		<a href="about.php?id=<?php echo $m['movie_id'];?>"><img class="im" src="<?php echo $m['image'];?>" alt="" /></a>
						  	</div>
						  	

		  		
  	    <?php
  	    	}
  	    	?>
			
			</div>
				<div class="clear"></div>		
			</div>
			<?php include('footer.php');?>