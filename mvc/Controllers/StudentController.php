<?php
require_once '../Models/Student.php';

class StudentController
{
    public function __construct()
    {

    }

    public function index()
    {
        var_dump(123);
    }

    public function create(): void
    {
        require_once '../Views/layouts/index.php';
    }
}