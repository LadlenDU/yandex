<?php

/**
 * @param string $string Строка SMS подтверждения.
 * @param array $wrongClauses Нераспознанные строки.
 * @return array Распознанные элементы.
 */
function parseYandexSMS($string, &$wrongClauses = [])
{
    $result = ['password' => false, 'charged' => false, 'account' => false];

    $string = trim($string);

    $clauseDelimiter = '[\r\n]+';   // Разделитель строк.

    $patterns['password'] = '/(?=.*\bПароль\b)(?=.*?(\b\d+\b))/ui';
    $patterns['charged'] = '/(?=.*\bСпишется\b)(?=.*?(\b\d+[\.\,]?\d{0,2})\s*([\w$]+)*)/ui';
    $patterns['account'] = '/(?=.*\bСч[её]т\b)(?=.*?(\b\d+\b))/ui';

    $parts = preg_split('/' . $clauseDelimiter . '/', $string);
    foreach ($parts as $clause)
    {
        if (!$clause = trim($clause))
        {
            continue;
        }

        $parsed = false;

        if ($res = preg_match($patterns['password'], $clause, $matches))
        {
            if (!$result['password'])
            {
                $result['password'] = $matches[1];
            }
            else
            {
                $wrongClauses[] = "Повторно распознан пароль в утверждении: '$clause'";
            }
            $parsed = true;
        }
        elseif ($res = preg_match($patterns['charged'], $clause, $matches))
        {
            if (!$result['charged'])
            {
                $result['charged'] = ['charged' => $matches[1]];
                if (isset($matches[2]))
                {
                    $result['charged']['currency'] = $matches[2];
                }
            }
            else
            {
                $wrongClauses[] = "Повторно распознано поле 'спишется' в утверждении: '$clause'";
            }
            $parsed = true;
        }
        elseif ($res = preg_match($patterns['account'], $clause, $matches))
        {
            if (!$result['account'])
            {
                $result['account'] = $matches[1];
            }
            else
            {
                $wrongClauses[] = "Повторно распознано поле 'счет' в утверждении: '$clause'";
            }
            $parsed = true;
        }

        if (!$parsed)
        {
            $wrongClauses[] = "Не распознано утверждение: '$clause'";
        }
    }

    return $result;
}
