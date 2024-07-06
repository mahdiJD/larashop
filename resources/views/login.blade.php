<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #f1ebd3;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            color: #414141;
            margin: 0;
        }

        .login-form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            background-color: #f1ebd3;
            border: 1px solid #414141;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form label {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="text"], .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #414141;
        }

        .login-form input[type="submit"] {
            background-color: #414141;
            color: #f1ebd3;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #333;
        }

        .footer {
            background-color: #414141;
            padding: 10px;
            text-align: center;
            color: #f1ebd3;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Login Page</h1>
    </div>

    <div class="login-form">
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </div>

    <div class="footer">
        &copy; 2024 Login Page
    </div>
</body>
</html>
