
<form  method="post" class = "border border-light">
  <p class="h4 mb-4 text-center">Profile</p>
<div class="row row mt-5">
  <div class="col-lg-6 ">
    <label class = "label" for="">Name:</label>
<input id="inputLGEx" class="form-control " type="text" name="name"  value="<?=$student['name'];?>">
  </div>
  <div class="col-lg-6">
 <span class ="text-danger"><?= $errors['name_error']; ?></span>
  </div>
</div>
<div class="row mt-5">
  <div class="col-lg-6">
  <label class = "label" for="">Surname:</label>
    <input id="inputLGEx" class="form-control " type="text" name="surname" value=<?=$student['surname']?>>
  </div>
  <div class="col-lg-6">
<span class ="text-danger"><?= $errors['surname_error']; ?></span><br>
  </div>
</div>
<div class="row  mt-5">
  <div class="col-lg-6">
      <label class = "label" for="">Group:</label>
<input id="inputLGEx" class="form-control " type="text" name="group" value=<?=$student['groupa']?>>
  </div>
  <div class="col-lg-6">
<span class ="text-danger"><?= $errors['group_error']; ?></span><br>
  </div>
</div>
<div class="row  mt-5">
  <div class="col-lg-6">
      <label class = "label" for="">Ege:</label>
<input  id="inputLGEx" class="form-control "  type="number" name="balli" value=<?=$student['balli'] ?>>
  </div>
  <div class="col-lg-6">
<span class ="text-danger"><?= $errors['balli_error']; ?></span><br>
  </div>
</div>
<div class="row mt-5">
  <div class="col-lg-6">
      <label class = "label" for="">Email:</label>
<input id="inputLGEx" class="form-control " type="email" name="email" value=<?=$student['email'] ?>>
  </div>
  <div class="col-lg-6">
<span class ="text-danger"><?= $errors['email_error']; ?></span><br>
  </div>
</div>
<div class="row  mt-5">
  <div class="col-lg-6">
    <input type="radio" name="gender" value="female" checked = <?=($result['female']==1) ? 'checked': false?>>
    <label class="h6" for="gender">Female</label>
    <input type="radio" name="gender" value="male" checked=<?=($result['male']==1) ? 'checked': false?>>
    <label class="h6" for="gender">Male</label>
  </div>
  <div class="col-lg-6">
<span class ="text-danger"><?= $errors['gender_error']; ?></span><br>
  </div>
</div>










<button type="submit" class="btn btn-primary btn-rounded"  name="submit">Otpravit</button>
</form>
