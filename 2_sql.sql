SELECT * FROM Users WHERE login IN (
  SELECT
    login
  FROM Users
  GROUP BY login
  HAVING count(*)>1
)


