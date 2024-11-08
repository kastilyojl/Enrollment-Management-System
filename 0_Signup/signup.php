<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<body>
    <h1>Signup</h1>
    <!--http://localhost/PROJECT%201.0/ENROLLMENT-V2/9_Signup/signup.html-->

    <form action="../0_Signup/p-signup.php" method="post" novalidate>
        <div>
            <label for="email">email</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="confirm_password">Repeat Password</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <div>
            <label for="user_type">User Type: [1-superadmin, 2-accounting, 3-registrar, 4-professor, 5-student]</label>
            <input type="number" min="1" max="5" id="user_type" name="user_type">
        </div>

        <button type="submit">Signup</button>
    </form>
</body>

</html>