<?php
$numi = 0;
$pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
$check = $_GET["search"];
if ($check == 0 or empty($check)) {
    $stmt = $pdo->prepare("SELECT * FROM product JOIN typeproduct ON product.pname=typeproduct.pname ORDER BY RAND() LIMIT 4");
    $stmt->execute();
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
        <?php endwhile;
} else {
    $stmt = $pdo->prepare("SELECT product.*,typeproduct.*,SUM(quantity) FROM item
                            JOIN product ON item.pid=product.pid 
                            JOIN typeproduct ON product.pname=typeproduct.pname
                            GROUP BY pid ORDER BY SUM(quantity) DESC LIMIT 4;");
    $stmt->execute();
    while ($row = $stmt->fetch()) :
        $numi = $numi + 1;
    ?>
        <a href="product-detail.php?pid=<?= $row["pid"] ?>">
            <div class="flexible">
                <h2> อันดับที่ <?= $numi ?></h2>
                <img src='product_photo/<?= $row["pid"] ?>.jpg' width='100'><br>
                ชื่อสินค้า : <?= $row["pname"] ?><br>
                รายละเอียดสินค้า : <?= $row["pdetail"] ?><br>
                ประเภทสินค้าตามกลุ่ม : <?= $row["typebygroup"] ?><br>
                ประเภทสินค้าตามการใช้ : <?= $row["typebyuse"] ?><br>
            </div>
        </a>
    <?php endwhile;
} ?>