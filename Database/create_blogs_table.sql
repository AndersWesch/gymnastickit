CREATE TABLE IF NOT EXISTS blogs (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    thumb_text TEXT NOT NULL,
    photo_path VARCHAR(255),
    publish_at DATETIME NOT NULL,
    created_at TIMESTAMP
);