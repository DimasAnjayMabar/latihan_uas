<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require('includes/head.php');
    ?>
    <style>
        .error{
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <nav class="container" style="margin-top: 15%;">
        <nav class="container" style="background-color: black; text-align: center;">
            <h1 style="color: white; margin-top: 2%;" class="">LOGIN</h1>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label" style="color: white;">Username</label>
                    <input type="username" class="form-control" id="username">
                    <div class="error" id="usernameError"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label" style="color: white;">Password</label>
                    <input type="password" class="form-control" id="password">
                    <div class="error" id="passError"></div>
                </div>
                <a class="btn btn-primary" onclick="login(event)" style="margin-bottom: 2%;">Login</a>
            </form>
        </nav>
    </nav>

    <?php
        require('includes/foot.php');
        require('script/login.php');
    ?>
</body>
</html>