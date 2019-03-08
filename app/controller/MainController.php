<?php

namespace StudentList\controller;


use StudentList\controller\Controller;

class MainController extends Controller
{
    private $studentTG;
    protected $auth;

    public function __construct(
        \StudentList\model\StudentTableGateway $studentTG,
        \StudentList\helpers\Authorization $auth

    ) {
        $this->studentTG = $studentTG;
        $this->auth = $auth;


    }


    public function mainAction()
    {
        $limit = 5;

        $search = trim(strval($_GET['search']));
        $countStudents = $_GET['search'] !== '' ? $this->studentTG->countStudentsBySearch($search) : $this->studentTG->countAllStudent();
        $this->paginator = new \StudentList\helpers\Paginator(intval($_GET['page']), $search, $countStudents);

        $offset = $limit * ($this->paginator->getCurrentPage() - 1);

        $students = $_GET['search'] !== '' ? $this->studentTG->SearchStudents($offset, $limit,
            $search) : $this->studentTG->getStudents($offset, $limit);

        $this->render('../app/view/main/main.php', ['students' => $students, 'search' => $search]);
    }
}
