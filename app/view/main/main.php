<div class="p-1">
    <div class="main-table table-responsive text-nowrap">

        <header class="d-flex justify-content-center">
            <form action="" class="d-flex" method="get">
                <input type="text" class="search" name="search" placeholder='Поиск по имени'
                       value=<?= htmlspecialchars($search, ENT_QUOTES); ?>>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <?php if (!$this->auth->IsLoggedIn()) : ?>

                <a class="ml-5 btn-main btn btn-primary align-self-center" href="/registration">Зарегистрироваться</a>

            <?php endif; ?>
            <?php if ($this->auth->IsLoggedIn()) : ?>
                <a class="ml-5 btn-main btn btn-primary align-self-center" href="/profile">В профиль</a>
            <?php endif; ?>
        </header>

        <table class="table">
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
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>

                    <tr>
                        <td class="px-5"> <?= htmlspecialchars($student->name, ENT_QUOTES) ?></td>
                        <td class="px-5"><?= htmlspecialchars($student->surname, ENT_QUOTES) ?></td>
                        <td class="px-5"><?= htmlspecialchars($student->balli, ENT_QUOTES) ?></td>
                        <td class="px-5"><?= htmlspecialchars($student->group_name, ENT_QUOTES) ?></td>
                        <td class="px-5"><?= htmlspecialchars($student->email, ENT_QUOTES) ?></td>
                        <td class="px-5"><?= htmlspecialchars($student->gender, ENT_QUOTES) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (empty($students)) : ?>
                <tr>
                    <td colspan="6" rowspan="2">Данных нет</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="row d-flex justify-content-center">


        <div class="col-lg-4 d-flex justify-content-center">
            <nav aria-label="Page navigation example">

                <ul class="pagination pg-blue">
                    <?php if ($this->paginator->getPreviousPage() !== null): ?>
                        <li class="page-item"><a class="page-link"
                                                 href=<?= htmlspecialchars($this->paginator->getPreviousPageUrl()); ?>> <?= htmlspecialchars($this->paginator->getPreviousPage()); ?></a>
                        </li><?php endif; ?>
                    <?php if ($this->paginator->getPreviousPage() !== null || $this->paginator->getNextPage() !== null): ?>
                        <li class="page-item active"><a
                                    class="page-link"> <?= htmlspecialchars($this->paginator->getCurrentPage()); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->paginator->getNextPage() !== null): ?>
                        <li class="page-item"><a class="page-link"
                                                 href=<?= htmlspecialchars($this->paginator->getNextPageUrl()) ?>> <?= htmlspecialchars($this->paginator->getNextPage()); ?></a>
                        </li><?php endif; ?>
                </ul>
            </nav>
        </div>


    </div>
</div>
