<?php

/**
 * @param string $string Строка SMS подтверждения (кодировка ).
 * @param bool $guess Нужно ли пытаться распознать часть сообщения
 * если она не подходит ни под один из предопределенных форматов.
 * @return array
 */
function parseYandexSMS($string, $guess = true, $encoding = 'UTF-8')
{
    $result = ['password' => null, 'charged' => null, 'account' => null];

    $string = trim($string);

    $clauseDelimiter = '[\r\n]+';   // Разделитель строк.

    // TODO: проверить при других кодировках строки
    $patterns['password'] = '/(?=.*\bПароль\b)(?=.*?(\b\d+\b))/ui';
    $patterns['charged'] = '/(?=.*\bСпишется\b)(?=.*?(\b\d+[\.\,]?\d{0,2})\s*([\w$]+)*)/ui';
    $patterns['account'] = '/(?=.*\bСч[её]т\b)(?=.*?(\b\d+\b))/ui';

    $parts = preg_split('/' . $clauseDelimiter . '/', $string);
    foreach ($parts as $clause)
    {
        $clause = trim($clause);
        if ($res = preg_match($patterns['password'], $clause, $matches))
        {
            $result['password'] = ;
        }
        else
        {

        }
    }

    return $result;
}
?>
<input type="">
