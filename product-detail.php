<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
$stmt = $pdo->prepare("SELECT * FROM product JOIN typeproduct ON product.pname=typeproduct.pname WHERE pid = ?");
$stmt->bindParam(1, $_GET["pid"]);
$stmt->execute();
$column = $stmt->fetch();
?>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $column["pname"] ?>, PrakitPharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pdetail.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body>
    <header>
        <div class="header">
            <div class="btn-group">
            <a href="index.php" class="navbar-brand"><i class="fas fa-medkit"> Prakit Pharmacy</i></a>
                <?php if (!empty($_SESSION["username"])) { ?>
                    <a href="cart.php">
                        <div class="button" id="add">cart
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
    <section>
        <div class="flex">
            <div>
                <img src='product_photo/<?= $column["pid"] ?>.jpg'>
            </div>
            <div class="detail">
                <div class="text"><br>
                    <p><?= $column["pname"] ?><br>
                        <?= $column["pdetail"] ?><br>
                        ประเภทสินค้าตามกลุ่ม : <?= $column["typebygroup"] ?><br>
                        ประเภทสินค้าตามการใช้ : <?= $column["typebyuse"] ?><br>
                        ราคา : <?= $column["price"] ?> บาท</p><br>
                </div>
                <?php if(!empty($_SESSION["username"])){ ?>
                <a href="AddCart.php?pid=<?= $column["pid"] ?>&username=<?= $_SESSION["username"]?>">
                    <!--ไว้เพิ่มสินค้าไปที่ cart ภายหลัง-->
                    <div class="cart-btn">Add to cart</div>
                </a>
                <?php }
                else {?>
                <a href="login.php">
                    <!--ไว้เพิ่มสินค้าไปที่ cart ภายหลัง-->
                    <div class="cart-btn">Add to cart</div>
                </a>
                <?php }?>
            </div>
        </div>
    </section>
</body>

</html>