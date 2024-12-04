

<?= session()->getFlashdata('error') ?>
<?php 
//echo validation_list_errors() 
?>

<form action="/otp/retrieve" method="post">
    <?= csrf_field() ?>

    <label for="email">Email</label>
    <input type="input" name="email" value="<?= set_value('email') ?>">
    <br>

    <label for="firstname">First Name</label>
    <input type="input" name="firstname" value="<?= set_value('firstname') ?>">
    <br>

    <label for="lastname">Last Name</label>
    <input type="input" name="lastname" value="<?= set_value('lastname') ?>">
    <br>

    <input type="submit" name="submit" value="Get new password">
</form>