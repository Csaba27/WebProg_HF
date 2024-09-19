<?php
$num1 = 10;
$num2 = 5;
$operator = '/';

switch ($operator) {
    case '+':
        $result = $num1 + $num2;
        echo "Eredmény: {$num1} + {$num2} = {$result}";
        break;

    case '-':
        $result = $num1 - $num2;
        echo "Eredmény: {$num1} - {$num2} = {$result}";
        break;

    case '*':
        $result = $num1 * $num2;
        echo "Eredmény: {$num1} * {$num2} = {$result}";
        break;

    case '/':
        if ($num2 != 0) {
            $result = $num1 / $num2;
            echo "Eredmény: {$num1} / {$num2} = {$result}";
        } else {
            echo "Hiba: 0-val való osztás nem lehetséges!";
        }
        break;

    default:
        echo "Hiba: Érvénytelen műveleti jel!";
        break;
}