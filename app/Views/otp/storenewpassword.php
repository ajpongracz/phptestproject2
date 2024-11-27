<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/otp" method="post">
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

    <label for="newpassword">New Password</label>
    <input type="input" name="newpassword" value="<?= set_value('newpassword') ?>">
    <br>

    <input type="submit" name="submit" value="Store new password">
</form>