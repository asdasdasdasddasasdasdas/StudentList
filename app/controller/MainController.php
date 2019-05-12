<?php

namespace StudentList\controller;

class MainController extends \StudentList\core\Controller
{
    /**
     * @var \StudentList\helpers\Authorization
     */
    protected $auth;
    /**
     * @var \StudentList\model\StudentTableGateway
     */
    private $studentTG;

    /**
     * MainController constructor.
     * @param \StudentList\model\StudentTableGateway $studentTG
     * @param \StudentList\helpers\Authorization $auth
     */
    public function __construct(
        \StudentList\model\StudentTableGateway $studentTG,
        \StudentList\helpers\Authorization $auth
    )
    {
        $this->studentTG = $studentTG;
        $this->auth = $auth;

    }


    public function mainAction(): void
    {
        $limit = 5;
        $page = isset($_GET['page']) ? intval($_GET['page']) : null;
        $search = isset($_GET['search']) ? trim(strval($_GET['search'])) : null;

        $countStudents = isset($_GET['search']) ? $this->studentTG->countStudentsBySearch($search) : $this->studentTG->countAllStudent();
        $paginator = new \StudentList\helpers\Paginator($page, $search, $countStudents);

        $offset = $limit * ($paginator->getCurrentPage() - 1);

        $students = isset($search) ? $this->studentTG->searchStudents($offset, $limit, $search) : $this->studentTG->getStudents($offset, $limit);

        $this->render('../app/view/main/main.php', ['students' => $students, 'search' => $search, 'paginator' => $paginator]);
    }
}
