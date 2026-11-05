CREATE TABLE IF NOT EXISTS `reports`
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `name`       VARCHAR(100) NOT NULL,
    `width`      INT NOT NULL DEFAULT 800,
    `height`     INT NOT NULL DEFAULT 600,
    `visibility` VARCHAR(10) NOT NULL DEFAULT 'private'
);

INSERT INTO `reports` (`name`, `width`, `height`, `visibility`)
VALUES ('Počasie v Žiline', 800, 600, 'public'),
       ('Teplota a vlhkosť', 1024, 768, 'public'),
       ('Môj súkromný report', 640, 480, 'private');
