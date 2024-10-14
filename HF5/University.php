<?php

class University extends AbstractUniversity
{

    /**
     * @var array
     */
    public array $subjects = [];

    /**
     * Method accepts the name and code of the Subject, creates instance of the class,
     * adds the instance in $subjects array and returns created instance
     *
     * @param string $code
     * @param string $name
     * @return Subject
     * @throws Exception
     */
    public function addSubject(string $code, string $name): Subject
    {
        if ($this->isSubjectExists($code, $name)) {
            throw new Exception("Subject already exists!");
        }
        $subject = new Subject($code, $name);
        $this->subjects[] = $subject;
        return $subject;
    }

    /**
     * Method accepts subject code and Student. Finds subject in $subjects array based on code and adds student to its array.
     *
     * @param string $subjectCode
     * @param Student $student
     * @return void
     */
    public function addStudentOnSubject(string $subjectCode, Student $student): void
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $subjectCode) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
            }
        }
    }

    /**
     * Method returns students for given subject
     *
     * @param string $subjectCode
     * @return array
     */
    public function getStudentsForSubject(string $subjectCode): array
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $subjectCode) {
                return $subject->getStudents();
            }
        }
        return [];
    }

    /**
     * This method returns number of total students registered on all subjects
     *
     * @return int
     */
    public function getNumberOfStudents(): int
    {
        $num = 0;
        foreach ($this->subjects as $subject) {
            $num += count($subject->getStudents());
        }
        return $num;
    }

    /**
     * @param string $code
     * @param string $name
     * @return bool
     */
    public function isSubjectExists(string $code, string $name): bool
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() === $code && $subject->getName() === $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Subject $subject
     * @return void
     * @throws Exception
     */
    public function deleteSubject(Subject $subject): void
    {
        for ($i = 0; $i < count($this->subjects); $i++) {
            $_subject = $this->subjects[$i];
            if ($_subject === $subject) {
                if (!empty($_subject->getStudents())) {
                    throw new UniversityException("Subject is not empty!");
                } else {
                    unset($this->subjects[$i]);
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getSubjects(): array
    {
        return $this->subjects;
    }

    /**
     * Method must iterate over $subjects, print the subject name then "-" 25 times,
     * then iterate over students of the subject and print student name and student number in format
     * StudentName - StudentNumber
     * Student2Name - Student2Number
     *
     * @return void
     */
    public function print(): void
    {
        foreach ($this->subjects as $subject) {
            echo $subject->getName() . PHP_EOL;
            echo str_repeat('-', 25) . PHP_EOL;
            foreach ($subject->getStudents() as $student) {
                echo sprintf("%s - %s\n", $student->getName(), $student->getStudentNumber());
            }
            echo PHP_EOL;
        }
    }
}