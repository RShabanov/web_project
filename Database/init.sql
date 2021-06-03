CREATE TABLE IF NOT EXISTS `task_types` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);


CREATE TABLE IF NOT EXISTS `task_statuses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);


CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`name`)
);


CREATE TABLE IF NOT EXISTS `tasks` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `type_id` INT UNSIGNED NOT NULL,
    `location` VARCHAR(255),
    `time` TIMESTAMP NOT NULL,
    `duration` TIME NOT NULL DEFAULT '10000',
    `comment` TEXT,
    `status_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `deleted` BOOLEAN DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`type_id`) REFERENCES `task_types` (`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);


INSERT `task_types` (`id`, `name`) VALUES
(1, 'Meeting'),
(2, 'Call'),
(3, 'Conference'),
(4, 'Business');


INSERT `task_statuses` (`id`, `name`) VALUES
(1, 'Current'),
(2, 'Completed'),
(3, 'Cancelled');