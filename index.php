<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>หน้าหลัก</title>
    <!--สคริป AJAX -->
    <script>
        function send(int) {
            httpRequest = new XMLHttpRequest();
            httpRequest.onload = function() {
                document.getElementById("row").innerHTML = this.responseText;
            }
            httpRequest.open("GET", "result.php?search=" + int);
            httpRequest.send();
        }
    //<!--สคริป AJAX -->

    //---------------JSON API Funtion--------------------
        async function getDataFromAPI() {
            let response = await fetch('http://localhost/project/jsondata.php')
            let rawData = await response.text() // อ่านผลลัพธ์
            let objectData = JSON.parse(rawData) // แปลผลลัพธ์เป็น object
            let result = document.getElementById('result') // ดึง <ul> เพื่อใช้ในการเพิ่มแท็ก <li>

            for (let i = 0; i < objectData.features.length; i++) {
                if (objectData.features[i].properties.rankReview == 5) {
                    let content = 'ชื่อร้าน :' + objectData.features[i].properties.name // ดึงข้อมูลจาก object
                    content += "  " + objectData.features[i].properties.address
                    let li = document.createElement('li') // สร้างแท็ก <li>
                    li.innerHTML = content // นำข้อมูลที่จัดแล้วมาไว้ในแท็ก <li>
                    result.appendChild(li) // เพิ่มแท็ก <li> ใหม่
                }

            }
        }
        getDataFromAPI() // เรียกฟังก์ชัน
        function gogo(){
            window.location.replace("All_product.php");
        }
    </script>
</head>

<body onload="send(0)">

    <!---- ส่วนหัวของหน้าเว็บ ---->

    <header>
        <div class="header">
            <div class="btn-group">
            <i class="fas fa-medkit navbar-brand"> Prakit Pharmacy</i>
                <?php if (!empty($_SESSION["username"])) { ?>
                    <a href="cart.php">
                        <div class="button">cart
                            <?php
                            $mysql = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
                            $s1 = $mysql->prepare("SELECT SUM(quantity) AS total FROM item WHERE username = ?;");
                            $s1->bindParam(1, $_SESSION["username"]);
                            $s1->execute();
                            $rr = $s1->fetch();
                            if($rr['total']!=null){
                                echo "(", $rr['total'], ")";
                            }
                            ?>
                        </div>
                    </a>
                    <a href="logout.php">
                        <div class="button">logout</div>
                    </a>
                <?php } else { ?>
                    <a href="login.php">
                        <div class="button">cart</div>
                    </a>
                    <a href="login.php">
                        <div class="button">login</div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </header>


    <!---- ส่วนสินค้า ---->
    <section>

        <!---- ปุ่มสำหรับเปลี่ยนมุมมองสินค้าแนะนำ / สินค้าขายดี ฝากจัดการ css ที แก้ไขที่ไฟล์ index-style.css ---->
        <input type="button" value="สินค้าแนะนำ" class="button1" onclick="send(0)">
        <input type="button" value="สินค้าทั้งหมด" class="button1" onclick="gogo()">
        <input type="button" value="สินค้าขายดี" class="button1" onclick="send(1)">
        <!---- จบส่วนปุ่ม ---->

        <div id="row">
            <!--ส่วนนี้หน้าสินค้าจาก result.php -->
        </div>
    </section>

    <!-- ไว้สำหรับ  JSON -->
    <footer>
        <h1>ร้านขายยา Prakrit Pharmacy แต่ละสาขาที่ได้รับการรีวิว 5 ดาว</h1>
        <ol id="result"></ol>
    </footer>

</body>

</html>