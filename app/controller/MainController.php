<?php
namespace app\controller;

use app\controller\Controller;

class MainController extends Controller
{
   private $model;
   private $auth;
   protected $paginator;

   public function __construct(
       \app\model\StudentTableGateway $model,
       \app\helpers\Authorization $auth,
       \app\helpers\Paginator $paginator
   )
   {
    $this->model = $model;
    $this->auth = $auth;
    $this->paginator = $paginator;

   }


   public function mainAction()
   {
   $search=$_GET['search'];
   $limit = 5;
   $countStudents =$_GET['search']!==''? $this->model->countStudentsBySearch($search):$this->model->countAllStudent();
   $this->paginator->countPage($countStudents);
   $this->paginator->setCurrentPage($_GET['page']);
   $offset = $limit*($this->paginator->getCurrentPage()-1);
   $students =$_GET['search']!==''?$this->model->SearchStudents($offset,$limit,$search):$this->model->GetStudents($offset,$limit);
   $this->render('../public/view/main/main.php',['students'=>$students, 'search'=>$search]);
   }
}
