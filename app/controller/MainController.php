<?php

namespace StudentList\controller;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use StudentList\core\View;

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

    private $view;

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
        $this->view = new View();
        $this->studentTG = $studentTG;
        $this->auth = $auth;

    }


    public function mainAction(RequestInterface $request,ResponseInterface $response)
    {
        $queryParams = $request->getQueryParams();
        $limit = 5;
        $sort = empty($queryParams['sort']) ? null : trim(strval($queryParams['sort']));
        $page = empty($queryParams['page']) ? null : intval($queryParams['page']);
        $search = empty($queryParams['search']) ? null : trim(strval($queryParams['search']));
        $marker = new \StudentList\helpers\Marker($search);
        $countStudents = $this->studentTG->countAllStudent($search);
        $paginator = new \StudentList\helpers\Paginator($page, $search, $countStudents, $sort);
        $offset = $limit * ($paginator->getCurrentPage() - 1);
        $students = $this->studentTG->getStudents($offset, $limit, $sort, $search);

        return $this->view->render('../app/view/main/main.php', $response, [
            'marker' => $marker,
            'students' => $students,
            'search' => $search,
            'paginator' => $paginator,
            'auth' => $this->auth]);
    }
}
