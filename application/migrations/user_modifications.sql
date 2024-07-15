ALTER TABLE `users` ADD `linkedin_id` TEXT NOT NULL AFTER `oauth_uid`;
ALTER TABLE `users` ADD `gender` VARCHAR(10) NOT NULL AFTER `linkedin_id`;
ALTER TABLE `users` ADD `age` INT(11) NOT NULL AFTER `gender`;

ALTER TABLE `tags` ADD `title` TEXT NOT NULL AFTER `slug`, ADD `description` TEXT NOT NULL AFTER `title`;