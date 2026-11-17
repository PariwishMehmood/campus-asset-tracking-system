<?php
include 'db_connect.php';

$success = "";
$error = "";

/* Get assets */
$assetQuery = "
    SELECT Asset_ID, Asset_Name
    FROM Asset
    WHERE Status = 'Available'
    ORDER BY Asset_Name
";

$assetResult = sqlsrv_query($conn, $assetQuery);

/* Get employees */
$employeeQuery = "
    SELECT Employee_ID, Employee_Name
    FROM Employee
    ORDER BY Employee_Name
";

$employeeResult = sqlsrv_query($conn, $employeeQuery);


/* Add assignment */

if (isset($_POST['submit'])) {

    $asset = $_POST['asset_id'];
    $employee = $_POST['employee_id'];
    $assignmentDate = $_POST['assignment_date'];

    $sql = "
        INSERT INTO Asset_Assignment
        (Asset_ID, Employee_ID, Assignment_Date)
        VALUES (?, ?, ?)
    ";

    $params = [
        $asset,
        $employee,
        $assignmentDate
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {

        $success = "Asset assignment added successfully!";

        /* Update asset status */
        $updateSql = "
            UPDATE Asset
            SET Status = 'Assigned'
            WHERE Asset_ID = ?
        ";

        sqlsrv_query($conn, $updateSql, [$asset]);

    } else {

        $error = "Unable to add assignment.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Assignment | Campus Asset Tracking System</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>


<!-- Sidebar -->

<aside class="sidebar">

    <div class="sidebar-logo">

        <div class="logo-icon">CA</div>

        <div>
            <h2>Campus Asset</h2>
            <span>Tracking System</span>
        </div>

    </div>


    <nav class="sidebar-nav">

        <a href="index.php">
            <span>▦</span>
            Dashboard
        </a>

        <a href="view_assets.php">
            <span>📋</span>
            View Assets
        </a>

        <a href="add_asset.php">
            <span>＋</span>
            Add Asset
        </a>

        <a href="assignments.php">
            <span>👥</span>
            Assignments
        </a>

        <a href="maintenance.php">
            <span>🔧</span>
            Maintenance
        </a>

    </nav>


    <div class="sidebar-bottom">

        <p>Campus Asset</p>
        <span>Management Portal</span>

    </div>

</aside>



<!-- Main Content -->

<main class="main-content">


    <div class="page-top">

        <div>

            <p class="page-label">
                ASSET MANAGEMENT
            </p>

            <h1>
                Add Assignment
            </h1>

            <p class="page-description">
                Assign a campus asset to an employee.
            </p>

        </div>

    </div>



    <!-- Assignment Form -->

    <section class="asset-form-section">


        <div class="form-header">

            <h2>
                Assignment Information
            </h2>

            <p>
                Select an asset and employee to create an assignment.
            </p>

        </div>



        <?php if ($success != "") { ?>

            <div class="success-message">
                <?php echo $success; ?>
            </div>

        <?php } ?>


        <?php if ($error != "") { ?>

            <div class="error-message">
                <?php echo $error; ?>
            </div>

        <?php } ?>



        <form
            method="POST"
            class="asset-form"
        >


            <div class="form-grid">


                <!-- Asset -->

                <div class="form-group">

                    <label>
                        Asset
                    </label>

                    <select
                        name="asset_id"
                        required
                    >

                        <option value="">
                            Select asset
                        </option>


                        <?php

                        if ($assetResult) {

                            while (
                                $assetRow =
                                sqlsrv_fetch_array(
                                    $assetResult,
                                    SQLSRV_FETCH_ASSOC
                                )
                            ) {

                                echo '<option value="' .
                                    $assetRow['Asset_ID'] .
                                    '">' .
                                    htmlspecialchars(
                                        $assetRow['Asset_Name']
                                    ) .
                                    ' (ID ' .
                                    $assetRow['Asset_ID'] .
                                    ')</option>';
                            }
                        }

                        ?>

                    </select>

                </div>



                <!-- Employee -->

                <div class="form-group">

                    <label>
                        Employee
                    </label>

                    <select
                        name="employee_id"
                        required
                    >

                        <option value="">
                            Select employee
                        </option>


                        <?php

                        if ($employeeResult) {

                            while (
                                $employeeRow =
                                sqlsrv_fetch_array(
                                    $employeeResult,
                                    SQLSRV_FETCH_ASSOC
                                )
                            ) {

                                echo '<option value="' .
                                    $employeeRow['Employee_ID'] .
                                    '">' .
                                    htmlspecialchars(
                                        $employeeRow['Employee_Name']
                                    ) .
                                    ' (ID ' .
                                    $employeeRow['Employee_ID'] .
                                    ')</option>';
                            }
                        }

                        ?>

                    </select>

                </div>



                <!-- Assignment Date -->

                <div class="form-group">

                    <label>
                        Assignment Date
                    </label>

                    <input
                        type="date"
                        name="assignment_date"
                        required
                    >

                </div>


            </div>



            <div class="form-actions">

                <button
                    type="submit"
                    name="submit"
                    class="primary-button"
                >
                    + Assign Asset
                </button>

            </div>


        </form>


    </section>


</main>


</body>

</html>