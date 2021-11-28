DELIMITER $$

CREATE PROCEDURE RecTreeIds(
   IN parentIds TEXT
)

BEGIN

   DECLARE childIds TEXT DEFAULT '' ;

   SELECT idParamTypeCat   FROM paramTypeCat   WHERE idParamTypeCatPar IN (parentIds) INTO childIds;   
--    SELECT quantity   FROM test   WHERE id = number INTO tmptotal;     

   IF NOT childIds IS NULL  THEN
    CALL calctotal(childIds, parentIds);
   END IF;
    select idParamTypeCat from parentIds
    union select idParamTypeCat from childIds;   
END
$$

DELIMITER ;