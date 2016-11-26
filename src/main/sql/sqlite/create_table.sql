CREATE TABLE `users` ( `user_id` TEXT NOT NULL, `name` TEXT NOT NULL, `password` TEXT NOT NULL, `json` BLOB NOT NULL, PRIMARY KEY(`user_id`) );

CREATE TABLE "weekly_reports" ( `year` INTEGER NOT NULL, `week` INTEGER NOT NULL, `user_id` TEXT NOT NULL, PRIMARY KEY(`year`,`week`,`user_id`) );

CREATE TABLE "weekly_report_items" ( `year` INTEGER NOT NULL, `week` INTEGER NOT NULL, `user_id` TEXT NOT NULL, `item_name` TEXT NOT NULL, `content` BLOB NOT NULL, PRIMARY KEY(`year`,`week`,`user_id`,`item_name`) );
