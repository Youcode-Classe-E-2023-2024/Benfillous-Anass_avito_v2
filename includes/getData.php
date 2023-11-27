<?php
function getData($table)
{
    include "config.php";
    $query = "SELECT * FROM $table";
    $result = $conn->query($query);
    $output = array();

    if (!$result) {
        die("Error: " . mysqli_error($connect));
    }

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    }

    return $output;
}


function getSpecificData($table, $id) {
    include "config.php";
    $query = "SELECT * FROM $table WHERE user_id = '$id'";
    $result = $conn->query($query);
    $output = array();

    if (!$result) {
        die("Error: " . mysqli_error($connect));
    }

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    }

    return $output;
}
?>