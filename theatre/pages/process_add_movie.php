<?php
    session_start();
    include('../../config.php');
    extract($_POST);
    
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    $flname = "images/" . basename($_FILES["image"]["name"]);

    $lang_query = "SELECT lang_id FROM lang WHERE lang = '".$_POST['lang']."'";
    $lang_result = mysqli_query($con, $lang_query);
    $lang_row = mysqli_fetch_array($lang_result);
    $lang = $lang_row['lang_id'];

    $genre_query = "SELECT genre_id FROM genre WHERE genre = '".$_POST['genre']."'";
    $genre_result = mysqli_query($con, $genre_query);
    $genre_row = mysqli_fetch_array($genre_result);
    $genre = $genre_row['genre_id'];

    $desc = mysqli_real_escape_string($con, $desc);

    mysqli_query($con, "INSERT INTO `tbl_movie`(`movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status`, `lang_id`, `genre_id`) VALUES (NULL,'".$_SESSION['theatre']."','$name','$cast','$desc','$rdate','$flname','$video','0','$lang','$genre')");

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    
    $_SESSION['success'] = "Movie Added";
    header('location:add_movie.php');
?>
