<?php

class Subject
{
    /**
     * @var string
     */
    private string $code;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var array
     */
    private array $students;

    /**
     * @param string $code
     * @param string $name
     * @param array $students
     */
    public function __construct(string $code, string $name, array $students = [])
    {
        $this->code = $code;
        $this->name = $name;
        $this->students = $students;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
     * @return array
     */
    public function getStudents(): array
    {
        return $this->students;
    }

    /**
     * @param string $name
     * @param string $studentNumber
     * @return Student
     * @throws Exception
     */
    public function addStudent(string $name, string $studentNumber): Student
    {
        if ($this->isStudentExists($studentNumber)) {
            throw new Exception("Student already exists!");
        }
        $student = new Student($name, $studentNumber);
        $this->students[] = $student;
        return $student;
    }

    /**
     * @param string $studentNumber
     * @return bool
     */
    public function deleteStudent(string $studentNumber): bool
    {
        for ($i = 0; $i < count($this->students); $i++) {
            $student = $this->students[$i];
            if ($student->getStudentNumber() === $studentNumber) {
                unset($this->students[$i]);
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $studentNumber
     * @return bool
     */
    public function isStudentExists(string $studentNumber): bool
    {
        foreach ($this->students as $student) {
            if ($student->getStudentNumber() === $studentNumber) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name . ' ' . $this->code . PHP_EOL;
    }
}