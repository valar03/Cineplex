<?php include('header.php');
if(!isset($_SESSION['user']))
{
	header('location:login.php');
}
	$qry2=mysqli_query($con,"select * from tbl_movie where movie_id='".$_SESSION['movie']."'");
	$movie=mysqli_fetch_array($qry2);
	?>
	<?php
	if(isset($_POST['set'])){
		$no=$_POST['num_seats'];
		$amt=$_POST['total_amount'];
		$sets=$_POST['selected_seats'];
		$_SESSION['num_seats']=$no;
		$_SESSION['total_amount']=$amt;
		$_SESSION['selected_seats']=$sets;
	}
?>
<div class="content">
	<div class="wrap">
		<div class="content-top">
				<div class="section group">
					<div class="about span_1_of_2">	
						<h3><?php echo $movie['movie_name']; ?></h3>	
							<div class="about-top">	
								<div class="grid images_3_of_2">
									<img src="<?php echo $movie['image']; ?>" alt=""/>
								</div>
								<div class="desc span_3_of_2">
									<p class="p-link" style="font-size:15px">Cast : <?php echo $movie['cast']; ?></p>
									<p class="p-link" style="font-size:15px">Release Date : <?php echo date('d-M-Y',strtotime($movie['release_date'])); ?></p>
									<p style="font-size:15px"><?php echo $movie['desc']; ?></p>
									<a href="<?php echo $movie['video_url']; ?>" target="_blank" class="watch_but">Watch Trailer</a>
								</div>
								<div class="clear"></div>
							</div>
							<table class="table table-hover table-bordered text-center">
							<?php
								$s=mysqli_query($con,"select * from tbl_shows where s_id='".$_SESSION['show']."'");
								$shw=mysqli_fetch_array($s);
								
									$t=mysqli_query($con,"select * from tbl_theatre where id='".$shw['theatre_id']."'");
									$theatre=mysqli_fetch_array($t);
									?>
									<tr>
										<td class="col-md-6">
											Theatre
										</td>
										<td>
											<?php echo $theatre['name'].", ".$theatre['place'];?>
										</td>
										</tr>
										<tr>
											<td>
												Screen
											</td>
										<td>
											<?php 
												$ttm=mysqli_query($con,"select  * from tbl_show_time where st_id='".$shw['st_id']."'");
												
												$ttme=mysqli_fetch_array($ttm);
												
												$sn=mysqli_query($con,"select  * from tbl_screens where screen_id='".$ttme['screen_id']."'");
												
												$screen=mysqli_fetch_array($sn);
												echo $screen['screen_name'];
							
												?>
										</td>
									</tr>
									<tr>
										<td>
											Date
											<?php $date=$_SESSION['datee'] ?>
										</td>
										<td>
							<div class="col-md-12 text-center" style="padding-bottom:20px">
								<?php
								$av=mysqli_query($con,"select sum(no_seats) from tbl_bookings where show_id='".$_SESSION['show']."' and ticket_date='$date'");
								$avl=mysqli_fetch_array($av);
								?>
								<input type="text" name="datee" class="form-control" value="<?php echo $date; ?>" style="text-align:center" disabled/>
							</div>
										</td>
									</tr>
									<tr>
										<td>
											Show Time
										</td>
										<td>
											<?php echo date('h:i A',strtotime($ttme['start_time']))." ".$ttme['name'];?> Show
										</td>
									</tr>
									<tr>
										<td>
											Number of Seats
										</td>
										<td>
											<form  action="process_booking.php" method="post">
												<input type="hidden" name="screen" value="<?php echo $screen['screen_id'];?>"/>
											<input type="number" required tile="Number of Seats" max="<?php echo $screen['seats']-$avl[0];?>" min="0" name="seats" class="form-control" value="<?php echo $no; ?>" style="text-align:center" id="seats" disabled/>
											<input type="hidden" name="amount" id="hm" value="<?php echo $screen['charge'];?>"/>
											<input type="hidden" name="date" value="<?php echo $date;?>"/>
											
										</td>
										
									</tr>
									<tr>
										<td>
											Amount
										</td>
										<td id="amount" style="font-weight:bold;font-size:18px">
											Rs <?php echo $amt;?>
										</td>
									</tr>
									<tr>
										<td>
											Selected seats
										</td>
										<td style="font-size:18px">
											<?php echo $sets;?>
										</td>
									</tr>
										<td colspan="2"><?php if($avl[0]==$screen['seats']){?><button type="button" class="btn btn-danger" style="width:100%">House Full</button><?php } else { ?>
										<button class="btn btn-info" name="done" style="width:100%">Book Now</button>
										<?php } ?>
										</form></td>
									</tr>
                  <tr>
                    <td colspan="2"><a href="seat/seat.php" class="btn btn-info">Seat map</a></td></tr>
						<table>
							<tr>
								<td></td>
							</tr>
						</table>
					</div>			
				<?php include('movie_sidebar.php');?>
			</div>
				<div class="clear"></div>		
			</div>
	</div>
