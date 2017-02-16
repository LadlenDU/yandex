<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'function.php';

$string = isset($_POST['string']) ? $_POST['string'] : 'Пароль: 7054
Спишется 458,3р.
Перевод на счет 410014456520804';

$parsed = parseYandexSMS($string, $wrongClauses);

$result = '';

if ($wrongClauses)
{
    $result .= "Некоторые строки не были распознаны или распознаны не верно!\n"
        . implode("\n", $wrongClauses) . "\n--------------------\n\n";
}

$result .= "Распознанные элементы SMS:\n" . print_r($parsed, true);

if (isset($_POST['string']))
{
    die($result);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Распознавание SMS</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <style type="text/css">
        html, body {
            width: 100%;
        }
        .container {
            margin: 30px auto;
            width: 610px;
        }
    </style>
</head>
<body>

<div class="container">
    <button id="count" style="width: 100px">Распознать</button><br>
    <textarea name="string" style="width:500px" rows="7"><?php echo htmlspecialchars($string, ENT_QUOTES, 'utf-8') ?></textarea><br>
    <pre id="result"><?php echo htmlspecialchars($result, ENT_QUOTES, 'utf-8') ?></pre>
</div>

<script>
    $(function () {
        function calc() {
            var string = $('[name="string"]').val();
            $.post('index.php', {string: string}, function (text) {
                $("#result").text(text);
            }, 'text');
        }

        $("[name='string']").keyup(function () {
            calc();
        });
        $("#count").click(function () {
            calc();
        });
        calc();
    });
</script>

</body>
</html>
