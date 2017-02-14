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
    $patterns['password'] = '/^Пароль[:]?\s*(\d+)$/iu';
    $patterns['charged'] = '^Спишется[^\d\,\.]*\s+(\d+[.,]?\d{0,2})([^\d\.\,]+[^\d]*)?$';
    $patterns['account'] = '/^Пароль[:]?\s*/iu';

    $parts = preg_split('/' . $clauseDelimiter . '/', $string);
    foreach ($parts as $prt)
    {
        $string = trim($prt);
    }

    return $result;
}