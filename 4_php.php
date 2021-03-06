<?php
/*
Задание 4 PHP

По адресу
https://gist.github.com/vldmr-k/530f49fa94e3684ae3ff1956b3c6f9e5
можно получить CSV файл со списком президентов.
Нужно вывести год, в котором было живо наИбольшее количество президентов.
*/

/* если нет такой функции, создадим ее */
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}

/* перенесем цсв файл в массив */
$csv = array();
$lines = file('presidents.csv', FILE_IGNORE_NEW_LINES);
unset($lines[0]);
foreach ($lines as $key => $value) {
    $csv[$key] = str_getcsv($value);
}


/* т.к. могут быть еще живые президенты, то максимальный год смерти ставим в текущий год */
$maxYear = date('Y');
/* найдем минимальный год когда был рожден какой либо президент */
$minYear = date('Y');
foreach ($csv as $v) {
    $birth = intval($v[2]);
    if ($birth < $minYear) {
        $minYear = $birth;
    }
}


/* основные вычисления */
$YearsData = [];
foreach ($csv as $v) {
    for ($i=$minYear; $i<$maxYear; $i++) {
        $birth = intval($v[2]);
        $death = intval($v[4]);
        if (!$death) { $death = $maxYear; }

        if ($birth <= $i && $death >= $i) {
            if (!isset($YearsData[$i])) {
                $YearsData[$i] = 1;
            } else {
                $YearsData[$i]++;
            }
        }
    }
}

/* отсортируем результат по возрастанию и вернем первый ключ массива который является годом с максимальным количеством живых президентов */
arsort($YearsData);
$firstKey = array_key_first($YearsData);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Задание 4 PHP</title>
</head>
<body>

<?= "год, в котором было живо наИбольшее количество президентов: {$firstKey}" ?>

</body>
</html>