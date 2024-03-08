<?php
 
class Student
{
    public static array $students;
 
    protected int $id;
    protected string $name;
    protected string $birthday;
 
    public function __construct(
        int $id = 0,
        string $name = '',
        string $birthday = '',
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
    }
    public function getStudentInfo(): array {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "birthday"=> $this->birthday
        ];  
    }

    public static function exportTxt(string $namefile):void {

        $lines = [];
        foreach (self::$students as $student) {
            $lines[] = $student->buildLine();
        }
        file_put_contents("{$namefile}.txt", implode(PHP_EOL, $lines) . PHP_EOL);
    }
  
    public static function create(array $data):void {
        $newStudent = new Student();
        $newStudent->name = $data['name'] ?? '';
        $newStudent->birthday = $data['birthday'] ?? '';
        $newStudent->id = count(self::$students) + 1;
        self::$students[]= $newStudent;
        self::exportTxt('students');
    }

    public static function find(int $id): ?Student {
        foreach(self::$students as $student) {
            if($student->id === $id) return $student;
        }
        return null;
    }

    public function update(array $data):void {
        $this->name = $data['name'] ?? $this->name;
        $this->birthday = $data['birthday'] ?? $this->birthday;
        $this->save();
    }

    public function findExistIndex(): ?int {
        $index = null;
        foreach (self::$students as $key => $student) {   
            if ($student->id === $this->id) {
                $index = $key;
                return $index;
            } 
        }
        return null;

    }

    public function save(): void
    {
        $existStudentIndex = $this->findExistIndex();
   
        if ($existStudentIndex !== null) {
            self::$students[$existStudentIndex] = $this;
        } else {
            self::$students[] = $this;
        }
        
        self::exportTxt('students');
    }


 
    public static function loadData(): void
    {
        self::$students = [];
        $lines = file('students.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            self::$students[] = self::parseStudent($line);
        }
    }
 
    public function buildLine(): string
    {
        $data = [
            $this->id,
            $this->name,
            $this->birthday,
        ];
 
        return implode(',', $data);
    }
 
    public static function parseStudent(string $line): Student
    {
        $data = self::parseLine($line);
 
        return new Student(...$data);
    }
 
    public static function parseLine(string $line): array
    {
        return explode(',', $line);
    }
}

