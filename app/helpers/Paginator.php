<?php
namespace app\helpers;

class Paginator
{
   private $perpage = 5;
   private $currentPage;
   private $allPage;


   public function countPage($cstudents)
   {
       $this->allPage = ceil($cstudents/$this->perpage);
   }


   public function getPreviousPage()
   {
       return $this->currentPage>1?$this->currentPage-1:null;
   }


   public function getPreviousPageUrl()
   {
       $previousPage=$this->currentPage>1?$this->currentPage-1:null;
       return "/?page=".$previousPage.'&search='.$_GET['search'];
   }


   public function getNextPageUrl()
   {
       $nextPage=$this->allPage > 1 && $this->currentPage != $this->allPage ? $this->currentPage + 1 : null;
       return "/?page=".$nextPage.'&search='.$_GET['search'];
   }


   public function getNextPage()
   {
       return $this->allPage > 1 && $this->currentPage != $this->allPage ? $this->currentPage + 1 : null;
   }


   public function setcurrentPage($page)
   {
       if($page > 0 && $page <= $this->allPage){
           $this->currentPage=$page;
       } else {
           $this->currentPage=1;
       }
   }


   public function getcurrentPage()
   {
       return $this->currentPage;
   }

}
