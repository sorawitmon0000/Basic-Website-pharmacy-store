<?php session_start();
$pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
$stmt = $pdo->prepare("SELECT product.pid,product.pname,product.price,SUM(quantity) AS total
                        FROM item JOIN product ON item.pid=product.pid 
                        WHERE username='$_SESSION[username]' GROUP BY pid;");
$stmt->execute();

$stmt1 = $pdo->prepare("SELECT SUM(quantity) AS total_item, product.price AS total_price FROM item JOIN product ON item.pid=product.pid WHERE username='$_SESSION[username]' GROUP BY item.pid;");
$stmt1->execute();
$totalprice = 0;
while ($price = $stmt1->fetch()){
    $totalprice += $price['total_item'] * $price['total_price'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <style>
        .button {
            display: inline-flex;
            background-color: #6996F6;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            font-size: 10px;
            cursor: pointer;
            margin: 10px;
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            
        }
        
        .button:hover {
            background-color: #5E4CF4;
        }

        a {
            text-decoration: none;
            font-size: medium;
            color: black;
            
        }
        .table1 {
            margin-left: auto;
            margin-right: auto;
        }

        td{
            padding: 10px;
        }
        

    </style>
</head>

<body>
    <table border="1">
        <?php
        $sum = 0;
        while ($row = $stmt->fetch()) :
        ?>
            <tr>
                <td><img src='product_photo/<?= $row["pid"] ?>.jpg' width='100'></td>
                <td>ชื่อสินค้า : <?= $row["pname"] ?></td>
                <td>ราคา : <?= $row["price"] ?></td>
                <td>จำนวนสินค้าในตะกร้า : <?= $row["total"] ?></td>
                <td>
                    <a href="cart-server.php?pid=<?= $row["pid"] ?>&username=<?= $_SESSION["username"] ?>&action=add">
                    <div class="button" style="margin: 0px;">
                        +
                    </div>
                    </a>
                    <a href="cart-server.php?pid=<?= $row["pid"] ?>&username=<?= $_SESSION["username"] ?>&action=pop">
                    <div class="button" style="margin: 0px;">
                        -
                    </div>
                    </a>
                    <a href="cart-server.php?pid=<?= $row["pid"] ?>&username=<?= $_SESSION["username"] ?>&action=delete">
                    <div class="button">
                        นำออกจากตะกร้า
                    </div>
                    </a>
            </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="5" align="right">รวม <?= $totalprice ?> บาท</td>
        </tr>
    </table>

    <a href="index.php">
        < เลือกสินค้าต่อ</a>
</body>

</html>