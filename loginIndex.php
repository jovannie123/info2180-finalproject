<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in Page</title>
    <link rel="stylesheet" href="login.css">
    <h1>Dolphin CRM</h1>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post" >
            <label for="email">Email address:</label>
            <input id="emailInput" type="text" id="email" name="email"><br><br>
            <label for="pword">Password:</label>
            <input id="pwdInput" type="password" id="pword" name="pword"><br><br>
            <input id="loginBtn" type="submit" value="Login">
        </form>
        <p id="message"></p>
    </div>

</body>
<footer> Copyright &copy; 2023 Dolphin CRM</footer>
</html>
