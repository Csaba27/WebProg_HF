<?php

class Grade
{
    /**
     * @var Subject
     */
    private Subject $subject;

    /**
     * @var float
     */
    private float $grade;

    /**
     * @param Subject $subject
     * @param float $grade
     */
    public function __construct(Subject $subject, float $grade = 0.0)
    {
        $this->subject = $subject;
        $this->grade = $grade;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     * @return void
     */
    public function setSubject(Subject $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return float
     */
    public function getGrade(): float
    {
        return $this->grade;
    }

    /**
     * @param float $grade
     * @return void
     */
    public function setGrade(float $grade): void
    {
        $this->grade = $grade;
    }
}