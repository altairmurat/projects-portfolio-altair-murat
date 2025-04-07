<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Information Form</title>
    <link rel="stylesheet" href="purpleback.css">
</head>
<body>
    <h1>Submit HR Information</h1>
    <form action="hackregcomp.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        
        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname" required><br>
        
        <label for="telegram">Telegram:</label>
        <input type="text" id="telegram" name="telegram" required><br>
        
        <input type="submit" value="Submit">
    </form>

</body>
</html>