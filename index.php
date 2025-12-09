<?php
session_start();
include 'includes/db.php';

//Handling delete request
if (isset($_GET['delete_movie_id'])){
    $movie_id=$_GET['delete_movie_id'];
    $conn->query("DELETE FROM movie_genres WHERE movie_id= $movie_id ");
    $conn->query("DELETE FROM movies WHERE movie_id= $movie_id ");
}


// Fetch all genres
$genres = $conn->query("SELECT * FROM genres");

// Define genre image URLs manually
$genreImages = [
    'Action/Thriller' => 'https://athlonoutdoors.com/wp-content/uploads/2020/10/80saction1.jpg',
    'Drama/Comedy' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-RENzle6x1SROzSXeeN5e1dlot3gtSdXv2Q&s',
    
    'Romance' => 'https://hips.hearstapps.com/hmg-prod/images/awf-1641313247.jpeg?crop=0.671xw:1.00xh;0.114xw,0&resize=640:*',
    
    'Fantasy' => 'https://i.pinimg.com/736x/da/e5/6b/dae56b573bc4f4974b279ccb2f26e25e.jpg',
    'Anime' => 'https://rukminim2.flixcart.com/image/850/1000/ky90scw0/poster/3/v/s/medium-anime-girls-original-characters-women-brunette-long-hair-original-imagagtrzcmedmrg.jpeg?q=20&crop=false'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Recommendation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f2f2;
        }

        .navbar {
            background-color:rgb(15, 17, 15);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .navbar a.logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .navbar nav ul {
            list-style-type: none;
            display: flex;
            gap: 1.5rem;
        }

        .navbar nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar nav ul li a:hover {
            background-color:rgb(8, 9, 8);
        }

        .container {
            padding: 2rem;
            text-align: center;
        }

        .main-heading {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
        }

        .genre-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
        }

        .genre-card {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 1rem;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .genre-card:hover {
            transform: scale(1.05);
        }

        .genre-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .genre-card h2 {
            font-size: 1.2rem;
            margin: 0.8rem 0;
        }

        .genre-card .button {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .genre-card .button:hover {
            background-color: #388E3C;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color:rgb(15, 17, 15);
            color: white;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<div class="navbar">
    <a href="index.php" class="logo">Movie Recommender</a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="login.php?logout=true">Logout/Login</a></li>
                <li><a href="add_movie.php">Add Movie</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Main Content -->
<div class="container">
    <h1 class="main-heading">Browse Movies by Genre</h1>

    <div class="genre-grid">
        <?php while ($genre = $genres->fetch_assoc()) {
            $genreName = htmlspecialchars($genre['name']);
            $imageUrl = $genreImages[$genreName] ?? 'https://via.placeholder.com/250x200?text=' . urlencode($genreName);
        ?>
            <div class="genre-card">
                <img src="<?php echo $imageUrl; ?>" alt="<?php echo $genreName; ?>">
                <h2><?php echo $genreName; ?></h2>
                <a href="genre_movies.php?genre_id=<?php echo $genre['genre_id']; ?>" class="button">Explore</a>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Movie Recommendation System. All rights reserved.</p>
</footer>

</body>
</html>
