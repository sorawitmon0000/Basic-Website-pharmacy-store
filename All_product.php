<?php
$numi = 0;
$perpage = 4;
$pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
$con = mysqli_connect('localhost', 'root', '', 'blueshop');
$sql = "SELECT * FROM product";
$query = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($query);
$total_page = ceil($total_record / $perpage);
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;
$stmt = $pdo->prepare("SELECT * FROM product JOIN typeproduct ON product.pname=typeproduct.pname LIMIT {$start} , {$perpage}");
$stmt->execute();
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>หน้าหลัก</title>
</head>

<body>

    <!---- ส่วนหัวของหน้าเว็บ ---->

    <header>
        <div class="header">
            <div class="btn-group">
                <a href="index.php" class="navbar-brand"><i class="fas fa-medkit"> Prakit Pharmacy</i></a>
                <?php if (!empty($_SESSION["username"])) { ?>
                    <a href="cart.php">
                        <div class="button">cart
                            <?php
                            $mysql = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
                            $s1 = $mysql->prepare("SELECT SUM(quantity) AS total FROM item WHERE username = ?;");
                            $s1->bindParam(1, $_SESSION["username"]);
                            $s1->execute();
                            $rr = $s1->fetch();
                            if ($rr['total'] != null) {
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
        <div id="row">
            <?php
            while ($row = $stmt->fetch()) :
            ?>
                <a href="product-detail.php?pid=<?= $row["pid"] ?>">
                    <div class="flexible">
                        <img src='product_photo/<?= $row["pid"] ?>.jpg' width='100'><br>
                        ชื่อสินค้า : <?= $row["pname"] ?><br>
                        รายละเอียดสินค้า : <?= $row["pdetail"] ?><br>
                        ประเภทสินค้าตามกลุ่ม : <?= $row["typebygroup"] ?><br>
                        ประเภทสินค้าตามการใช้ : <?= $row["typebyuse"] ?><br>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </section>

    <footer style="margin-left: 45%;">
        <a href="All_product.php?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        <?php for ($i = 1; $i <= $total_page; $i++) { ?><a href="All_product.php?page=<?php echo $i; ?>"><?= $i; ?></a>
        <?php } ?>
        <a href="All_product.php?page=<?php echo $total_page; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </footer>

</body>

</html>