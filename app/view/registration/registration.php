
<form  method="post" action="/registration/store" class = "border border-light">
  <p class="h4 mb-4">Registration </p>
  <div class="row">

  </div>
  <div class="row mt-5">

<div class="col-lg-6">
  <label class = "label" for="">Name:</label>

  <input type="text" class="form-control" name="name" placeholder="Name" value="<?=$_SESSION['post']['name'] ?>">
</div>

<div class="col-lg-6 text center">
<span class="text-danger"><?= $_SESSION['errors']['name_error']; ?></span>
</div>
  </div>
  <div class="row mt-5">
<div class="col-lg-6">
  <label class = "label" for="">Surname:</label>
  <input type="text" class="form-control" name="surname" placeholder="Surname" value="<?=$_SESSION['post']['surname'] ?>">
</div>
<div class="col-lg-6">
  <span class="text-danger"><?= $_SESSION['errors']['surname_error']; ?></span><br>
</div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <label class = "label" for="">Group:</label>
      <input type="text" class="form-control" name="group" placeholder="Group" value="<?=$_SESSION['post']['group'] ?>">
    </div>
    <div class="col-lg-6 test">
<span class="text-danger"><?= $_SESSION['errors']['group_error']; ?></span><br>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <label class = "label" for="">Ege:</label>
      <input type="number" class="form-control" name="balli" placeholder="Ege" >
    </div>
    <div class="col-lg-6">
<span class="text-danger"><?= $_SESSION['errors']['balli_error']; ?></span><br>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col-lg-6">
      <label class = "label" for="">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Email" value="<?=$_SESSION['post']['email'] ?>">
    </div>
    <div class="col-lg-6">
<span class="text-danger"><?= $_SESSION['errors']['email_error']; ?></span><br>
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
<span class="text-danger mt-4"><?= $_SESSION['errors']['gender_error']; ?></span><br>
</div>
  </div>





<button type="submit" class="btn mt-5 btn-primary" name="submit">Submit</button>
</form>
