<?php
session_start();
include 'includes/db.php';

//Handling delete request
/*if (isset($_GET['delete_movie_id'])){
    $MOVIE_ID=$_GET['delete_movie_id'];
    $conn->query("DELETE FROM movies WHERE movie_id= $MOVIE_ID ");
}*/

// Fetch genre
$genre_id = isset($_GET['genre_id']) ? intval($_GET['genre_id']) : 0;
$genre_query = $conn->prepare("SELECT name FROM genres WHERE genre_id = ?");
$genre_query->bind_param("i", $genre_id);
$genre_query->execute();
$genre_result = $genre_query->get_result();

if ($genre_result->num_rows === 0) {
    echo "<h2>Genre not found.</h2>";
    exit();
}

$genre = $genre_result->fetch_assoc();
$genre_name = $genre['name'];

// Fetch movies by genre
$movies_query = $conn->prepare("
    SELECT m.*, l.name AS language_name 
    FROM movies m 
    JOIN movie_genres mg ON m.movie_id = mg.movie_id 
    JOIN languages l ON m.language_id = l.language_id 
    WHERE mg.genre_id = ?
");

$movies_query->bind_param("i", $genre_id);
$movies_query->execute();
$movies = $movies_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($genre_name); ?> Movies</title>
    <style>
        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color:rgb(10, 11, 10);
            padding: 1rem 2rem;
            color: white;
        }

        .navbar a.logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .navbar nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1.5rem;
        }

        .navbar nav ul li {
            display: inline;
        }

        .navbar nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar nav ul li a:hover {
            background-color: #45a049;
        }
        /* Container for movie cards */
.movie-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    padding: 2rem;
}

/* Individual movie card */
.movie-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    text-align: center;
}

/* Movie image */
.movie-image {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 8px;
}

/* Title and description */
.movie-card h4 {
    margin: 1rem 0 0.5rem;
    font-size: 1.2rem;
}

.movie-card p {
    font-size: 0.95rem;
    color: #444;
}

/* Buttons */
.button {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin-top: 0.5rem;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    color: white;
    transition: background-color 0.3s ease;
}

.button.update {
    background-color: #2196F3;
}

.button.update:hover {
    background-color: #1976D2;
}

.button.delete {
    background-color: #f44336;
}

.button.delete:hover {
    background-color: #d32f2f;
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
        <a href="index.php" class="logo">Movie Recommendation</a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="index.php?logout=true">Logout</a></li>
                    <li><a href="add_movie.php">Add Movie</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Genre Header -->
    <div class="container">
        <h1 class="main-heading"><?php echo htmlspecialchars($genre_name); ?> Movies</h1>

        <!-- Movies List -->
        <div class="movie-grid">
            <?php while ($movie = $movies->fetch_assoc()): ?>
                <div class="movie-card">
                    <img src="<?php echo $movie['IMAGE']; ?>" alt="<?php echo $movie['title']; ?>" class="movie-image">
                    <h4><?php echo $movie['title']; ?> (<?php echo $movie['release_year']; ?>)</h4>
                    <p><strong>Language:</strong> <?php echo htmlspecialchars($movie['language_name']); ?></p>
                    <p><strong>Ratings: </strong><?php echo $movie['ratings']; ?> 

                    
                    <p><?php echo $movie['description']; ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="update_movie.php?movie_id=<?php echo $movie['movie_id']; ?>" class="button update">Update</a>
                        <a href="index.php?delete_movie_id=<?php echo $movie['movie_id']; ?>" class="button delete" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Movie Recommendation. All rights reserved.</p>
    </footer>
</body>
</html>
