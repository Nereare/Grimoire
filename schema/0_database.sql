CREATE DATABASE IF NOT EXISTS `grimoire`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;
CREATE USER IF NOT EXISTS
  'grimoire'@'localhost'
  IDENTIFIED BY 'grimoire'
  FAILED_LOGIN_ATTEMPTS 3
  PASSWORD_LOCK_TIME 7;
GRANT ALL ON `grimoire`.* TO 'grimoire'@'localhost';

USE `grimoire`;
