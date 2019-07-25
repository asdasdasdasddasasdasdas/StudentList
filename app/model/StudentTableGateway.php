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
     * @param int $offset
     * @param int $limit
     * @param $order
     * @param $keyword
     * @return array
     */
    public function getStudents(int $offset, int $limit, $order, $keyword): array
    {
        $keyword = "%$keyword%";
        if ($order == "down") {
            $order = "ORDER BY balli ASC";
        } else if ($order == "up") {
            $order = "ORDER BY balli DESC";
        } else {
            $order = "ORDER BY id DESC";
        }
        $stmt = $this->db->prepare("SELECT *
           FROM students
           WHERE name LIKE
           :keyword
            " . $order . "
           LIMIT :offset, :limit
          ");

        $stmt->bindValue(':keyword', $keyword);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "StudentList\model\Student");
    }


    /**
     * @param $keyword
     * @return int
     */
    public function countAllStudent($keyword): int
    {
        $keyword = "%$keyword%";
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM students
           WHERE name
           LIKE :keyword");
        $stmt->bindValue(':keyword', $keyword);
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
        $stmt->bindValue(":name", $student->getName());
        $stmt->bindValue(":surname", $student->getSurname());
        $stmt->bindValue(":balli", $student->getBalli());
        $stmt->bindValue(":group_name", $student->getGroupName());
        $stmt->bindValue(":gender", $student->getGender());
        $stmt->bindValue(":email", $student->getEmail());
        $stmt->bindValue(":hash", $student->getHash());
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
        $stmt->bindValue(":name", $student->getName());
        $stmt->bindValue(":surname", $student->getSurname());
        $stmt->bindValue(":balli", $student->getBalli());
        $stmt->bindValue(":group_name", $student->getGroupName());
        $stmt->bindValue(":gender", $student->getGender());
        $stmt->bindValue(":email", $student->getEmail());
        $stmt->bindValue(":hash", $student->getHash());
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
