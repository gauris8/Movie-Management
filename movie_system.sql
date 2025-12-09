CREATE DATABASE IF NOT EXISTS MOVIE_SYSTEM;
USE MOVIE_SYSTEM;

CREATE TABLE IF NOT EXISTS USERS(
	USER_ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    AGE INT,
    EMAIL VARCHAR(100) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS languages (
    language_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);


CREATE TABLE IF NOT EXISTS movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    release_year INT,
    description TEXT,
    language_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (language_id) REFERENCES languages(language_id)
);
CREATE TABLE IF NOT EXISTS genres (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);
CREATE TABLE IF NOT EXISTS movie_genres (
    movie_id INT,
    genre_id INT,
    PRIMARY KEY (movie_id, genre_id),
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);
CREATE TABLE IF NOT EXISTS ratings (
    rating_id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    rating FLOAT,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
);



ALTER TABLE users
ADD COLUMN date_of_birth DATE;





INSERT INTO USERS (NAME, EMAIL, PASSWORD,date_of_birth) VALUES
('gagann', 'gags@gmail.com', 'gags123','2005-5-11'),
('gauri_s', 'gaur@gmail.com', 'gaur123','2004-11-08'),
('disha_p', 'dija@gmail.com', 'dish123','2005-01-27');

INSERT INTO languages (language_id, name) VALUES
(1, 'Hindi'),
(2, 'English'),
(3, 'Kannada'),
(4, 'Telugu'),
(5, 'Japanese');

INSERT INTO genres (genre_id, name) VALUES
(1, 'Action/Thriller'),
(2, 'Drama/Comedy'),
(3, 'Romance'),
(4, 'Fantasy'),
(5, 'Anime');

INSERT INTO movies (title, release_year, description, language_id) VALUES
('Shershaah', 2021, 'War biopic of Captain Vikram Batra.', 1),
('John Wick', 2014, 'Hitman takes revenge for his dog.', 2),
('K.G.F: Chapter 1', 2018, 'Rise of Rocky in Kolar gold fields.', 3),
('Saaho', 2019, 'Undercover police and a criminal syndicate.', 4),
('Battle Royale', 2000, 'Deadly survival game among students.', 5),
('War', 2019, 'Spy vs Spy thriller.', 1),
('Skyfall', 2012, 'James Bond fights against cyberterrorism.', 2),
('James', 2022, 'Action-packed crime drama.', 3),
('PSV Garuda Vega', 2017, 'Secret agent solves a conspiracy.', 4),
('Detective Conan: Zero the Enforcer', 2018, 'High-stakes investigation in Tokyo.', 5);

INSERT INTO movies (title, release_year, description, language_id) VALUES
('3 Idiots', 2009, 'Comedy-drama about engineering students.', 1),
('Forrest Gump', 1994, 'Life story of a simple man.', 2),
('Kirik Party', 2016, 'College life and friendship.', 3),
('F2: Fun and Frustration', 2019, 'Comedy of married men.', 4),
('Your Lie in April', 2016, 'Music and young emotions.', 5),
('Chhichhore', 2019, 'College friends reunite.', 1),
('The Pursuit of Happyness', 2006, 'Struggle of a single father.', 2),
('777 Charlie', 2022, 'A man’s life changes with a dog.', 3),
('Jathi Ratnalu', 2021, 'Comical journey of 3 foolish friends.', 4),
('Barakamon', 2014, 'Calligrapher finds meaning in life.', 5);

INSERT INTO movies (title, release_year, description, language_id) VALUES
('Dilwale Dulhania Le Jayenge', 1995, 'Epic Hindi love story.', 1),
('The Notebook', 2004, 'Timeless love story.', 2),
('Love Mocktail', 2020, 'A simple love journey.', 3),
('Geetha Govindam', 2018, 'A sweet romantic tale.', 4),
('Your Name', 2016, 'Two strangers mysteriously connect.', 5),
('Tamasha', 2015, 'Finding oneself through love.', 1),
('La La Land', 2016, 'Dreams and love collide.', 2),
('Dia', 2020, 'Silent heartbreak and healing.', 3),
('Majili', 2019, 'Love story of a cricketer.', 4),
('Weathering with You', 2019, 'Weather girl and runaway boy.', 5);

INSERT INTO movies (title, release_year, description, language_id) VALUES
('Baahubali: The Beginning', 2015, 'Epic fantasy kingdom drama.', 4),
('Harry Potter and the Sorcerer\'s Stone', 2001, 'Young wizard\'s first adventure.', 2),
('Kantara', 2022, 'Folklore based divine fantasy.', 3),
('Makdee', 2002, 'Spooky village fantasy.', 1),
('Spirited Away', 2001, 'Girl trapped in spirit world.', 5),
('Tumbbad', 2018, 'Mythological treasure hunt.', 1),
('The Lord of the Rings', 2001, 'Destroy the One Ring.', 2),
('Lucia', 2013, 'Psychological fantasy thriller.', 3),
('Eega', 2012, 'Man reincarnated as a fly.', 4),
('Howl\'s Moving Castle', 2004, 'Girl cursed to become old.', 5);

