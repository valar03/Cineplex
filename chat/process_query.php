<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "cineplex";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle user queries and generate responses
function processUserQuery($query) {
    global $conn;
    $response = '';

    // Convert the array of keywords into a string
    $queryString = implode(" ", $query);

    // Check if the query is related to movie details or show timings
    if (in_array("movie", $query) && in_array("details", $query)) {
        $movieName = '';
        $queryWithoutKeywords = array_diff($query, ["movie", "details"]);

        $sql9 = "SELECT movie_name FROM tbl_movie";
        $result9 = $conn->query($sql9);

        if ($result9->num_rows > 0) {
            while ($row = $result9->fetch_assoc()) {
                $movie = $row["movie_name"];
                $movieKeywords = explode(" ", strtolower($movie));
                if (array_intersect($movieKeywords, $queryWithoutKeywords) === $movieKeywords) {
                    $movieName = $movie;
                    break; // Exit the loop once the movie name is found
                }
            }
        }

        // Retrieve movie details from the database
        $sql = "SELECT * FROM tbl_movie WHERE movie_name = '$movieName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Movie found, generate response with details
            while ($row = $result->fetch_assoc()) {
                $response .= "Movie Name: " . $row["movie_name"] . "<br>";
                $response .= "Cast: " . $row["cast"] . "<br>";
                $response .= "Description: " . $row["desc"] . "<br>";
                $response .= "Release Date: " . $row["release_date"] . "<br>";
                $response .= "Image: <img src='" . $row["image"] . "'><br>";
            }
        } else {
            // Movie not found
            $response = "Sorry, the movie details for '$movieName' could not be found.";
        }
    } elseif (in_array("show", $query) && in_array("timings", $query)) {
        $movieName = '';
        $queryWithoutKeywords = array_diff($query, ["show", "timings"]);

        $sql3 = "SELECT movie_name FROM tbl_movie";
        $result3 = $conn->query($sql3);

        if ($result3->num_rows > 0) {
            while ($row = $result3->fetch_assoc()) {
                $movie = $row["movie_name"];
                $movieKeywords = explode(" ", strtolower($movie));
                if (array_intersect($movieKeywords, $queryWithoutKeywords) === $movieKeywords) {
                    $movieName = $movie;
                    break; // Exit the loop once the movie name is found
                }
            }
        }

        if ($movieName != '') {
            $sql2 = "SELECT tbl_theatre.name, tbl_theatre.address, tbl_theatre.place, tbl_show_time.start_time
                     FROM tbl_shows
                     JOIN tbl_show_time ON tbl_shows.st_id = tbl_show_time.st_id
                     JOIN tbl_theatre ON tbl_shows.theatre_id = tbl_theatre.id
                     JOIN tbl_movie ON tbl_shows.movie_id = tbl_movie.movie_id
                     WHERE tbl_movie.movie_name = '$movieName'";

            // Retrieve show timings from the database
            $result2 = $conn->query($sql2);

            if ($result2->num_rows > 0) {
                // Movie found, generate response with details
                $response .= "Show Timings and theatre details for " . $movieName . ":<br>";
                while ($row = $result2->fetch_assoc()) {
                    $start_time = $row["start_time"];

                    // Split the time into hours, minutes, and seconds
                    $timeParts = explode(':', $start_time);
                    $hours = (int)$timeParts[0];
                    $minutes = (int)$timeParts[1];

                    // Convert hours to 12-hour format
                    $amPm = $hours >= 12 ? 'PM' : 'AM';
                    $hours = $hours % 12;
                    $hours = $hours ? $hours : 12; // Handle the case when hours is 0

                    // Remove leading zeros from minutes
                    $minutes = ltrim($minutes, '0');

                    // Create the formatted time string
                    $formattedTime = $hours . ($minutes ? ':' . $minutes : '') . ' ' . $amPm;

                    $response .= $formattedTime . ",";
                    $response .=  $row["name"] . "," . $row["address"] . "," . $row["place"] . "<br>";
                }
            } else {
                $response .= "No show timings found for the movie '$movieName'.";
            }
        } else {
            $response = "Sorry, no matching movie name found in the query.";
        }
    }
    elseif (in_array("available", $query) && in_array("movies", $query)) {
        // Retrieve movie details from the database
        $sql1 = "SELECT movie_name FROM tbl_movie";
        $result1 = $conn->query($sql1);
        $response .= "Available movies <br>";
        if ($result1->num_rows > 0) {
            // Movie found, generate response with details
            while ($row = $result1->fetch_assoc()) {
                $response .= $row["movie_name"] . "<br>";
            }
        } else {
            // Movie not found
            $response = "No movies are available";
        }
    } elseif (in_array("how", $query) && in_array("are", $query) && in_array("you", $query)) {
        $response = "I'm fine. Thank you!";
    } elseif (in_array("hello", $query) || in_array("hi", $query)) {
        $response = "Hello!I can provide you the available movies,movie details,show timings,go to a particular page.";
    } 
    elseif (in_array("description",$query)) {
        $movieName = '';
        $queryWithoutKeywords = array_diff($query, ["description"]);

        $sql9 = "SELECT movie_name FROM tbl_movie";
        $result9 = $conn->query($sql9);

        if ($result9->num_rows > 0) {
            while ($row = $result9->fetch_assoc()) {
                $movie = $row["movie_name"];
                $movieKeywords = explode(" ", strtolower($movie));
                if (array_intersect($movieKeywords, $queryWithoutKeywords) === $movieKeywords) {
                    $movieName = $movie;
                    break; // Exit the loop once the movie name is found
                }
            }
        }

        // Retrieve movie details from the database
        $sql = "SELECT * FROM tbl_movie WHERE movie_name = '$movieName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Movie found, generate response with details
            while ($row = $result->fetch_assoc()) {
                $response .= "Description: " . $row["desc"] . "<br>";
            }
        } else {
            // Movie not found
            $response = "Sorry, the movie details for '$movieName' could not be found.";
        }
        
    } elseif (in_array("movie", $query) || in_array("movies", $query)) {
        $lang = '';
        $genre = '';
        $queryWithoutKeywords = array_diff($query, ["movie", "movies"]);
    
        $sqlLang = "SELECT lang FROM lang";
        $resultLang = $conn->query($sqlLang);
    
        if ($resultLang->num_rows > 0) {
            while ($row = $resultLang->fetch_assoc()) {
                $language = $row["lang"];
                $languageKeywords = explode(" ", strtolower($language));
                if (array_intersect($languageKeywords, $queryWithoutKeywords) === $languageKeywords) {
                    $lang = $language;
                    break; // Exit the loop once the language is found
                }
            }
        }
    
        $sqlGenre = "SELECT genre FROM genre";
        $resultGenre = $conn->query($sqlGenre);
    
        if ($resultGenre->num_rows > 0) {
            while ($row = $resultGenre->fetch_assoc()) {
                $genreName = $row["genre"];
                $genreKeywords = explode(" ", strtolower($genreName));
                if (array_intersect($genreKeywords, $queryWithoutKeywords) === $genreKeywords) {
                    $genre = $genreName;
                    break; // Exit the loop once the genre is found
                }
            }
        }
    
        if ($lang != '' && $genre != '') {
            $sqlMovies = "SELECT tbl_movie.movie_name FROM tbl_movie
                          JOIN lang ON tbl_movie.lang_id = lang.lang_id
                          JOIN genre ON tbl_movie.genre_id = genre.genre_id
                          WHERE lang.lang = '$lang' AND genre.genre = '$genre'";
    
            $resultMovies = $conn->query($sqlMovies);
    
            if ($resultMovies->num_rows > 0) {
                $response .= "Movies available in $lang under the $genre genre:<br>";
                while ($rowMovies = $resultMovies->fetch_assoc()) {
                    $response .= $rowMovies["movie_name"] . "<br>";
                }
            } else {
                $response .= "No movies found in $lang under the $genre genre.";
            }
        } elseif ($lang != '') {
            $sqlMovies = "SELECT tbl_movie.movie_name FROM tbl_movie
                          JOIN lang ON tbl_movie.lang_id = lang.lang_id
                          WHERE lang.lang = '$lang'";
    
            $resultMovies = $conn->query($sqlMovies);
    
            if ($resultMovies->num_rows > 0) {
                $response .= "Movies available in $lang:<br>";
                while ($rowMovies = $resultMovies->fetch_assoc()) {
                    $response .= $rowMovies["movie_name"] . "<br>";
                }
            } else {
                $response .= "No movies found in $lang.";
            }
        } elseif ($genre != '') {
            $sqlMovies = "SELECT tbl_movie.movie_name FROM tbl_movie
                          JOIN genre ON tbl_movie.genre_id = genre.genre_id
                          WHERE genre.genre = '$genre'";
    
            $resultMovies = $conn->query($sqlMovies);
    
            if ($resultMovies->num_rows > 0) {
                $response .= "Movies available under the $genre genre:<br>";
                while ($rowMovies = $resultMovies->fetch_assoc()) {
                    $response .= $rowMovies["movie_name"] . "<br>";
                }
            } else {
                $response .= "No movies found under the $genre genre.";
            }
        }
    }
    
       elseif (in_array("trailer", $query)) {
        $movieName = '';
        $queryWithoutKeywords = array_diff($query, ["trailer"]);

        $sql9 = "SELECT movie_name FROM tbl_movie";
        $result9 = $conn->query($sql9);

        if ($result9->num_rows > 0) {
            while ($row = $result9->fetch_assoc()) {
                $movie = $row["movie_name"];
                $movieKeywords = explode(" ", strtolower($movie));
                if (array_intersect($movieKeywords, $queryWithoutKeywords) === $movieKeywords) {
                    $movieName = $movie;
                    break; // Exit the loop once the movie name is found
                }
            }
        }

        $sql = "SELECT video_url FROM tbl_movie WHERE movie_name = '$movieName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Movie found, generate response with details
            while ($row = $result->fetch_assoc()) {
                $url = $row["video_url"];

                // Generate JavaScript code to perform the redirect on the client side
                $javascriptCode = "<script>window.location.href = '$url';</script>";
                // Return the JavaScript code as the response
                return $javascriptCode;
            }
        } else {
            $response .= "Sorry, no trailer found for the movie '$movieName'.";
        }
    } else {
        // Other queries not supported
        $response = "Sorry, I couldn't understand your query.";
    }

    return $response;
}

// Get the user's query from the URL parameter
$userQuery = $_GET["query"];

$keywords = explode(" ", strtolower($userQuery));

// Process the user's query and generate a response
$response = processUserQuery($keywords);

// Send the response back to the frontend
echo $response;

// Close the database connection
$conn->close();
?>
