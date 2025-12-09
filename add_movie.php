<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch languages and genres
$languages = $conn->query("SELECT * FROM languages");
$genres = $conn->query("SELECT * FROM genres");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];
    $language_id = $_POST['language_id'];
    $image = $_POST['image'];
    $genres_selected = $_POST['genres'] ?? [];

    $stmt = $conn->prepare("INSERT INTO movies (title, release_year, description, language_id, IMAGE) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisis", $title, $release_year, $description, $language_id, $image);
    $stmt->execute();
    $movie_id = $stmt->insert_id;

    foreach ($genres_selected as $genre_id) {
        $conn->query("INSERT INTO movie_genres (movie_id, genre_id) VALUES ($movie_id, $genre_id)");
    }

    echo "<p>Movie added successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f7fa;
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
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: bold;
        color: #333;
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
        background-color:rgb(24, 27, 24);
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
        background-color:rgb(19, 20, 19);
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
<h2>Add Movie</h2>
<form method="post">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>

    <label>Release Year:</label><br>
    <input type="number" name="release_year" required><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>

    <label>Language:</label><br>
    <select name="language_id">
        <?php while ($lang = $languages->fetch_assoc()): ?>
            <option value="<?= $lang['language_id'] ?>"><?= $lang['name'] ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Genres:</label><br>
    <?php while ($genre = $genres->fetch_assoc()): ?>
        <label><input type="checkbox" name="genres[]" value="<?= $genre['genre_id'] ?>"> <?= $genre['name'] ?></label><br>
    <?php endwhile; ?>

    <label>Image Path:</label><br>
    <input type="text" name="image" required><br><br>

    <button type="submit">Add Movie</button>
</form>
</body>
</html>
