
<div class="p-1">
<div class="table-responsive text-nowrap">



    <form action="" class=" d-flex justify-content-end"  method="get">
  <input type="text" class="search" name="search" placeholder='Поиск по имени' value=<?= htmlspecialchars($search, ENT_QUOTES); ?>>
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
<?php foreach ($students as $student):?>
<tr>
  <td class="px-5"> <?= htmlspecialchars($student->name, ENT_QUOTES) ?></td>
  <td class="px-5"><?= htmlspecialchars($student->surname, ENT_QUOTES) ?></td>
  <td class="px-5"><?= htmlspecialchars($student->balli, ENT_QUOTES) ?></td>
  <td class="px-5"><?= htmlspecialchars($student->groupa, ENT_QUOTES) ?></td>
  <td class="px-5"><?= htmlspecialchars($student->email, ENT_QUOTES) ?></td>
  <td class="px-5"><?= htmlspecialchars($student->gender, ENT_QUOTES) ?></td>
</tr>
<?php endforeach;?>
</table>
</div>
<div class="row d-flex justify-content-center">



<div class="col-lg-4 d-flex justify-content-center">
  <nav aria-label="Page navigation example">
    <ul class="pagination pg-blue">
  <?php if($this->paginator->getPreviousPage()!==null):?>  <li class="page-item"><a class = "page-link" href=<?=$this->paginator->getPreviousPageUrl();?>> <?= $this->paginator->getPreviousPage(); ?></a></li><?php endif;?>
     <li class="page-item active"><a class = "page-link"  > <?= $this->paginator->getCurrentPage(); ?></a></li>
       <?php if($this->paginator->getNextPage()!==null):?><li class="page-item"><a class = "page-link" href=<?= $this->paginator->getNextPageUrl()?>> <?= $this->paginator->getNextPage(); ?></a></li><?php endif;?>
       </ul>
       </nav>
</div>


</div>
</div>