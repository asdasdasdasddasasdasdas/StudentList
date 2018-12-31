<?php
namespace app\helpers;

class Paginator{
  private $perpage = 5;
  private $CurrentPage;
  private $AllPage;
public function countPage($cstudents)
{
return $this->AllPage = ceil($cstudents/$this->perpage);
}
public function getPreviousPage()
{
return $this->CurrentPage>1?$this->CurrentPage-1:null;
}
public function getNextPage()
{

  return  $this->AllPage > 1 && $this->CurrentPage != $this->AllPage ? $this->CurrentPage + 1 : null;
}
public function setCurrentPage($page)
{
$this->CurrentPage=$page;
}
public function getCurrentPage(){
  return $this->CurrentPage;
}
}
