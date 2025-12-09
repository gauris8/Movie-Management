# Movie Management System 🎬

## Overview  
**Movie Management System** is a web-based application developed using **HTML, CSS, JavaScript, PHP, and MySQL**. It provides functionalities for both regular users and administrators to browse and manage a database of movies. Users can explore movies by genre and language, while administrators can perform CRUD (Create, Read, Update, Delete) operations on movie records via a secure web interface.

## Problem Statement  
Managing a growing collection of movies with spreadsheets or static lists becomes inefficient, error-prone, and hard to scale. Users have difficulty finding movies matching their preferences, and administrators struggle to keep the data updated. This system aims to solve those problems by offering an interactive and structured solution — enabling scalable browsing, filtering, and backend management of movie data.

## Key Features  
- **User features**  
  - Browse movies by **genre** and **language**  
  - View movie details (title, description, genre, language, etc.)  
  - Optional: search / filter by different criteria (genre, language)  

- **Admin features (requires authentication)**  
  - Add new movie entries  
  - Update existing movie details  
  - Delete outdated or incorrect movie records  
  - Manage database to maintain data integrity  

- **Database design**  
  - Uses a **normalized MySQL relational database** to store movies, genres, languages, and users  
  - Relations ensure minimal redundancy and support scalability  

- **Frontend & Backend**  
  - Clean and responsive UI built with HTML, CSS, JavaScript  
  - Backend logic and session management handled by PHP  
  - Secure database operations using prepared statements / validations  

## Tech Stack / Configuration  
- **Frontend**: HTML, CSS, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL  
- **Authentication & Authorization**: PHP sessions / login-logout logic  
- **Server Requirements**: Any LAMP/WAMP/XAMPP/AMPPS environment (PHP + MySQL + Apache)  

---

## 🚀 Installation / Setup Instructions  

### For **Windows** (using XAMPP)

1. Download and install **XAMPP** from its official website. :contentReference[oaicite:1]{index=1}  
2. During installation, ensure Apache, PHP, MySQL (and optionally phpMyAdmin) are selected. :contentReference[oaicite:2]{index=2}  
3. After installation, open the XAMPP Control Panel and **start Apache and MySQL** services. :contentReference[oaicite:3]{index=3}  
4. Place your project folder inside XAMPP’s `htdocs` (e.g. `C:\xampp\htdocs\Movie-Management`).  
5. Go to `http://localhost/phpmyadmin` in your browser to open database manager. Create a new database (e.g. `movie_db`) and **import your SQL schema file** (if you have one). :contentReference[oaicite:4]{index=4}  
6. Configure database connection in your PHP config file (e.g. `db_config.php`) — set `host = localhost`, `username = root`, `password = (as per your MySQL config)`, and `database = movie_db`.  
7. Open browser at `http://localhost/Movie-Management/` — you should see the application home or login page.  

### For **macOS** (using LAMP / Homebrew / XAMPP)

You can either install a full bundle like XAMPP for macOS, or manually set up a LAMP stack:

**Option A: XAMPP for macOS**  
- Download the macOS installer (DMG) from XAMPP site, open it and drag XAMPP to your Applications. :contentReference[oaicite:5]{index=5}  
- Open XAMPP, and start **Apache** and **MySQL**. :contentReference[oaicite:6]{index=6}  
- Put your project folder inside the web-root (e.g. `/Applications/XAMPP/htdocs/Movie-Management`)  
- Use `http://localhost/ Movie-Management/` to access the app after database setup via phpMyAdmin.  

**Option B: Manual LAMP setup (using package manager)**  
- On macOS with Homebrew installed: run commands to install Apache, PHP, MySQL:  
  ```bash
  brew install httpd
  brew install [email protected]     # or another PHP version
  brew install mysql
  ``` :contentReference[oaicite:7]{index=7}  
- Start the services, configure Apache to support PHP (update `httpd.conf` to load PHP module), and set DocumentRoot or Sites directory. :contentReference[oaicite:8]{index=8}  
- Place your project in the web root (e.g. `/usr/local/var/www/` or custom directory)  
- Start MySQL server, and create database + import schema (use mysql CLI or a GUI like phpMyAdmin if installed) :contentReference[oaicite:9]{index=9}  
- Access the application via `http://localhost:8080/` (or whichever port Apache runs on)  

### For **Linux** (Ubuntu / Debian or similar)

1. Open terminal and update package lists:
   ```bash
   sudo apt update

### For Cloning

 Clone the repository:  
   ```bash
   git clone https://github.com/<your-username>/<your-repo-name>.git
