<?php
session_start();
if (empty($_SESSION["username"])) {
    header("location: login.php");
}
$params = session_get_cookie_params();
setcookie(session_name(),'',time() - 3600,);

session_destroy();
?>

ออกจากระบบสำเร็จแล้ว<br>
หากต้องการเข้าสู่ระบบอีกครั้งโปรดคลิก
<a href='login.php'>เข้าสู่ระบบ</a>