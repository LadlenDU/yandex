<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'function.php';

$s = 'Пароль: 7054
Спишется 458,3р.
Перевод на счет 410014456520804';


#$ret = parseYandexSMS($s);

#print_r($ret);


#$text = "Строка 1\r\r\n\nСтрока 2\rСтрока 3\nСтрока 4\nСтрока 5";
#$t = preg_split('/[\r\n]+/', $text);
#$t = preg_split('/(\r\n)+/', $text);

$text = "str1UKUUUstr2KKstr3Ustr4";
$s = 'ff charged 458,3rub.';
$s = 'james and jack';
#$t = preg_match('/^(?=.*\bcharged\b.*)(\d+[.,]?\d{0,2})$/iuU', $s, $matches);
#$t = preg_match('/^(?=.*\bcharged\b.*)(\d+[.,]?\d{0,2})$/', $s, $matches);
$t = preg_match('/^(?=.*\bjack\b)(?=.*\b(james)\b).*$/', $s, $matches);


print_r($matches);

#'(?(?=\bcharged\b)(\d+)|иначе)'
