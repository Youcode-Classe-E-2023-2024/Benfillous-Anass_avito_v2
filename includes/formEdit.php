<?php
include("./config.php");
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $phone = $_POST["phone"];
    $id = $_POST["id"];

    include("./checker.php");
    foreach ($_POST as $key => $value) {
        if (htmlChecker($value)) {
            header("location: ../index.php?error=true");
            exit;
        }
    }
    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE announces SET title = ?, price = ?, descri = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $title, $price, $description, $phone, $id);

    if ($stmt->execute()) {
        echo "<script> console.log('Record updated successfully'); </script>";
    } else {
        echo "<script>console.log('Error updating record: ' . $stmt->error)</script>";
    }

    $stmt->close();
    $conn->close();
    if (isset($_GET["admin"]))
        header("location: ../admin/dashboard.php");
    else
        header("location:../index.php?updated=true");
}
