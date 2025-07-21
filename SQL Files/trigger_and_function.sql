DELIMITER $$

CREATE TRIGGER techlog_id_insertion
BEFORE insert ON service_logs
FOR EACH ROW
BEGIN
	  set @auto_id := ( SELECT AUTO_INCREMENT 
                    FROM INFORMATION_SCHEMA.TABLES
                    WHERE TABLE_NAME='service_logs'
                      AND TABLE_SCHEMA='tl_test4' ); 

    IF (NEW.techlog_id = 'N/A') THEN
        SET NEW.techlog_id = techlogIdGenerate(@auto_id);
    END IF;
END$$
DELIMITER ;


DELIMITER //

CREATE FUNCTION techlogIdGenerate (input INT)
RETURNS VARCHAR(250)
BEGIN
    DECLARE NumStr VARCHAR(250);
    DECLARE MonStr VARCHAR(250);
    DECLARE YearStr VARCHAR(250);
    DECLARE pad INT DEFAULT 6;
    DECLARE MonthPad INT DEFAULT 2;

    SET NumStr = CAST(input AS CHAR);  -- Convert input to string
    SET MonStr = LPAD(MONTH(NOW()), MonthPad, '0');  -- Pad month with zeros
    SET YearStr = SUBSTRING(YEAR(NOW()), 3, 2);  -- Get last two digits of the year

    IF (LENGTH(NumStr) < pad) THEN
        SET NumStr = CONCAT('TL', YearStr, MonStr, LPAD(NumStr, pad, '0'));
    ELSE
        SET NumStr = CONCAT('TL', YearStr, MonStr, NumStr);
    END IF;

    RETURN NumStr;
END //

DELIMITER ;


-- DELIMITER $$

-- CREATE TRIGGER status_updatelog_insert
-- AFTER UPDATE ON service_logs
-- FOR EACH ROW
-- BEGIN
-- 	IF (OLD.status_id != NEW.status_id and OLD.techlog_id = NEW.techlog_id) THEN 
-- 		INSERT INTO status_updatelog(service_logs_id, status_id, teknisi_id)
-- 		VALUES (NEW.techlog_id, NEW.status_id, NEW.teknisi_id);
-- 	END IF;
-- END$$

-- DELIMITER ;;
-- Dibuat di Insert Laravel

-- select CAST(@NumStr := month(NOW()) AS char) AS 'm', SUBSTRING(@NumStr := year(NOW()),3,2) AS 'y';




















-- DELIMITER $$
-- CREATE FUNCTION techlogIdGenerate (input INT)
-- RETURNS VARCHAR(250)
-- AS BEGIN
--     DECLARE @NumStr VARCHAR(250)
--     DECLARE @MonStr VARCHAR(250)
-- 	DECLARE @YearStr VARCHAR(250)
--     DECLARE @pad int
-- 	DECLARE @MonthPad int

--     SET @pad = 6
-- 	SET @MonthPad = 2
--     SET @NumStr = LTRIM(@input)
--     
--     @MONStr = month(NOW())
--     @YearStr = SUBSTRING(year(NOW()),3,2)
--     
-- 	IF(@MonthPad > LEN(@MonStr))
-- 		SET @MonStr = REPLICATE('0', 2 - LEN(@MonStr)) + @MonStr;

--     IF(@pad > LEN(@NumStr))
--         SET @NumStr = 'TL' + @YearStr + @MonStr + REPLICATE('0', @pad - LEN(@NumStr)) + @NumStr;
-- 	ELSE
-- 		SET @NumStr = 'TL' + @YearStr + @MonStr + @NumStr;

--     RETURN @NumStr;
-- END
-- DELIMITER ;;

-- DELIMITER $$

-- CREATE FUNCTION techlogIdGenerate (input INT)
-- RETURNS VARCHAR(250)
-- BEGIN
--     DECLARE NumStr VARCHAR(250);
--     DECLARE MonStr VARCHAR(250);
--     DECLARE YearStr VARCHAR(250);
--     DECLARE pad INT;
--     DECLARE MonthPad INT;

--     SET pad = 6;
--     SET MonthPad = 2;
--     SET NumStr = CAST(input AS CHAR);  -- Convert input to string

--     SET MonStr = LPAD(MONTH(NOW()), MonthPad, '0');  -- Pad month with zeros
--     SET YearStr = SUBSTRING(YEAR(NOW()), 3, 2);  -- Get last two digits of the year

--     IF (pad > LENGTH(NumStr)) THEN
--         SET NumStr = CONCAT('TL', YearStr, MonStr, LPAD(NumStr, pad, '0'));
--     ELSE
--         SET NumStr = CONCAT('TL', YearStr, MonStr, NumStr);
--     END IF;

--     RETURN NumStr;
-- END

-- DELIMITER ;;


-- select CAST(@NumStr := month('2023-12-31') AS char) AS 'm', SUBSTRING(@NumStr := year('2023-12-31'),1,2) AS 'y';

-- Sample output

-- SELECT [dbo].[fnNumPadLeft] (2016,10) -- returns 0000002016
-- SELECT [dbo].[fnNumPadLeft] (2016,5) -- returns 02016
-- SELECT [dbo].[fnNumPadLeft] (2016,2) -- returns 2016
-- SELECT [dbo].[fnNumPadLeft] (2016,0) -- returns 2016 


-- DELIMITER $$
-- CREATE FUNCTION dbo.fnNumPadLeft (@input INT, @pad tinyint)
-- RETURNS VARCHAR(250)
-- AS BEGIN
--     DECLARE @NumStr VARCHAR(250)

--     SET @NumStr = LTRIM(@input)

--     IF(@pad > LEN(@NumStr))
--         SET @NumStr = REPLICATE('0', @Pad - LEN(@NumStr)) + @NumStr;

--     RETURN @NumStr;
-- END
-- DELIMITER ;;