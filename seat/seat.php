<?php
include('../config.php');
session_start();
date_default_timezone_set('Asia/Kolkata');
$qry2 = mysqli_query($con, "select * from tbl_movie where movie_id='" . $_SESSION['movie'] . "'");
$movie = mysqli_fetch_array($qry2);
?>

<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="tstyle.css" />
  <title>Movie Seat Booking</title>
</head>
    
<body>
  <?php
  $s = mysqli_query($con, "select * from tbl_shows where s_id='" . $_SESSION['show'] . "'");
  $shw = mysqli_fetch_array($s);
  $t = mysqli_query($con, "select * from tbl_theatre where id='" . $shw['theatre_id'] . "'");
  $theatre = mysqli_fetch_array($t);

  $ttm = mysqli_query($con, "select  * from tbl_show_time where st_id='" . $shw['st_id'] . "'");
  $ttme = mysqli_fetch_array($ttm);

  $sn = mysqli_query($con, "select  * from tbl_screens where screen_id='" . $ttme['screen_id'] . "'");
  $screen = mysqli_fetch_array($sn);

  $seats_per_row = 10; // Change this value to adjust the number of seats per row
  $total_seats = $screen['seats'];

  // Calculate the number of rows required based on the total number of seats and seats per row
  $total_rows = ceil($total_seats / $seats_per_row);
  
  // Get all sold seats for the selected show
 

  // Calculate the minimum date based on the condition
  $start_time = strtotime($ttme['start_time']);
  $current_time = strtotime(date('H:i:s'));
  $min_date = ($start_time <= $current_time) ? date('Y-m-d', strtotime('+1 day')) : date('Y-m-d');
  if(isset($_GET['sett'])){
    $_SESSION['datee']=$_GET['datee']; 
  }else{
    $_SESSION['datee']=$min_date;
  }

  $sold_seats = array();
  $b = mysqli_query($con, "select * from tbl_bookings where show_id='" . $_SESSION['show'] . "'");
  while ($bh = mysqli_fetch_array($b)) {
    if (!empty($bh['seatno']) && ($bh['ticket_date'] == $_SESSION['datee'])) {
      $sold_seats = array_merge($sold_seats, explode(',', $bh['seatno'])); // Merge the sold seats into the array
    }
  }

  ?>

  <div class="movie-container">
    <input type="hidden" name="screen" value="<?php echo $screen['screen_id']; ?>" />
    <input type="hidden" required title="Number of Seats" max="<?php echo $screen['seats'] - $avl[0]; ?>" min="0"
      name="seats" class="form-control" value="1" style="text-align:center" id="seats" />
    <input type="hidden" name="amount" id="hm" value="<?php echo $screen['charge']; ?>" />
    <input type="hidden" name="date" value="<?php echo $date; ?>" />
    <select id="movie">
      <option value="<?php echo $screen['charge']; ?>"></option>
    </select>
  </div>
    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat sold"></div>
        <small>Sold</small>
      </li>
    </ul>
    <form action="" method="get">
    <div class="container">
      <div class="screen"></div>
      <div class="seat-details">
        <label for="datee">Date:</label>
        <input type="date" name="datee" id="datee" min="<?php echo $min_date; ?>" value="<?php echo $_SESSION['datee']; ?>" />
        <button name="sett">select</button>
      </div><br>
    </form>
    
      <form action="../booking.php" method="post">
      <?php
      $seat_number = 1;
      for ($row = 1; $row <= $total_rows; $row++) {
        echo '<div class="row" data-row="' . $row . '">';
        for ($seat = 1; $seat <= $seats_per_row; $seat++) {
          if ($seat_number <= $total_seats) {
            $seat_class = in_array($row . chr(64 + $seat), $sold_seats)? 'seat sold' : 'seat';
            echo '<div class="' . $seat_class . '" data-seat="' . $seat . '"></div>';
            $seat_number++;
          }
        }
        echo '</div>';
      }
      ?>
    </div>

    <div class="seat-details">
      <label for="selected-seats">Selected Seats:</label>
      <input type="text" name="selected_seats" id="selected-seats" readonly />
    </div>
    <div class="seat-details">
      <label for="num-seats">Number of Seats:</label>
      <input type="text" name="num_seats" id="num-seats" readonly />
    </div>
    <div class="seat-details">
      <label for="total-amount">Total Amount:</label>
      <input type="text" name="total_amount" id="total-amount" readonly />
    </div>

    <button name="set">CONFIRM</button>
  </form>
  <script>
    const container = document.querySelector(".container");
    const seats = document.querySelectorAll(".row .seat:not(.sold)");
    const count = document.getElementById("count");
    const total = document.getElementById("total");
    const movieSelect = document.getElementById("movie");
    const selectedSeatsInput = document.getElementById("selected-seats");
    const numSeatsInput = document.getElementById("num-seats");
    const totalAmountInput = document.getElementById("total-amount");

    populateUI();

    let ticketPrice = +movieSelect.value;

    // Save selected movie index and price
    function setMovieData(movieIndex, moviePrice) {
      localStorage.setItem("selectedMovieIndex", movieIndex);
      localStorage.setItem("selectedMoviePrice", moviePrice);
    }

    // Update total and count
    function updateSelectedCount() {
      const selectedSeats = document.querySelectorAll(".row .seat.selected");

      const seatsIndex = [...selectedSeats].map((seat) => [
        ...seats
      ].indexOf(seat));

      const selectedSeatNames = [...selectedSeats].map((seat) =>
        seat.parentElement.dataset.row + String.fromCharCode(65 + parseInt(seat.dataset.seat) - 1)
      );

      selectedSeatsInput.value = selectedSeatNames.join(",");

      const selectedSeatsCount = selectedSeats.length;
      const totalAmount = selectedSeatsCount * ticketPrice;

      numSeatsInput.value = selectedSeatsCount;
      totalAmountInput.value = totalAmount.toFixed(2);

      setMovieData(movieSelect.selectedIndex, movieSelect.value);
    }

    // Get data from localstorage and populate UI
    function populateUI() {
      const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

      if (selectedSeats !== null && selectedSeats.length > 0) {
        seats.forEach((seat, index) => {
          if (selectedSeats.indexOf(index) > -1) {
            seat.classList.add("selected");
          }
        });
      }

      const selectedMovieIndex = localStorage.getItem("selectedMovieIndex");

      if (selectedMovieIndex !== null) {
        movieSelect.selectedIndex = selectedMovieIndex;
      }
    }

    // Movie select event
    movieSelect.addEventListener("change", (e) => {
      ticketPrice = +e.target.value;
      setMovieData(e.target.selectedIndex, e.target.value);
      updateSelectedCount();
    });

    // Seat click event
    container.addEventListener("click", (e) => {
      if (
        e.target.classList.contains("seat") &&
        !e.target.classList.contains("sold")
      ) {
        e.target.classList.toggle("selected");
        updateSelectedCount();
      }
    });

    // Initial count and total set
    updateSelectedCount();
  </script>
  <script>
    var today = new Date();
    var minDate = today.toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
    var maxDate = new Date(today.getTime() + 10 * 24 * 60 * 60 * 1000) // Add 10 days
      .toISOString()
      .split('T')[0]; // Get the date 10 days from today in YYYY-MM-DD format

    document.getElementById('datee').setAttribute('min', minDate);
    document.getElementById('datee').setAttribute('max', maxDate);
  </script>
</body>

</html>
