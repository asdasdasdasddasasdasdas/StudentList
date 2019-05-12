<div class="row align-items-end mt-4">
    <div class="col-6 ">
        <label for="float-left">Name:</label><br>
        <input class="form-control " type="text" name="name"
               value="<?= isset($student->name) ? htmlspecialchars($student->name) : ''; ?>" required>
    </div>

    <?php if (isset($errors['name_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= htmlspecialchars($errors['name_error']) ?></span>
        </div>
    <?php endif; ?>
</div>

<div class="row align-items-end mt-4">
    <div class="col-6">
        <label class="label" for="">Surname:</label>
        <input class="form-control " type="text" name="surname"
               value="<?= isset($student->surname) ? htmlspecialchars($student->surname) : ''; ?>" required>
    </div>
    <?php if (isset($errors['surname_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= htmlspecialchars($errors['surname_error']); ?></span><br>
        </div>
    <?php endif; ?>
</div>
<div class="row align-items-end mt-4">
    <div class="col-6">
        <label class="label" for="">Group:</label>
        <input class="form-control " type="text" name="group_name"
               value="<?= isset($student->group_name) ? htmlspecialchars($student->group_name) : ''; ?>" required>
    </div>
    <?php if (isset($errors['group_name_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= isset($errors['group_name_error']) ? htmlspecialchars($errors['group_name_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>
<div class="row align-items-end mt-4">
    <div class="col-6">
        <label class="label" for="">Ege:</label>
        <input class="form-control " type="number" name="balli"
               value="<?= isset($student->balli) ? htmlspecialchars($student->balli) : ''; ?>" required>
    </div>
    <?php if (isset($errors['balli_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= isset($errors['balli_error']) ? htmlspecialchars($errors['balli_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>
<div class="row align-items-end mt-4">
    <div class="col-6">
        <label class="label" for="">Email:</label>
        <input class="form-control " type="email" name="email"
               value="<?= isset($student->email) ? htmlspecialchars($student->email) : ''; ?>" required>
    </div>
    <?php if (isset($errors['email_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= isset($errors['email_error']) ? htmlspecialchars($errors['email_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>
<div class="row align-items-end mt-4">
    <div class="col-6">
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input"
                   value="f" <?= isset($student->gender) && $student->gender == 'f' ? 'checked=checked' : ''; ?>>

            <label class="form-check-label" for="gender">Female</label>
        </div>
        <br>
        <div class="form-check">
            <input type="radio" name="gender" class="form-check-input"
                   value="m" <?= isset($student->gender) && $student->gender == 'm' ? 'checked=checked' : ''; ?> >

            <label class="form-check-label" for="gender">Male</label>
        </div>
    </div>
    <?php if (isset($errors['gender_error'])) : ?>
        <div class="col-6 ">
        <span id='asd'
              class="text-danger align-middle"><?= isset($errors['gender_error']) ? htmlspecialchars($errors['gender_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>
<div class="row mt-4"></div>
<input type="hidden" name="token" value=<?= $token ?>>
<?php if (isset($errors['token_error'])) : ?>
    <div class="col-12 ">
<span
        class="text-danger align-middle"><?= isset($errors['token_error']) ? htmlspecialchars($errors['token_error']) : ''; ?></span><br>
    </div>
<?php endif; ?>
<button type="submit" class="btn btn-primary" name="submit">Submit
</button>
</form>

<a id="btn" class="btn btn-primary btn-block" href="/">back to main</a>
</div>