INSERT INTO movies (title, release_year, description, language_id) VALUES
('Naruto Shippuden: The Movie', 2007, 'Ninja battles fate.', 5),
('One Piece: Stampede', 2019, 'Pirate festival madness.', 5),
('Demon Slayer: Mugen Train', 2020, 'Battle demons aboard a train.', 5),
('My Neighbor Totoro', 1988, 'Magical forest spirits.', 5),
('Akira', 1988, 'Post-apocalyptic Tokyo saga.', 5),
('Ponyo', 2008, 'Fish girl\'s magical adventure.', 5),
('Jujutsu Kaisen 0', 2021, 'Fighting curses with magic.', 5),
('Attack on Titan: Chronicle', 2020, 'War against titans.', 5),
('Bleach: Fade to Black', 2008, 'Soul Reapers in danger.', 5),
('Dragon Ball Super: Broly', 2018, 'Saiyan warriors clash.', 5);

-- Action/Thriller
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1);

-- Drama/Comedy
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2);

-- Romance
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3);

-- Fantasy
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(31, 4),
(32, 4),
(33, 4),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4);

-- Anime
INSERT INTO movie_genres (movie_id, genre_id) VALUES
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(48, 5),
(49, 5),
(50, 5);

ALTER TABLE movies
ADD COLUMN IMAGE VARCHAR(255) NOT NULL;

UPDATE movies SET Image = 'movie_posters/img1.jpeg' WHERE movie_id = 1;
UPDATE movies SET Image = 'movie_posters/img2.jpeg' WHERE movie_id = 2;
UPDATE movies SET Image = 'movie_posters/img3.jpeg' WHERE movie_id = 3;
UPDATE movies SET Image = 'movie_posters/img4.jpeg' WHERE movie_id = 4;
UPDATE movies SET Image = 'movie_posters/img5.jpeg' WHERE movie_id = 5;
UPDATE movies SET Image = 'movie_posters/img6.jpeg' WHERE movie_id = 6;
UPDATE movies SET Image = 'movie_posters/img7.jpeg' WHERE movie_id = 7;
UPDATE movies SET Image = 'movie_posters/img8.jpeg' WHERE movie_id = 8;
UPDATE movies SET Image = 'movie_posters/img9.jpeg' WHERE movie_id = 9;
UPDATE movies SET Image = 'movie_posters/img10.jpeg' WHERE movie_id = 10;
UPDATE movies SET Image = 'movie_posters/img11.jpeg' WHERE movie_id = 11;
UPDATE movies SET Image = 'movie_posters/img12.jpeg' WHERE movie_id = 12;
UPDATE movies SET Image = 'movie_posters/img13.jpeg' WHERE movie_id = 13;
UPDATE movies SET Image = 'movie_posters/img14.jpeg' WHERE movie_id = 14;
UPDATE movies SET Image = 'movie_posters/img15.jpeg' WHERE movie_id = 15;
UPDATE movies SET Image = 'movie_posters/img16.jpeg' WHERE movie_id = 16;
UPDATE movies SET Image = 'movie_posters/img17.jpeg' WHERE movie_id = 17;
UPDATE movies SET Image = 'movie_posters/img18.jpeg' WHERE movie_id = 18;
UPDATE movies SET Image = 'movie_posters/img19.jpeg' WHERE movie_id = 19;
UPDATE movies SET Image = 'movie_posters/img20.jpeg' WHERE movie_id = 20;
UPDATE movies SET Image = 'movie_posters/img21.jpeg' WHERE movie_id = 21;
UPDATE movies SET Image = 'movie_posters/img22.jpeg' WHERE movie_id = 22;
UPDATE movies SET Image = 'movie_posters/img23.jpeg' WHERE movie_id = 23;
UPDATE movies SET Image = 'movie_posters/img24.jpeg' WHERE movie_id = 24;
UPDATE movies SET Image = 'movie_posters/img25.jpeg' WHERE movie_id = 25;
UPDATE movies SET Image = 'movie_posters/img26.jpeg' WHERE movie_id = 26;
UPDATE movies SET Image = 'movie_posters/img27.jpeg' WHERE movie_id = 27;
UPDATE movies SET Image = 'movie_posters/img28.jpeg' WHERE movie_id = 28;
UPDATE movies SET Image = 'movie_posters/img29.jpeg' WHERE movie_id = 29;
UPDATE movies SET Image = 'movie_posters/img30.jpeg' WHERE movie_id = 30;

select* from movies;

