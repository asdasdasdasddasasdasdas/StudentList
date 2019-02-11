<div class="row row mt-5">
    <div class="col-lg-6 ">
        <label class="label" for="">Name:</label>
        <input class="form-control " type="text" name="name" value="<?= htmlspecialchars($student->name) ?>">
    </div>
    <div class="col-lg-6">
        <span class="text-danger"><?= htmlspecialchars($errors['name_error']); ?></span>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6">
        <label class="label" for="">Surname:</label>
        <input class="form-control " type="text" name="surname" value=<?= htmlspecialchars($student->surname) ?>>
    </div>
    <div class="col-lg-6">
        <span class="text-danger"><?= htmlspecialchars($errors['surname_error']) ?></span><br>
    </div>
</div>
<div class="row  mt-5">
    <div class="col-lg-6">
        <label class="label" for="">Group:</label>
        <input class="form-control " type="text" name="group_name" value=<?= htmlspecialchars($student->group_name) ?>>
    </div>
    <div class="col-lg-6">
        <span class="text-danger"><?= htmlspecialchars($errors['group_name_error']) ?></span><br>
    </div>
</div>
<div class="row  mt-5">
    <div class="col-lg-6">
        <label class="label" for="">Ege:</label>
        <input class="form-control " type="number" name="balli" value=<?= htmlspecialchars($student->balli) ?>>
    </div>
    <div class="col-lg-6">
        <span class="text-danger"><?= htmlspecialchars($errors['balli_error']) ?></span><br>
    </div>
</div>
<div class="row mt-5">
    <div class="col-lg-6">
        <label class="label" for="">Email:</label>
        <input class="form-control " type="email" name="email" value=<?= htmlspecialchars($student->email) ?>>
    </div>
    <div class="col-lg-6">
        <span class="text-danger"><?= htmlspecialchars($errors['email_error']) ?></span><br>
    </div>
</div>
<div class="row  mt-5">
    <div class="col-lg-6">
        <input type="radio" name="gender" value="f" <?= $student->gender == 'f' ? 'checked=checked' : null; ?>>
        <label class="h6" for="gender">Female</label>
        <input type="radio" name="gender" value="m" <?= $student->gender == 'm' ? 'checked=checked' : null; ?> >
        <label class="h6" for="gender">Male</label>
    </div>
    <div class="col-lg-6 ">
        <span id='asd' class="text-danger align-middle"><?= htmlspecialchars($errors['gender_error']); ?></span><br>
    </div>
</div>
<button type="submit" class="btn btn-primary btn-rounded" name="submit">Submit</button>
</form>

<a class="btn btn-primary btn-block" href="/">Вернутся на главную страницу</a>
</div>
