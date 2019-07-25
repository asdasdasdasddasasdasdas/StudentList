<div class = "form-wrapper">
<div class="row align-items-end mt-5">
    <div class="col-6 ">
        <label class="label">Name:</label><br>
        <input class="form-control" type="text" name="name"
               value="<?= $student->getName() ? htmlspecialchars($student->getName()) : ''; ?>" required>
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
               value="<?= $student->getSurname() ? htmlspecialchars($student->getSurname()) : ''; ?>" required>
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
               value="<?= $student->getGroupName() ? htmlspecialchars($student->getGroupName()) : ''; ?>" required>
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
               value="<?= $student->getBalli() ? htmlspecialchars($student->getBalli()) : ''; ?>" required>
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
               value="<?= $student->getEmail() ? htmlspecialchars($student->getEmail()) : ''; ?>" required>
    </div>
    <?php if (isset($errors['email_error'])) : ?>
        <div class="col-6">
            <span class="text-danger"><?= isset($errors['email_error']) ? htmlspecialchars($errors['email_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>


<div class="row align-items-end mt-4">
    <div class="col-6">

        <label class="label" for="gender">Gender:</label>


        <select class="profile-form-select float-left" name="gender">
            <option>. . .</option>
            <option value="m" <?= $student->getGender() == "m" ? "selected" : "" ?>>Male</option>
            <option value="f" <?= $student->getGender() == "f" ? "selected" : "" ?>>Female</option>
        </select>

    </div>
    <?php if (isset($errors['gender_error'])) : ?>
        <div class="col-6 ">
            <span class="text-danger"><?= isset($errors['gender_error']) ? htmlspecialchars($errors['gender_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>

<div class="row mt-4">
    <input type="hidden" name="token" value=<?= $token ?>>
    <?php if (isset($errors['token_error'])) : ?>
        <div class="col-12 ">
<span
        class="text-danger align-middle"><?= isset($errors['token_error']) ? htmlspecialchars($errors['token_error']) : ''; ?></span><br>
        </div>
    <?php endif; ?>
</div>
<button type="submit" class="btn btn-primary" name="submit">Submit
</button>
</div>
</form>

<a id="btn" class="btn btn-primary btn-block" href="/">back to main</a>
</div>