UPDATE movies SET Image = 'movie_posters/img31.jpeg' WHERE movie_id = 31;
UPDATE movies SET Image = 'movie_posters/img32.jpeg' WHERE movie_id = 32;
UPDATE movies SET Image = 'movie_posters/img33.jpeg' WHERE movie_id = 33;
UPDATE movies SET Image = 'movie_posters/img34.jpeg' WHERE movie_id = 34;
UPDATE movies SET Image = 'movie_posters/img35.jpeg' WHERE movie_id = 35;
UPDATE movies SET Image = 'movie_posters/img36.jpeg' WHERE movie_id = 36;
UPDATE movies SET Image = 'movie_posters/img37.jpeg' WHERE movie_id = 37;
UPDATE movies SET Image = 'movie_posters/img38.jpeg' WHERE movie_id = 38;
UPDATE movies SET Image = 'movie_posters/img39.jpeg' WHERE movie_id = 39;
UPDATE movies SET Image = 'movie_posters/img40.jpeg' WHERE movie_id = 40;
UPDATE movies SET Image = 'movie_posters/img41.jpeg' WHERE movie_id = 41;
UPDATE movies SET Image = 'movie_posters/img42.jpeg' WHERE movie_id = 42;
UPDATE movies SET Image = 'movie_posters/img43.jpeg' WHERE movie_id = 43;
UPDATE movies SET Image = 'movie_posters/img44.jpeg' WHERE movie_id = 44;
UPDATE movies SET Image = 'movie_posters/img45.jpeg' WHERE movie_id = 45;
UPDATE movies SET Image = 'movie_posters/img46.jpeg' WHERE movie_id = 46;
UPDATE movies SET Image = 'movie_posters/img47.jpeg' WHERE movie_id = 47;
UPDATE movies SET Image = 'movie_posters/img48.jpeg' WHERE movie_id = 48;
UPDATE movies SET Image = 'movie_posters/img49.jpeg' WHERE movie_id = 49;
UPDATE movies SET Image = 'movie_posters/img50.jpeg' WHERE movie_id = 50;

select* from movies;

DROP TABLE ratings;
ALTER TABLE movies ADD COLUMN ratings FLOAT DEFAULT 0;
UPDATE movies SET ratings = 4.7 WHERE movie_id = 1;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 2;
UPDATE movies SET ratings = 4.4 WHERE movie_id = 3;
UPDATE movies SET ratings = 3.8 WHERE movie_id = 4;
UPDATE movies SET ratings = 4.1 WHERE movie_id = 5;
UPDATE movies SET ratings = 4.2 WHERE movie_id = 6;
UPDATE movies SET ratings = 4.5 WHERE movie_id = 7;
UPDATE movies SET ratings = 3.9 WHERE movie_id = 8;
UPDATE movies SET ratings = 4.0 WHERE movie_id = 9;
UPDATE movies SET ratings = 4.3 WHERE movie_id = 10;

UPDATE movies SET ratings = 4.8 WHERE movie_id = 11;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 12;
UPDATE movies SET ratings = 4.2 WHERE movie_id = 13;
UPDATE movies SET ratings = 3.7 WHERE movie_id = 14;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 15;
UPDATE movies SET ratings = 4.5 WHERE movie_id = 16;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 17;
UPDATE movies SET ratings = 4.4 WHERE movie_id = 18;
UPDATE movies SET ratings = 4.0 WHERE movie_id = 19;
UPDATE movies SET ratings = 4.7 WHERE movie_id = 20;

UPDATE movies SET ratings = 4.9 WHERE movie_id = 21;
UPDATE movies SET ratings = 4.5 WHERE movie_id = 22;
UPDATE movies SET ratings = 4.3 WHERE movie_id = 23;
UPDATE movies SET ratings = 4.2 WHERE movie_id = 24;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 25;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 26;
UPDATE movies SET ratings = 4.7 WHERE movie_id = 27;
UPDATE movies SET ratings = 4.4 WHERE movie_id = 28;
UPDATE movies SET ratings = 4.3 WHERE movie_id = 29;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 30;

UPDATE movies SET ratings = 4.7 WHERE movie_id = 31;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 32;
UPDATE movies SET ratings = 4.5 WHERE movie_id = 33;
UPDATE movies SET ratings = 4.0 WHERE movie_id = 34;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 35;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 36;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 37;
UPDATE movies SET ratings = 4.3 WHERE movie_id = 38;
UPDATE movies SET ratings = 4.2 WHERE movie_id = 39;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 40;

UPDATE movies SET ratings = 4.6 WHERE movie_id = 41;
UPDATE movies SET ratings = 4.7 WHERE movie_id = 42;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 43;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 44;
UPDATE movies SET ratings = 4.7 WHERE movie_id = 45;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 46;
UPDATE movies SET ratings = 4.9 WHERE movie_id = 47;
UPDATE movies SET ratings = 4.8 WHERE movie_id = 48;
UPDATE movies SET ratings = 4.5 WHERE movie_id = 49;
UPDATE movies SET ratings = 4.6 WHERE movie_id = 50;

select* from movies;


ALTER TABLE movies
ADD COLUMN USER_ID INT,
ADD CONSTRAINT FK_USER_ID FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE movies
DROP FOREIGN KEY FK_USER_ID;
ALTER TABLE movies
DROP COLUMN user_id;

CREATE TABLE IF NOT EXISTS user_movies (
    user_id INT,
    movie_id INT,
    PRIMARY KEY (user_id, movie_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
);
select * from user_movies;


