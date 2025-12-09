<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$movie_id = isset($_GET['movie_id']) ? intval($_GET['movie_id']) : 0;
if ($movie_id <= 0) {
    echo "Invalid movie ID.";
    exit();
}

// Fetch movie details
$movie_stmt = $conn->prepare("SELECT * FROM movies WHERE movie_id = ?");
$movie_stmt->bind_param("i", $movie_id);
$movie_stmt->execute();
$movie_result = $movie_stmt->get_result();
if ($movie_result->num_rows === 0) {
    echo "Movie not found.";
    exit();
}
$movie = $movie_result->fetch_assoc();

// Fetch all languages and genres
$languages = $conn->query("SELECT * FROM languages");
$genres = $conn->query("SELECT * FROM genres");

// Fetch selected genres for this movie
$selected_genres = [];
$genre_result = $conn->query("SELECT genre_id FROM movie_genres WHERE movie_id = $movie_id");
while ($row = $genre_result->fetch_assoc()) {
    $selected_genres[] = $row['genre_id'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];
    $language_id = $_POST['language_id'];
    $image = $_POST['image'];
    $ratings = $_POST['ratings'];
    $genres_selected = $_POST['genres'] ?? [];
   
    $update_stmt = $conn->prepare("UPDATE movies SET title = ?, release_year = ?, description = ?, language_id = ?, IMAGE = ?, ratings = ? WHERE movie_id = ?");
    $update_stmt->bind_param("sisisdi", $title, $release_year, $description, $language_id, $image, $ratings, $movie_id);
    $update_stmt->execute();


    // Update genres
    $conn->query("DELETE FROM movie_genres WHERE movie_id = $movie_id");
    foreach ($genres_selected as $genre_id) {
        $conn->query("INSERT INTO movie_genres (movie_id, genre_id) VALUES ($movie_id, $genre_id)");
    }

    echo "<p>Movie updated successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Movie</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 2rem;
        color: #333;
    }

    form {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #444;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 0.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    input[type="checkbox"] {
        margin-right: 0.5rem;
    }

    .checkbox-group {
        margin-bottom: 1.5rem;
    }

    button {
        background-color: #2196F3;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #1976D2;
    }

    p {
        text-align: center;
        color: green;
        font-weight: bold;
        margin-top: 1rem;
    }
</style>

</head>
<body>
<h2>Update Movie</h2>
<form method="post">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required><br>

    <label>Release Year:</label><br>
    <input type="number" name="release_year" value="<?= $movie['release_year'] ?>" required><br>

    <label>Description:</label><br>
    <textarea name="description" required><?= htmlspecialchars($movie['description']) ?></textarea><br>

    <label>Language:</label><br>
    <select name="language_id">
        <?php while ($lang = $languages->fetch_assoc()): ?>
            <option value="<?= $lang['language_id'] ?>" <?= $lang['language_id'] == $movie['language_id'] ? 'selected' : '' ?>>
                <?= $lang['name'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>Genres:</label><br>
    <?php while ($genre = $genres->fetch_assoc()): ?>
        <label>
            <input type="checkbox" name="genres[]" value="<?= $genre['genre_id'] ?>"
                <?= in_array($genre['genre_id'], $selected_genres) ? 'checked' : '' ?>>
            <?= $genre['name'] ?>
        </label><br>
    <?php endwhile; ?>

    <label>Image Path:</label><br>
    <input type="text" name="image" value="<?= htmlspecialchars($movie['IMAGE']) ?>" required><br><br>

    <label>Ratings (0.0 - 5.0):</label><br>
    <input type="number" name="ratings" step="0.1" min="0" max="5" value="<?= htmlspecialchars($movie['ratings']) ?>" required>

    <button type="submit">Update Movie</button>
</form>
</body>
</html>
