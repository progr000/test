/*
Задание 2 SQL

Написать запрос, результатом которого будет выборка из таблицы Users,
записи в которой повторяются более одного раза (по полю login), отсортировать в любом порядке.
*/

SELECT * FROM Users WHERE login IN (
  SELECT
    login
  FROM Users
  GROUP BY login
  HAVING count(*)>1
)


