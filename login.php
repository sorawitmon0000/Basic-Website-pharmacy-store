<?php include('server.php');?>
<html>
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>PrakitPharmacy Login page</title>
    <link rel="stylesheet" href="login-style.css">
</head>

<body>
    <fieldset>
        <form action="server.php" method="POST">
            <h1><i class="fas fa-heart" style="font-size:30px;color:#FF9C9F"></i>LOGIN<i class="fas fa-heart" style="font-size:30px;color:#FF9C9F"></i></h1>
            <input type="text" name="username" placeholder="username" require><br>
            <input type="password" name="password" placeholder="password" require><br>
            <input type="submit" name="login_user" value="Login" id="login-btn">
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="error">
                    <h3>
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>
            <p>ยังไม่เป็นสมาชิก ? <a href="register.php">Sign up</a></p>
            <p>กลับสู่หน้าหลัก <a href="index.php">คลิกที่นี่</a></p>
    </fieldset>
    </form>
</body>

</html>