<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Invalid assignment ID.");
}

$assignment_id = $_GET['id'];

/* Get the assignment */
$sql = "
    SELECT Asset_ID
    FROM Asset_Assignment
    WHERE Assignment_ID = ?
";

$stmt = sqlsrv_query($conn, $sql, [$assignment_id]);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$row) {
    die("Assignment not found.");
}

$asset_id = $row['Asset_ID'];

/* Mark the asset as returned */
$sql = "
    UPDATE Asset_Assignment
    SET Return_Date = GETDATE()
    WHERE Assignment_ID = ?
";

$stmt = sqlsrv_query($conn, $sql, [$assignment_id]);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

/* Make the asset available again */
$sql = "
    UPDATE Asset
    SET Status = 'Available'
    WHERE Asset_ID = ?
";

$stmt = sqlsrv_query($conn, $sql, [$asset_id]);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

/* Go back to assignments */
header("Location: assignments.php");
exit;
?>