<html>
    
<head>
    <style type="text/css">

    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    </style>
</head>

<body>

    <?= session()->getFlashdata('error') ?>
    <?php 
    //echo validation_list_errors() 
    ?>

    <form action="/otp/retrieve" method="post">
        <?= csrf_field() ?>

        <label for="email">Email</label>
        <input type="input" name="email" value="<?= set_value('email') ?>">
        <p>

        <label for="firstname">First Name</label>
        <input type="input" name="firstname" value="<?= set_value('firstname') ?>">
        <p>

        <label for="lastname">Last Name</label>
        <input type="input" name="lastname" value="<?= set_value('lastname') ?>">
        <p>

        <input type="submit" name="submit" value="Get new password">
    </form>

</body>

</html>