</div>

<style>
	@import url("https://fonts.googleapis.com/css?family=Lato&display=swap");

* {
  box-sizing: border-box;
}


.movie-container {
  margin: 20px 0;
}

.movie-container select {
  background-color: #fff;
  border: 0;
  border-radius: 5px;
  font-size: 16px;
  margin-left: 10px;
  padding: 5px 15px 5px 15px;
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
}

.tcontainer {
  perspective: 1000px;
  margin-bottom: 30px;

}
.sen{
  align-items: center;
  margin-left: 200px;
}
.tseat {
  background-color: #444451;
  height: 26px;
  width: 32px;
  margin: 3px;
  font-size: 50px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

.tseat.tselected {
  background-color: green;
}

.tseat.tsold {
  background-color: #fff;
}

.tseat:nth-of-type(2) {
  margin-right: 18px;
}

.tseat:nth-last-of-type(2) {
  margin-left: 18px;
}

.tseat:not(.tsold):hover {
  cursor: pointer;
  transform: scale(1.2);
}

.tshowcase .tseat:not(.tsold):hover {
  cursor: default;
  transform: scale(1);
}

.tshowcase {
  background: rgba(0, 0, 0, 0.1);
  padding: 5px 10px;
  border-radius: 5px;
  color: #777;
  list-style-type: none;
  display: flex;
  justify-content: space-between;
}

.tshowcase li {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 10px;
}
.tshowcase li small {
  margin-left: 2px;
}

.trow {
  display: flex;
}

.tscreen {
  background-color: #fff;
  height: 120px;
  width: 60%;
  margin: 15px 0;
  transform: rotateX(-48deg);
  box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
  margin-left:135px;
}

p.ttext{
    margin: 5px 0;
}

p.ttext span{
    color: rgb(158, 248, 158);
}
	</style>
	<script>
		const container = document.querySelector(".tcontainer");
const seats = document.querySelectorAll(".trow .tseat:not(.tsold)");
const count = document.getElementById("count");
const total = document.getElementById("total");
const movieSelect = document.getElementById("movie");

populateUI();

let ticketPrice = +movieSelect.value;

// Save selected movie index and price
function setMovieData(movieIndex, moviePrice) {
  localStorage.setItem("selectedMovieIndex", movieIndex);
  localStorage.setItem("selectedMoviePrice", moviePrice);
}

// Update total and count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".trow .tseat.tselected");

  const seatsIndex = [...selectedSeats].map((tseat) => [...tseats].indexOf(tseat));

  localStorage.setItem("selectedSeats", JSON.stringify(seatsIndex));

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;
  total.innerText = selectedSeatsCount * ticketPrice;

  setMovieData(movieSelect.selectedIndex, movieSelect.value);
}


// Get data from localstorage and populate UI
function populateUI() {
  const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((tseat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        console.log(tseat.classList.add("tselected"));
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
    console.log(selectedMovieIndex)
  }
}
console.log(populateUI())
// Movie select event
movieSelect.addEventListener("change", (e) => {
  ticketPrice = +e.target.value;
  setMovieData(e.target.selectedIndex, e.target.value);
  updateSelectedCount();
});

// Seat click event
container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("tseat") &&
    !e.target.classList.contains("tsold")
  ) {
    e.target.classList.toggle("tselected");

    updateSelectedCount();
  }
});

// Initial count and total set
updateSelectedCount();
		</script>
<?php include('footer.php');?>
<script type="text/javascript">
	$('#seats').change(function(){
		var charge=<?php echo $screen['charge'];?>;
		amount=charge*$(this).val();
		$('#amount').html("Rs "+amount);
		$('#hm').val(amount);
	});
</script>