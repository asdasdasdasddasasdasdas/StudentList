<?php

namespace StudentList\model;

use PDO;
use StudentList\config\DBConnector;

class StudentTableGateway
{
    /**
     * @var PDO
     */
    protected $db;

    /**
     * StudentTableGateway constructor.
     * @param array $config
     */
    function __construct(array $config)
    {


        $this->db = new PDO('mysql:host=' . $config['host'] .
            ';dbname=' . $config['name'] . ';charset=' . $config['charset'] . ';',
            $config['user'],
            $config['password']);


    }

    /**
     * @param string $hash
     * @return bool
     */
    public function checkAuthUser(string $hash): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM students where hash=:hash");
        $stmt->bindValue(':hash', $hash);
        $stmt->execute();
        return $stmt->fetchColumn() != 0 ? true : false;
    }

    /**
     * @param string $keyword
     * @return int
     */
    public function countStudentsBySearch(string $keyword): int
    {
        $keyword = "%$keyword%";
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM students
           WHERE name
           LIKE :keyword");
        $stmt->bindValue(":keyword", $keyword);
        $stmt->execute();
        return intval($stmt->fetchColumn());

    }

    /**
     * @param int $offset
     * @param int $limit
     * @param string $keyword
     * @return array
     */
    public function SearchStudents(int $offset, int $limit, string $keyword): array
    {
        $keyword = "%$keyword%";

        $stmt = $this->db->prepare("SELECT * FROM students
           WHERE name
           LIKE :keyword
           ORDER BY id DESC
           LIMIT :offset, :limit
            ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getStudents(int $offset, int $limit): array
    {
        $stmt = $this->db->prepare("SELECT *
           FROM students
           ORDER BY id DESC
           LIMIT :offset, :limit
          ");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * @return int
     */
    public function countAllStudent(): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM students");
        $stmt->execute();
        return intval($stmt->fetchColumn());
    }

    /**
     * @param string $hash
     * @return \StudentList\model\Student
     */
    public function getStudentByHash(string $hash): Student
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE hash=:hash");
        $stmt->bindValue(":hash", $hash);
        $stmt->execute();
        return $stmt->fetchObject('StudentList\model\Student');
    }

    /**
     * @param \StudentList\model\Student $student
     */
    public function addStudent(Student $student): void
    {

        $stmt = $this->db->prepare('INSERT INTO students (name, surname, balli, group_name, gender, email, hash)
           VALUES (:name, :surname, :balli, :group_name, :gender, :email, :hash)');
        $stmt->bindValue(":name", $student->name);
        $stmt->bindValue(":surname", $student->surname);
        $stmt->bindValue(":balli", $student->balli);
        $stmt->bindValue(":group_name", $student->group_name);
        $stmt->bindValue(":gender", $student->gender);
        $stmt->bindValue(":email", $student->email);
        $stmt->bindValue(":hash", $student->hash);
        $stmt->execute();
    }

    /**
     * @param \StudentList\model\Student $student
     */
    public function updateStudent(Student $student): void
    {
        $stmt = $this->db->prepare("UPDATE students
           SET name=:name,
           surname=:surname,
           balli=:balli,
           group_name=:group_name,
           gender=:gender,
           email=:email
           WHERE hash=:hash");
        $stmt->bindValue(":name", $student->name);
        $stmt->bindValue(":surname", $student->surname);
        $stmt->bindValue(":balli", $student->balli);
        $stmt->bindValue(":group_name", $student->group_name);
        $stmt->bindValue(":gender", $student->gender);
        $stmt->bindValue(":email", $student->email);
        $stmt->bindValue(":hash", $student->hash);
        $stmt->execute();

    }

    /**
     * @param string $email
     * @param null $id
     * @return bool
     */
    public function checkEmail(string $email, $id = null): bool
    {

        if ($id) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM students WHERE email=:email AND id<>:id");
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":email", $email);

        } else {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM students WHERE email=:email", ['email' => $email]);
            $stmt->bindValue(":email", $email);
        }
        $stmt->execute();
        $result = intval($stmt->fetchColumn());

        return $result > 0;
    }


}
