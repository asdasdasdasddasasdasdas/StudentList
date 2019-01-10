<?php
namespace app\controller;


use app\controller\Controller;
class MainController extends Controller
{
private $model;
private $auth;
protected $paginator;

  public function __construct( $model,  $auth, $paginator)
  {
    $this->model = $model;
    $this->auth = $auth;
    $this->paginator = $paginator;

}


public function mainAction()
{
  $search=htmlspecialchars($_GET['search']);
  $keyword = "%$search%";

  $limit = 5;
  $this->countStudents =$_GET['search']!==null? $this->model->countStudentsBySearch($keyword):$this->model->countAllStudent();
  $this->paginator->countPage($this->countStudents);
  $_GET['page'] = $_GET['page']==null?1:$_GET['page'];
  $this->paginator->setCurrentPage($_GET['page']);


  $offset = $limit*($_GET['page']-1);
    $this->auth->checkHash();

$students =$_GET['search']!==null?$this->model->SearchStudents($offset,$limit,$keyword):$this->model->GetStudents($offset,$limit);
$this->render('app/view/main/main.php',['students'=>$students, 'search'=>$search]);




  }
}
