-- Active: 1725772480758@@127.0.0.1@3306

-- CREATE DATABASE TheBookClubDB DEFAULT CHARACTER SET = 'utf8mb4';

CREATE DATABASE IF NOT EXISTS TheBookClubDB DEFAULT CHARACTER SET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

DROP DATABASE IF EXISTS TheBookClubDB;

USE TheBookClubDB;

CREATE TABLE IF NOT EXISTS user (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    auth_key VARCHAR(100) NOT NULL,
    access_token VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS books (
    book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT UNSIGNED NOT NULL,
    genre_id INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    cover_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES authors (author_id),
    FOREIGN KEY (genre_id) REFERENCES genres (genre_id)
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS authors (
    author_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author_name VARCHAR(100) NOT NULL,
    nationality VARCHAR(100) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS genres (
    genre_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(100) NOT NULL
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS clubs (
    club_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    club_name VARCHAR(100) NOT NULL,
    club_description TEXT NOT NULL,
    club_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS club_members (
    club_member_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    club_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (club_id) REFERENCES clubs (club_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    UNIQUE KEY non_duplicate_user (club_id, user_id)
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS user_books (
    user_book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books (book_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    UNIQUE KEY non_duplicate_user_book (book_id, user_id)
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS borrowed_books (
    borrowed_book_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    borrowed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    returned_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    score TINYINT UNSIGNED,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books (book_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    UNIQUE KEY non_duplicate_user_book (book_id, user_id)
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

CREATE TABLE IF NOT EXISTS book_scores (
    book_score_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    score TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books (book_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id),
    UNIQUE KEY non_duplicate_user_book (book_id, user_id)
) ENGINE = INNODB DEFAULT CHARSET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_ci';

SELECT * FROM books;

-- Desactivar restricciones de claves foráneas
SET FOREIGN_KEY_CHECKS = 0;

-- Truncar la tabla
TRUNCATE TABLE books;

TRUNCATE TABLE authors;

TRUNCATE TABLE book_scores;

-- Activar restricciones de claves foráneas
SET FOREIGN_KEY_CHECKS = 1;

SELECT * FROM authors WHERE author_id = 45;

-- insert one author demo
INSERT INTO
    authors (author_name, nationality)
VALUES (
        'Demo Author',
        'Demo National'
    );

SELECT * FROM books LIMIT 1000;

-- INNER JOIN para obtener el nombre del autor y libro
SELECT books.title, authors.author_name
FROM books
    INNER JOIN authors ON books.author_id = authors.author_id
WHERE
    authors.author_id = 9;

-- insert one genre demo
INSERT INTO genres (genre_name) VALUES ('Demo Genre');

DESCRIBE books;

SELECT * FROM books;

-- inner join para obtener que usuario tiene un libro
SELECT books.title, user.username
FROM books
    INNER JOIN user_books ON books.book_id = user_books.book_id
    INNER JOIN user ON user_books.user_id = user.user_id
WHERE
    user_books.book_id = 16;