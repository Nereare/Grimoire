CREATE FUNCTION GET_EXERPT(str MEDIUMTEXT) #, delim VARCHAR(12), pos INT)
RETURNS MEDIUMTEXT
RETURN REPLACE(
  SUBSTRING(
    SUBSTRING_INDEX(str, '<!-- Read More -->', 1),
    CHAR_LENGTH(
        SUBSTRING_INDEX(str, '<!-- Read More -->', 0)
    ) + 1),
  '<!-- Read More -->',
  '');
