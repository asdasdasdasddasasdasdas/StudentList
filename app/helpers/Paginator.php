<?php

namespace StudentList\helpers;

class Paginator
{
    private $perpage = 5;
    private $currentPage;
    private $allPage;
    private $search;

    public function __construct($page, $search, $cstudents)
    {

        $this->allPage = ceil($cstudents / $this->perpage);
        if ($page > 0 && $page <= $this->allPage) {

            $this->currentPage = $page;
        } else {
            $this->currentPage = 1;
        }

        $this->search = $search;

    }

    public function getPreviousPage()
    {

        return $this->currentPage > 1 ? $this->currentPage - 1 : null;
    }


    public function getPreviousPageUrl()
    {
        $previousPage = $this->currentPage > 1 ? $this->currentPage - 1 : null;
        return "/?page=" . urlencode($previousPage) . '&search=' . urlencode($this->search);
    }


    public function getNextPageUrl()
    {
        $nextPage = $this->allPage > 1 && $this->currentPage != $this->allPage ? $this->currentPage + 1 : null;
        return "/?page=" . urlencode($nextPage) . '&search=' . urlencode($this->search);
    }


    public function getNextPage()
    {
        return $this->allPage > 1 && $this->currentPage != $this->allPage ? $this->currentPage + 1 : null;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

}
