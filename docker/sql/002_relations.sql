CREATE TABLE IF NOT EXISTS `users`
(
    `id`       INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `role`     VARCHAR(20) NOT NULL DEFAULT 'user'
)

CREATE TABLE IF NOT EXISTS `locations`
(
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `name`      VARCHAR(100) NOT NULL,
    `latitude`  DOUBLE NOT NULL DEFAULT 0,
    `longitude` DOUBLE NOT NULL DEFAULT 0
)

-- M:N User <-> Location
CREATE TABLE IF NOT EXISTS `user_locations`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`     INT NOT NULL,
    `location_id` INT NOT NULL,
    UNIQUE KEY `uq_user_location` (`user_id`, `location_id`),
    CONSTRAINT `fk_ul_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_ul_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE
)

-- 1:N Location -> Sensor
CREATE TABLE IF NOT EXISTS `sensors`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `location_id` INT NOT NULL,
    `metric`      VARCHAR(50) NOT NULL,
    `unit`        VARCHAR(20) NOT NULL,
    CONSTRAINT `fk_sensor_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE
)

-- 1:N Sensor -> SensorData
CREATE TABLE IF NOT EXISTS `sensor_data`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY,
    `sensor_id`   INT NOT NULL,
    `value`       DOUBLE NOT NULL,
    `measured_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_data_sensor` FOREIGN KEY (`sensor_id`) REFERENCES `sensors` (`id`) ON DELETE CASCADE
)

-- 1:N User -> Report
ALTER TABLE `reports`
    ADD COLUMN `user_id` INT NULL,
    ADD CONSTRAINT `fk_report_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

INSERT INTO `users` (`username`, `role`)
VALUES ('dávid', 'admin'),
       ('jana', 'user'),
       ('peter', 'user');

INSERT INTO `locations` (`name`, `latitude`, `longitude`)
VALUES ('Žilina', 49.2231, 18.7394),
       ('Bratislava', 48.1486, 17.1077),
       ('Košice', 48.7164, 21.2611);

INSERT INTO `user_locations` (`user_id`, `location_id`)
VALUES (1, 1), (1, 2), (2, 1), (3, 3);

INSERT INTO `sensors` (`location_id`, `metric`, `unit`)
VALUES (1, 'Teplota', '°C'),
       (1, 'Vlhkosť', '%'),
       (1, 'Rýchlosť vetra', 'km/h'),
       (2, 'Teplota', '°C'),
       (3, 'Teplota', '°C');

INSERT INTO `sensor_data` (`sensor_id`, `value`, `measured_at`)
VALUES (1, 12.5, '2026-11-11 08:00:00'),
       (1, 14.1, '2026-11-11 12:00:00'),
       (2, 78, '2026-11-11 08:00:00'),
       (3, 11.2, '2026-11-11 08:00:00'),
       (4, 15.3, '2026-11-11 08:00:00'),
       (5, 13.0, '2026-11-11 08:00:00');

UPDATE `reports` SET `user_id` = 1 WHERE `id` IN (1, 3);
UPDATE `reports` SET `user_id` = 2 WHERE `id` = 2;
