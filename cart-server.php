<?php
    $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
    $stmt = $pdo->prepare("SELECT SUM(quantity) AS total FROM item WHERE pid = ? AND username = ?;");
    $stmt->bindParam(1, $_GET["pid"]);
    $stmt->bindParam(2, $_GET["username"]);
    $stmt->execute();
    $check = $stmt->fetch();
    if($_GET["action"]=='add'){
        $update = $pdo->prepare("UPDATE item SET quantity = quantity + 1
                                WHERE pid = ? AND username = ?;");
        $update->bindParam(1, $_GET["pid"]);
        $update->bindParam(2, $_GET["username"]);
        $update->execute();
        header("location: cart.php");
    }
    
    else if($_GET["action"]=='pop' && $check['total']!=1){ //pop
        $update = $pdo->prepare("UPDATE item SET quantity = quantity - 1
                                WHERE pid = ? AND username = ?;");
        $update->bindParam(1, $_GET["pid"]);
        $update->bindParam(2, $_GET["username"]);
        $update->execute();
        header("location: cart.php");
    }

    else{ //delete
        $update = $pdo->prepare("DELETE FROM item WHERE pid = ? AND username = ?;");
        $update->bindParam(1, $_GET["pid"]);
        $update->bindParam(2, $_GET["username"]);
        $update->execute();
        header("location: cart.php");
    }
    
?>