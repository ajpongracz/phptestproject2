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

    <p><?= 'Your new password is below. Please copy it down before the timer expires.' ?></p>

    <p><?= "This page will close in: " ?>

    <p id="countdown"></p>

    <script>
    let timeLeft = 5;
    const countdownElement = document.getElementById('countdown');
    countdownElement.style.color = "red";

    const intervalId = setInterval(() => {
    if (timeLeft < 0) {
        clearInterval(intervalId);
        countdownElement.textContent = "Page closing.";
    } else {
        countdownElement.textContent = timeLeft + " seconds";
        timeLeft--;
    }
    }, 1000); // 1000 milliseconds = 1 second
    </script>

    <?= "New password:"?>
    <div style="background-color: green;">
    <p><?= $newpassword ?></p>
    </div>

    <script>
            setTimeout(function() {
                window.location.href="https://phptestproject2.ddev.site/otp/expired";
            }, 5000);
    </script>

</body>

</html>