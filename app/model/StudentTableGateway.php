<?php
namespace app\model;
use PDO;
class StudentTableGateway {
protected $db;

  function __construct(){
$config = require 'app/config/db.php';
$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].';',$config['user'],$config['password'],[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
private function query($sql,$params=[]){

$stmt=$this->db->prepare($sql);

if(!empty($params)){

    foreach ($params as $key => $value) {

    $stmt->bindValue(':'.$key,$value);

    }
}

$stmt->execute();


return $stmt;
}
public function getAllStudents($offset,$limit){
$stmt=$this->db->prepare("SELECT * FROM students LIMIT :limit OFFSET :offset");
  $stmt->bindValue(':limit',$limit,PDO::PARAM_INT);
  $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}
public function countAllStudent(){
$result = $this->query("SELECT COUNT(*) FROM students");
return $result->fetchColumn();
}
public function getStudentByHash(string $hash){

$result = $this->query("SELECT * FROM students WHERE hash=:hash",['hash'=>$hash]);

  return $result->fetch();

}
public function addStudent(Student $student){
$result=$this->query('INSERT INTO students
     (name, surname, balli, groupa, male,female,email,hash )
     VALUES
     (:name, :surname, :balli, :group, :male,:female,:email,:hash)',
     ['name'=>$student->name,
     'surname'=>$student->surname,
     'balli'=>$student->balli,
     'group'=>$student->group,
     'male'=>$student->male,
     'female'=>$student->female,
     'email'=>$student->email,
     'hash'=>$student->hash
     ]);
}
public function updateStudent( $student){
$this->query("UPDATE students SET name=:name,surname=:surname, balli=:balli, groupa=:group, male=:male, female =:female, email=:email WHERE hash=:hash",
   ['name'=>$student->name,
   'surname'=>$student->surname,
   'balli'=>$student->balli,
   'group'=>$student->group,
   'male'=>$student->male,
   'female'=>$student->female,
   'email'=>$student->email,
   'hash'=>$student->hash
   ]);
}
public function CheckEmail(string $email){
$result = $this->query("SELECT * FROM student WHERE email=$email");
if($result!=null){
  return true;
}
}
}
