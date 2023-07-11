<?php include('header.php') ?>
<style>
    .section h4 {
        margin-bottom: 25px;
        margin-top: 50px;
        color: darkorange;
        font-size: 35px;
        position: relative;
        font-family: "Oswald", sans-serif;
    }

    .button {
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button3 {
        background-color: white;
        color: darkgray;
        border: 2px solid darkgray;
    }

    .button3:hover {
        background-color: darkgray;
        color: white;
    }

    .order {
        padding: 5px;
        width: 33.33%;
        height: 100%;
        float: left;
        display: flex;
        align-items: center; /* Vertically center align items */
        justify-content: space-around; /* Add space between items */
    }
    .next{
        float: left;
        display: flex;
        align-items: center; /* Vertically center align items */
        justify-content: space-around;
    }
    .order::after {
        content: "";
        clear: both;
        display: table;
    }

    .im {
        width: 500px;
        height: 300px;
    }
</style>
<div class="container">
    <div class="section">
        <h4>Genre</h4>
    </div>
    <div class="next">
        <?php
        $qry3 = mysqli_query($con, "SELECT * FROM genre");
        while ($n = mysqli_fetch_array($qry3)) {
            $langId = $n['genre_id'];
            ?>
            <form action="genre.php" method="GET">
                <button class="button button3" type="submit" name="genre_id" value="<?php echo $langId; ?>"><?php echo $n['genre']; ?></button>
            </form>
        <?php } ?>
    </div>
    <div class="clear"></div><br><br><br><br>
    <?php
    if(!isset($_GET['genre_id'])){
        $genreId = 1;
        $today = date("Y-m-d");
        $qry2 = mysqli_query($con, "SELECT * FROM tbl_movie WHERE genre_id = $genreId");

        while ($m = mysqli_fetch_array($qry2)) {
            ?>
            <div class="order"><br>
                <div class="movie-text">
                    <h4 class="h-text"><a href="about.php?id=<?php echo $m['movie_id'];?>"><?php echo $m['movie_name'];?></a></h4>
                    Cast: <span class="color2"><?php echo $m['cast'];?></span><br><br><br>
                </div>
                <a href="about.php?id=<?php echo $m['movie_id'];?>"><img class="im" src="<?php echo $m['image'];?>" alt="" /></a>
            </div>
        <?php
        }
    }
    if (isset($_GET['genre_id'])) {
        $genreId = $_GET['genre_id'];
        $today = date("Y-m-d");
        $qry2 = mysqli_query($con, "SELECT * FROM tbl_movie WHERE genre_id = $genreId");

        while ($m = mysqli_fetch_array($qry2)) {
            ?>
            <div class="order"><br>
                <div class="movie-text">
                    <h4 class="h-text"><a href="about.php?id=<?php echo $m['movie_id'];?>"><?php echo $m['movie_name'];?></a></h4>
                    Cast: <span class="color2"><?php echo $m['cast'];?></span><br><br><br>
                </div>
                <a href="about.php?id=<?php echo $m['movie_id'];?>"><img class="im" src="<?php echo $m['image'];?>" alt="" /></a>
            </div>
        <?php
        }
    }
    ?>
</div><br><br><br><br>
<div class="clear"></div>
<?php include('footer.php') ?>
