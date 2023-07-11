<?php
require_once("config.php");
require('fpdf185/fpdf.php');
session_start();

if(isset($_POST['pdff'])){
    $ticketid=$_POST['ticid'];
    
    $tic="SELECT * from tbl_bookings where ticket_id='".$ticketid."'";
    $res=mysqli_query($con,$tic);
    $row=mysqli_fetch_array($res);

    $movie_query = "SELECT tbl_movie.movie_name FROM tbl_bookings join tbl_shows on tbl_bookings.show_id=tbl_shows.s_id join tbl_movie on tbl_shows.movie_id=tbl_movie.movie_id WHERE tbl_shows.s_id = '".$row['show_id']."'";
    $movie_result = mysqli_query($con, $movie_query);
    $movie_row = mysqli_fetch_array($movie_result);
    $movie_name = $movie_row['movie_name'];
    
    //$show_name = $row['show_name'];
    
    $theatre_query = "SELECT name FROM tbl_theatre WHERE id = '".$row['t_id']."'";
$theatre_result = mysqli_query($con, $theatre_query);
$theatre_row = mysqli_fetch_array($theatre_result);
$theatre_name = $theatre_row['name'];

$screen_query = "SELECT screen_name FROM tbl_screens WHERE screen_id = '".$row['screen_id']."'";
$screen_result = mysqli_query($con, $screen_query);
$screen_row = mysqli_fetch_array($screen_result);
$screen_name = $screen_row['screen_name'];

   // $show_name = $row['show_name'];
    $ticket_date = $row['ticket_date'];
    $no_seats = $row['no_seats'];
    $seatno = $row['seatno'];
    $amount = $row['amount'];

    // Store the required session variables
    $_SESSION['tickett'] = $ticketid;
    $_SESSION['tmovie'] = $movie_name;
    $_SESSION['ttname'] = $theatre_name;
    $_SESSION['tsname'] = $screen_name;
  //  $_SESSION['tshname'] = $show_name;
    $_SESSION['tdate'] = $ticket_date;
    $_SESSION['tno_seats'] = $no_seats;
    $_SESSION['tseatno'] = $seatno;
    $_SESSION['tamt'] = $amount;
}


    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('ticket.jpeg', 0, 0);
    $pdf->SetFont('Arial', '', 12);
    

    // Set up table structure
    $pdf->SetXY(60, 120); // Adjust the X and Y coordinates as per your requirement
    $pdf->Cell(40, 10, 'Booking Id', 1, 0, 'L');
    $pdf->Cell(40, 10, $ticketid, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Movie', 1, 0, 'L');
    $pdf->Cell(40, 10, $movie_name, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Theatre', 1, 0, 'L');
    $pdf->Cell(40, 10, $theatre_name, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Screen', 1, 0, 'L');
    $pdf->Cell(40, 10, $screen_name, 1, 1, 'L');
    $pdf->SetX(60);
   // $pdf->Cell(40, 10, 'Show', 1, 0, 'L');
    //$pdf->Cell(40, 10, $_SESSION['tshname'], 1, 1, 'L');
    //$pdf->SetX(60);
    $pdf->Cell(40, 10, 'Date', 1, 0, 'L');
    $pdf->Cell(40, 10, $ticket_date, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Seats', 1, 0, 'L');
    $pdf->Cell(40, 10, $no_seats, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Seat No', 1, 0, 'L');
    $pdf->Cell(40, 10, $seatno, 1, 1, 'L');
    $pdf->SetX(60);
    $pdf->Cell(40, 10, 'Amount', 1, 0, 'L');
    $pdf->Cell(40, 10, $amount, 1, 1, 'L');
    
    // Output the generated PDF
    $pdf->Output();

?>
