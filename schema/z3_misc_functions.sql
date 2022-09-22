CREATE FUNCTION GET_EXERPT(str MEDIUMTEXT)
RETURNS MEDIUMTEXT
RETURN REPLACE(
  SUBSTRING(
    SUBSTRING_INDEX(str, '<!-- Read More -->', 1),
    CHAR_LENGTH(
        SUBSTRING_INDEX(str, '<!-- Read More -->', 0)
    ) + 1),
  '<!-- Read More -->',
  '');

CREATE FUNCTION GET_CR_AS_TEXT(cr DECIMAL(5,3))
RETURNS VARCHAR(8)
RETURN CASE
  WHEN cr LIKE 0.0 THEN "0"
  WHEN cr LIKE 0.125 THEN "&frac18;"
  WHEN cr LIKE 0.25 THEN "&frac14;"
  WHEN cr LIKE 0.5 THEN "&frac12;"
  ELSE ROUND(cr, 0)
END;
