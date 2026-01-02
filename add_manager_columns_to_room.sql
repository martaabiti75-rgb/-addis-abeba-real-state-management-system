-- Add manager columns to room table
ALTER TABLE `real_state_db`.`room` 
ADD COLUMN `ManagerEmail` VARCHAR(255) NULL DEFAULT NULL AFTER `Block_Url`,
ADD COLUMN `ManagerName` VARCHAR(255) NULL DEFAULT NULL AFTER `ManagerEmail`,
ADD COLUMN `ManagerPhone` VARCHAR(20) NULL DEFAULT NULL AFTER `ManagerName`;

-- Add index for better performance
ALTER TABLE `real_state_db`.`room` 
ADD INDEX `idx_manager_email` (`ManagerEmail`);