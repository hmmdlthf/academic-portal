<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>

    <link rel="stylesheet" href="/scss/style.css">
    <link rel="stylesheet" href="/scss/home.css">

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
</head>

<body>
    <div class="main">
        <div class="header__logo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
            </svg>
            <div class="logo__text">
                <div class="line">
                    Online
                </div>
                <div class="line">
                    Academy
                </div>
            </div>
        </div>
        <div class="title">
            Select Login
        </div>
        <div class="login__btns">
            <div class="login__btn">
                <button class="btn" onclick="document.location = '/admin/login/login.php'">Admin</button>
            </div>
            <div class="login__btn">
                <button class="btn" onclick="document.location = '/officer/login/login.php'">Officer</button>
            </div>
            <div class="login__btn">
                <button class="btn" onclick="document.location = '/student/login/login.php'">Student</button>
            </div>
            <div class="login__btn">
                <button class="btn" onclick="document.location = '/teacher/login/login.php'">Teacher</button>
            </div>
        </div>
        <script>
            function getColor() {
                let colors = ['']
            }
        </script>
    </div>

</body>

</html>