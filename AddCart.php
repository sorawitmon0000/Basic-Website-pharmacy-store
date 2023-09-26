<?php
    $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
    $stmt1 = $pdo->prepare("SELECT * FROM item WHERE pid = ? AND username = ?;");
    $stmt1->bindParam(1, $_GET["pid"]);
    $stmt1->bindParam(2, $_GET["username"]);
    $stmt1->execute();
    $check=$stmt1->fetch();
    if (empty($check)) {
        $stmt = $pdo->prepare("INSERT INTO item (username, pid, quantity) 
                                VALUES('$_GET[username]', '$_GET[pid]', 1)");
        $stmt->execute();
        header("location: product-detail.php?pid=$_GET[pid]");
    } 
    else{
        $update = $pdo->prepare("UPDATE item SET quantity = quantity + 1
                                WHERE pid = ? AND username = ?;");
        $update->bindParam(1, $_GET["pid"]);
        $update->bindParam(2, $_GET["username"]);
        $update->execute();
        header("location: product-detail.php?pid=$_GET[pid]");
    }
?>