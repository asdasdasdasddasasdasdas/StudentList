<div class="p-1">
    <div class="main-table table-responsive">
        <form method="get">
            <header class="d-flex justify-content-center">

                <input type="text" class="search" name="search"
                       placeholder="Search by name"
                       value=<?= isset($search) ? htmlspecialchars($search, ENT_QUOTES) : null; ?>>
                <button type="submit" class="btn btn-primary">Search</button>

                <?php
                if (!$auth->IsLoggedIn($hash)) : ?>

                    <a class="ml-5 btn-main btn btn-primary align-self-center"
                       href="/registration">Registrastion</a>

                <?php endif; ?>
                <?php if ($auth->IsLoggedIn($hash)) : ?>
                    <a class="ml-5 btn-main btn btn-primary align-self-center"
                       href="/profile">Profile</a>
                <?php endif; ?>
            </header>

            <table class="table text-center">
                <thead>
                <tr>
                    <th class="col-2 px-5">Name</th>
                    <th class="col-2 px-5">Surname</th>


                    <th class="col-2 px-5"> <?= $paginator->getSort() ?> <a class="text-white"
                                                                            href="<?= $paginator->getSortLink(); ?>"
                                                                            id="ege-link">Ege</a></th>
                    <th class="col-2 px-5">Group</th>
                    <th class="col-2 px-5">Email</th>
                    <th class="col-2 px-5">Gender</th>
                </tr>
                </thead>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $student): ?>

                        <tr>
                            <td class="px-5"><?= $marker->mark($student->getName()) ?></td>
                            <td class="px-5"><?= htmlspecialchars($student->getSurname(), ENT_QUOTES) ?></td>
                            <td class="px-5"><?= htmlspecialchars($student->getBalli(), ENT_QUOTES) ?></td>
                            <td class="px-5"><?= htmlspecialchars($student->getGroupName(), ENT_QUOTES) ?></td>
                            <td class="px-5"><?= htmlspecialchars($student->getEmail(), ENT_QUOTES) ?></td>
                            <td class="px-5"><?= htmlspecialchars($student->getGender(), ENT_QUOTES) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (empty($students)) : ?>
                    <tr>
                        <td colspan="6" rowspan="2">Data not found</td>
                    </tr>
                <?php endif; ?>
            </table>
        </form>
    </div>
    <div class="row d-flex justify-content-center">


        <div class="col-lg-4 d-flex justify-content-center">
            <nav aria-label="Page navigation example">

                <ul class="pagination pg-blue">
                    <?= $paginator->getPreviousPageHtml(); ?>
                    <?= $paginator->getCurrentPageHtml(); ?>
                    <?= $paginator->getNextPageHtml(); ?>

                </ul>
            </nav>
        </div>


    </div>
</div>
