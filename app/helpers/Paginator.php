<?php

namespace StudentList\helpers;

class Paginator
{
    /**
     * @var int
     */
    private $perpage = 5;
    /**
     * @var int
     */
    private $currentPage;
    /**
     * @var int
     */
    private $allPage;
    /**
     * @var
     */
    private $search;

    /**
     * Paginator constructor.
     * @param $page
     * @param $search
     * @param $cstudents
     */
    public function __construct($page, $search, $cstudents)
    {

        $this->allPage = intval(ceil($cstudents / $this->perpage));
        if ($page > 0 && $page <= $this->allPage) {

            $this->currentPage = $page;
        } else {
            $this->currentPage = 1;
        }

        $this->search = $search;

    }

    /**
     * @return string
     */
    public function getPreviousPageHtml()
    {
        $previousPage = $this->currentPage - 1;
        return $this->currentPage > 1 ? "<li class='page-item'><a class='page-link' href={$this->getPageUrl($previousPage)} >  {$previousPage }</a> </li>" : '';
    }

    /**
     * @param $pageNum
     * @return string
     */
    public function getPageUrl($pageNum)
    {
        return "?" . http_build_query(["page" => $pageNum,
                "search" => $this->search]);
    }

    /**
     * @return string
     */
    public function getNextPageHtml()
    {


        $nextPage = $this->currentPage + 1;
        return $this->allPage > 1 && $this->currentPage != $this->allPage ? "<li class='page-item'><a class='page-link' href={$this->getPageUrl($nextPage)} >  {$nextPage }</a> </li>" : '';
    }

    /**
     * @return string
     */
    public function getCurrentPageHtml()
    {


        $currentPage = $this->currentPage;
        return $currentPage < $this->allPage || $this->allPage && $this->allPage != 0 > 1 ? "<li class='page-item active'><a
                  class='page-link'> {$currentPage}</a>
      </li>" : '';

    }

    /**
     * @return int
     */
    public function getAllPage()
    {
        return $this->allPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}
