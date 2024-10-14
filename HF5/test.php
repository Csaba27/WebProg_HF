<?php

spl_autoload_register(function ($class_name) {
    $class_file = $class_name . '.php';
    if (file_exists($class_file)) {
        include_once $class_file;
    } else {
        throw  new Exception("Class $class_name not found!");
    }
});


$univ = new University();

$webprog = null;
$database = null;

try {
    $webprog = $univ->addSubject('101', 'Web programming');
    $database = $univ->addSubject('102', 'Database');
} catch (Exception $e) {
    print $e->getMessage();
}

$student1 = $webprog->addStudent('Kiss Lajos', 28);
echo $student1;
$student2 = $webprog->addStudent('Nagy Péter', 521);

$database->addStudent($student1->getName(), $student1->getStudentNumber());
$database->addStudent($student2->getName(), $student2->getStudentNumber());

$univ->print();

$student1->addGrade($webprog, 8.5);
$student1->addGrade($database, 9.2);
$student2->addGrade($webprog, 9.4);
$student2->addGrade($database, 8.2);

$students = [$student1, $student2];

function sortStudentsByAverage(array $students): array
{
    usort($students, function ($a, $b) {
        return $b->getAvgGrade() <=> $a->getAvgGrade();
    });

    return $students;
}

$i = 0;
foreach (sortStudentsByAverage($students) as $student) {
    echo '#' . (++$i) . ' ' . $student->getName() . ' - ' . $student->getAvgGrade() . PHP_EOL;
}

// print_r($student1);
$student1->printGrades();
$webprog->deleteStudent($student2->getStudentNumber());
$univ->print();

try {
    $univ->deleteSubject($webprog);
} catch (UniversityException $e) {
    print $e->getMessage() . PHP_EOL;
}

$webprog->deleteStudent($student1->getStudentNumber());

try {
    $univ->deleteSubject($webprog);
} catch (UniversityException $e) {
    print $e->getMessage();
}

$univ->print();
