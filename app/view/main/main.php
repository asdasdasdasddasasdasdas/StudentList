
<div class="p-1">
<div class="table-responsive text-nowrap">



    <form action="" class=" d-flex justify-content-end"  method="get">
  <input type="text" class="search" name="search" placeholder="Поиск по имени">
          <button type="submit" class="btn btn-primary">Search</button>
    </form>

<table class = "table">
  <thead>
  <tr>
    <th class="col px-5">Name</th>
    <th class="col px-5">Surname</th>
    <th class="col px-5">Ege</th>
    <th class="col px-5">Group</th>
    <th class="col px-5">Email</th>
    <th class="col px-5">Gender</th>
  </tr>
</thead>
<?php foreach ($students as $key => $value):?>
<tr>
  <td class="px-5"> <?=$students[$key]['name']; ?></td>
  <td class="px-5"><?=$students[$key]['surname'] ?></td>
  <td class="px-5"><?=$students[$key]['balli'] ?></td>
  <td class="px-5"><?= $students[$key]['groupa'] ?></td>
  <td class="px-5"><?= $students[$key]['email'] ?></td>
  <td class="px-5"><?= $students[$key]['male']==1?'М':'Ж'; ?></td>
</tr>
<?php endforeach;?>
</table>
</div>
<div class="row d-flex justify-content-center">



<div class="col-lg-4 d-flex justify-content-center">
  <nav aria-label="Page navigation example">
    <ul class="pagination pg-blue">
  <?php if($this->paginator->getPreviousPage()!==null):?>  <li class="page-item"><a class = "page-link" href=<?="/?page=".$this->paginator->getPreviousPage(); echo$search!==null?"&search=".$search:null;?>> <?= $this->paginator->getPreviousPage(); ?></a></li><?php endif;?>
     <li class="page-item"><a class = "page-link" href=<?= "/?page=".$this->paginator->getCurrentPage(); echo $search!==null?"&search=".$search:null?> > <?= $this->paginator->getCurrentPage(); ?></a></li>
       <?php if($this->paginator->getNextPage()!==null):?><li class="page-item"><a class = "page-link" href=<?= "/?page=".$this->paginator->getNextPage(); echo $search!==null?"&search=".$search:null; ?>> <?= $this->paginator->getNextPage(); ?></a></li><?php endif;?>
       </ul>
       </nav>
</div>


</div>
</div>
