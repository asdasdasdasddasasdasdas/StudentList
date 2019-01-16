<?php
namespace app\model;

use app\model\Student;
use PDO;

class StudentTableGateway
{
   protected $db;

   function __construct($config)
   {

       $this->db = new PDO('mysql:host='.$config['host'].
           ';dbname='.$config['name'].';',
           $config['user'],
           $config['password']);

   }

   private function query($sql,$params=[])
   {


       $stmt=$this->db->prepare($sql);
       if(!empty($params)) {

           foreach ($params as $key => $value) {

               $stmt->bindValue(':'.$key,$value);

           }
       }
       $stmt->execute();

       return $stmt;
   }


   public function countStudentsBySearch($keyword) : int
   {
       $keyword = "%$keyword%";
       $result=$this->query("SELECT COUNT(*) FROM students
           WHERE name
           LIKE :keyword",
           ['keyword'=>$keyword]);

       return $result->fetchColumn();

   }
   public function SearchStudents($offset,$limit,$keyword) : array
   {
       $keyword = "%$keyword%";
       $stmt=$this->db->prepare("SELECT * FROM students
           WHERE name
           LIKE :keyword
           LIMIT :limit
           OFFSET :offset");

       $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
       $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
       $stmt->bindValue(':keyword',$keyword);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_CLASS);
   }


   public function GetStudents(int $offset,int $limit) : array
   {
       $stmt=$this->db->prepare("SELECT *
           FROM students
           LIMIT :limit
           OFFSET :offset");
       $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
       $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_CLASS);
   }


   public function countAllStudent() : int
   {
       $result = $this->query("SELECT COUNT(*) FROM students");
       return $result->fetchColumn();
   }


   public function getStudentByHash(string $hash) :Student
   {
       $result = $this->query("SELECT * FROM students WHERE hash=:hash",
           ['hash'=>$hash]);
       return $result->fetchObject('app\model\Student');
   }


   public function addStudent(Student $student) :void
   {

       $result=$this->query('INSERT INTO students (name, surname, balli, groupa, gender, email, hash) VALUES (:name, :surname, :balli, :groupa, :gender, :email, :hash)', ['name'=>$student->name,
              'surname'=>$student->surname,
              'balli'=>$student->balli,
              'groupa'=>$student->groupa,
              'gender'=>$student->gender,
              'email'=>$student->email,
              'hash'=>$student->hash
              ]);

   }
   public function updateStudent(Student $student) : void
   {
       $this->query("UPDATE students SET name=:name,
           surname=:surname,
           balli=:balli,
           groupa=:group,
           gender=:gender,
           email=:email
           WHERE hash=:hash",
           ['name'=>$student->name,
           'surname'=>$student->surname,
           'balli'=>$student->balli,
           'group'=>$student->groupa,
           'gender'=>$student->gender,
           'email'=>$student->email,
           'hash'=>$student->hash
           ]);
   }
   public function CheckEmail(string $email,$id=null) : bool
   {

       $result = $this->query("SELECT email, id FROM students WHERE email=:email",['email'=>$email]);
       $result=$result->fetch(PDO::FETCH_ASSOC);
       if($result == null) {
           return false;
       } elseif($result['email'] == $email && $result['id']==$id) {

           return false;
       } else {
           return true;
       }
   }
}
