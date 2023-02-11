
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- Desperados implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):

-- CREATE TABLE IF NOT EXISTS `card` (
--   `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
--   `card_type` varchar(16) NOT NULL,
--   `card_type_arg` int(11) NOT NULL,
--   `card_location` varchar(16) NOT NULL,
--   `card_location_arg` int(11) NOT NULL,
--   PRIMARY KEY (`card_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `log` (
    `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `log_date` varchar(50) NOT NULL,
    `log_category` varchar(50) NOT NULL,
    `log_content` text NOT NULL,
    PRIMARY KEY(`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Example 2: add a custom field to the standard "player" table

CREATE TABLE IF NOT EXISTS `gangmember` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_familly` varchar(50) NOT NULL,
  --`member_name` varchar(50) NOT NULL,
  `member_difficulty` int(2) NOT NULL, 
  `member_category` varchar(50) NOT NULL, 
  `member_position` int(2) NOT NULL, 
  `member_allocation` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `dice` (
    `dice_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `dice_position` varchar(50),
    `dice_position_arg` varchar(50),
    `dice_actual_face` int(2) UNSIGNED NOT NULL,
    PRIMARY KEY (`dice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `turn` (
    `turn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `turn_player_id` int(10) UNSIGNED NOT NULL,
    `turn_number` int(5) UNSIGNED NOT NULL,
    `turn_roll_count` int(1) UNSIGNED NOT NULL,
    `turn_dice_1_id` int(10) UNSIGNED NOT NULL,
    `turn_dice_2_id` int(10) UNSIGNED NOT NULL,
    `turn_dice_3_id` int(10) UNSIGNED NOT NULL,
    `turn_dice_4_id` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`turn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
