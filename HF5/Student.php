<?php

class Student
{
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $studentNumber;

    /**
     * @var array
     */
    private array $grades = [];

    /**
     * @param string $name
     * @param string $studentNumber
     */
    public function __construct(string $name, string $studentNumber)
    {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
    }

    /**
     * @param Subject $subject
     * @param float $grade
     * @return void
     */
    public function addGrade(Subject $subject, float $grade): void
    {
        $grade = new Grade($subject, $grade);
        $this->grades[$subject->getCode()] = $grade;
    }

    /**
     * @return float
     */
    public function getAvgGrade(): float
    {
        if (empty($this->grades)) {
            return 0.0;
        }
        $sum = 0.0;
        foreach ($this->grades as $grade) {
            $sum += $grade->getGrade();
        }
        return $sum / count($this->grades);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStudentNumber(): string
    {
        return $this->studentNumber;
    }

    /**
     * @param string $studentNumber
     * @return void
     */
    public function setStudentNumber(string $studentNumber): void
    {
        $this->studentNumber = $studentNumber;
    }

    /**
     * @return array
     */
    public function getGrades(): array
    {
        return $this->grades;
    }

    /**
     * @param array $grades
     * @return void
     */
    public function setGrades(array $grades): void
    {
        $this->grades = $grades;
    }

    public function printGrades()
    {
        foreach ($this->grades as $grade) {
            echo sprintf("%s - %.2f\n", $grade->getSubject()->getName(), $grade->getGrade());
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name . ' ' . $this->studentNumber . PHP_EOL;
    }
}