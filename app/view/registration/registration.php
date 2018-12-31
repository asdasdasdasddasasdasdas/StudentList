<form  method="post" class = "border border-light">
  <p class="h4 mb-4">Registration</p>
  <div class="row">

  </div>
  <div class="row mt-5">

<div class="col-lg-6">
  <input type="text" class="form-control" name="name" placeholder="Name">
</div>

<div class="col-lg-6 text center">
<span class="text-danger"><?= $errors['name_error']; ?></span>
</div>
  </div>
  <div class="row mt-5">
<div class="col-lg-6">
  <input type="text" class="form-control" name="surname" placeholder="Surname">
</div>
<div class="col-lg-6">
  <span class="text-danger"><?= $errors['surname_error']; ?></span><br>
</div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <input type="text" class="form-control" name="group" placeholder="Group">
    </div>
    <div class="col-lg-6 test">
<span class="text-danger"><?= $errors['group_error']; ?></span><br>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <input type="number" class="form-control" name="balli" placeholder="Ege">
    </div>
    <div class="col-lg-6">
<span class="text-danger"><?= $errors['balli_error']; ?></span><br>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="col-lg-6">
<span class="text-danger"><?= $errors['email_error']; ?></span><br>
    </div>
  </div>
  <div class="row mt-5">
<div class="col-lg-6 mt-4">
  <input type="radio" name="gender" value="female">
  <label for="gender">Female</label>
  <input type="radio" name="gender" value="male">
  <label for="gender">Male</label>
</div>
<div class="col-lg-6 ">
<span class="text-danger mt-4"><?= $errors['gender_error']; ?></span><br>
</div>
  </div>





<button type="submit" class="btn mt-5 btn-primary" name="submit">Submit</button>
</form>
