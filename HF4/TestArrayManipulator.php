<?php

include "ArrayManipulator.php";

$manipulator = new ArrayManipulator();

$manipulator->name = "John Doe";
$manipulator->age = 30;
echo "Név: " . $manipulator->name . PHP_EOL;
echo "Kor: " . $manipulator->age . PHP_EOL;

if (isset($manipulator->age)) {
    echo "Kor meg van adva" . PHP_EOL;
} else {
    echo "Kor nincs megadva" . PHP_EOL;
}

unset($manipulator->age);
if (!isset($manipulator->age)) {
    echo "Kor törölve lett" . PHP_EOL;
}

echo "Tömb tartalma: " . $manipulator . PHP_EOL;

$cloneManipulator = clone $manipulator;
$cloneManipulator->name = "Jane Doe";
echo "Eredeti: " . $manipulator . PHP_EOL;
echo "Másolat: " . $cloneManipulator . PHP_EOL;