/*
the following sql code wants to retrieve the Functional Form of a RDBMS from the Tables metadata
It is specific for MySql MariaDb InnoDb and compatible dbms.
After the generation of the dadbv01Struct.csv file, it is possible to reverse other informations
useful for code generalization next step:
- foreign key links -> automatic UI Fields list building (ex. finding the descriptive fields for Ids: conventionally 'nam', if it exists)
- UI fields list and type -> panel self building and UI component choise
- Conventions Manager: it exposes methods 
  - to build names for every system item 
  - to spread conventions all over the system: seperators, paths, prefix, postfix, (see tha Session data)


*/


-- Mariadb schema extraction
-- from information_schema.columns table
/*
******************************************
*** mariadb innodb schema of the information_schema. columns table
select
TABLE_CATALOG	
TABLE_SCHEMA	
TABLE_NAME	
COLUMN_NAME	
ORDINAL_POSITION	
COLUMN_DEFAULT	
IS_NULLABLE	
DATA_TYPE	
CHARACTER_MAXIMUM_LENGTH	
CHARACTER_OCTET_LENGTH	
NUMERIC_PRECISION	
NUMERIC_SCALE	
DATETIME_PRECISION	
CHARACTER_SET_NAME	
COLLATION_NAME	
COLUMN_TYPE	
COLUMN_KEY	
EXTRA	
PRIVILEGES	
COLUMN_COMMENT	
IS_GENERATED	
GENERATION_EXPRESSION	
from information_schema.columns IHtmlJsComponent
where
*/
-- catalogues into the server
SELECT c.TABLE_CATALOG FROM COLUMNS c 
group by c.TABLE_CATALOG
order by c.TABLE_CATALOG

-- Db sources into the server
SELECT c.TABLE_SCHEMA FROM COLUMNS c 
group by c.TABLE_SCHEMA
order by c.TABLE_SCHEMA

SELECT GROUP_CONCAT(DISTINCT c.TABLE_SCHEMA) 
FROM  COLUMNS c 

-- tables into a db source
SELECT c.TABLE_NAME FROM COLUMNS c 
where c.TABLE_SCHEMA = 'dadbv01'
group by c.TABLE_NAME
order by c.TABLE_NAME

SELECT GROUP_CONCAT(DISTINCT c.TABLE_NAME) as TableNams
FROM  COLUMNS c 
where c.TABLE_SCHEMA = 'dadbv01'

-- columns in a table 
SELECT c.COLUMN_NAME FROM COLUMNS c 
where c.TABLE_SCHEMA = 'dadbv01'
and c.TABLE_NAME='alg'
group by c.COLUMN_NAME
order by c.ORDINAL_POSITION;

SELECT GROUP_CONCAT(DISTINCT c.COLUMN_NAME) as CSColumnList
FROM  COLUMNS c 
where c.TABLE_SCHEMA = 'dadbv01'
and c.TABLE_NAME='alg'

-- columns in a table with attributes
SELECT 
  c.COLUMN_NAME,
  c.COLUMN_KEY,
  c.COLUMN_TYPE,
  c.DATA_TYPE
 FROM COLUMNS c 
where c.TABLE_SCHEMA = 'dadbv01'
and c.TABLE_NAME='alg'
group by c.COLUMN_NAME
order by c.ORDINAL_POSITION;

-- table functional form
SELECT GROUP_CONCAT(DISTINCT c.COLUMN_NAME) as CSColumnList

SELECT c.TABLE_NAME ,
    GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSColumnList
    FROM COLUMNS c 
  where c.TABLE_SCHEMA = 'dadbv01'
  group by c.TABLE_NAME
  order by c.TABLE_NAME
INTO OUTFILE '/xampp/htdocs/DAB/V01/SqlCode/dadbv01Struct.csv'
FIELDS TERMINATED BY ';'

select CONCAT(cc.TABLE_NAME,"(",cc.CSColumnList,")") as FEFuncForm
from (
SELECT c.TABLE_NAME ,
    GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSColumnList
    FROM COLUMNS c 
  where c.TABLE_SCHEMA = 'dadbv01'
  group by c.TABLE_NAME
  order by c.TABLE_NAME
) cc
INTO OUTFILE '/xampp/htdocs/DAB/V01/SqlCode/dadbv01FuncForm.txt'
FIELDS TERMINATED BY ';'

SELECT CONCAT(
    '[', 
    GROUP_CONCAT(JSON_OBJECT(cc.TABLE_NAME, cc.CSColumnList)),
    ']'
) 
INTO OUTFILE '/xampp/htdocs/DAB/V01/SqlCode/dadbv01Struct.json'
FROM (
SELECT c.TABLE_NAME ,
    GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSColumnList
    FROM COLUMNS c 
  where c.TABLE_SCHEMA = 'dadbv01'
  group by c.TABLE_NAME
  order by c.TABLE_NAME
) cc

SELECT CONCAT('{"',GROUP_CONCAT(CONCAT(cc.TABLE_NAME,'":"',cc.CSColumnList,'"')),'}')
SELECT JSON_OBJECT(GROUP_CONCAT(CONCAT(cc.TABLE_NAME,'":"',cc.CSColumnList,'"')))
INTO OUTFILE '/xampp/htdocs/DAB/V01/SqlCode/dadbv01Struct.json'
FROM (
SELECT c.TABLE_NAME ,
    GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSColumnList
    FROM COLUMNS c 
  where c.TABLE_SCHEMA = 'dadbv01'
  group by c.TABLE_NAME
  order by c.TABLE_NAME
) cc

// ver 10 MariaDB
SELECT JSON_ARRAYAGG(TABLE_NAME, CSColumnList)) 
INTO OUTFILE '/xampp/htdocs/DAB/V01/SqlCode/dadbv01Struct.json'
from (
SELECT c.TABLE_NAME ,
    GROUP_CONCAT(DISTINCT c.COLUMN_NAME ORDER BY c.ORDINAL_POSITION) as CSColumnList
    FROM COLUMNS c 
  where c.TABLE_SCHEMA = 'dadbv01'
  group by c.TABLE_NAME
  order by c.TABLE_NAME
) cc
