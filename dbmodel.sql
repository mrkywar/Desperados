
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- Desperados implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

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
  `member_difficulty` int(2) NOT NULL, 
  `member_category` varchar(50) NOT NULL, 
  `member_position` int(2) NOT NULL, 
  `member_allocation` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `turn` (
    `turn_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `turn_player_id` int(10) UNSIGNED NOT NULL,
    `turn_number` int(5) UNSIGNED NOT NULL,
    `turn_roll_count` int(1) UNSIGNED NOT NULL,
    `turn_dice_1_face` int(10) UNSIGNED NOT NULL,
    `turn_dice_2_face` int(10) UNSIGNED NOT NULL,
    `turn_dice_3_face` int(10) UNSIGNED NOT NULL,
    `turn_dice_4_face` int(10) UNSIGNED NOT NULL,
    PRIMARY KEY (`turn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
