<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter PIN</title>
</head>

<body>
    <h1>Enter PIN</h1>
    <form action="<?php echo site_url('twitterauth/process_pin'); ?>" method="post">
        <label for="pin">Enter the PIN code:</label><br>
        <input type="text" id="pin" name="pin" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>