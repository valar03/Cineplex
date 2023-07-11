<?php
    session_start();
    include('../../config.php');
    extract($_POST);
    foreach($stime as $time)
    {
        mysqli_query($con,"INSERT INTO `tbl_shows`(`s_id`, `st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status`, `nos`) values(NULL,'$time','".$_SESSION['theatre']."','$movie','$sdate','1','0','0')");

    }
    $_SESSION['success']="Show Added";
    header('location:add_show.php');
    ?>
    