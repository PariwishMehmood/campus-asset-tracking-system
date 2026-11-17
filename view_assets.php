<?php
include 'db_connect.php';

$sql = "SELECT * FROM Asset";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Assets | Campus Asset Tracking System</title>

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

            <a href="view_assets.php" class="active">
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

                <p class="page-label">ASSET MANAGEMENT</p>

                <h1>Asset Records</h1>

                <p class="page-description">
                    View and manage all assets registered in the campus system.
                </p>

            </div>


            <a href="add_asset.php" class="primary-button">
                + Add New Asset
            </a>

        </div>


        <!-- Asset Table -->

        <section class="asset-table-section">

            <div class="table-header">

                <div>
                    <h2>All Assets</h2>

                    <p>
                        Complete list of campus assets
                    </p>
                </div>

            </div>


            <div class="table-container">

                <table class="asset-table">

                    <thead>

                        <tr>
                            <th>Asset ID</th>
                            <th>Asset Name</th>
                            <th>Category</th>
                            <th>Purchase Date</th>
                            <th>Price</th>
                            <th>Supplier ID</th>
                            <th>Status</th>
                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    while ($row = sqlsrv_fetch_array(
                        $stmt,
                        SQLSRV_FETCH_ASSOC
                    )) {

                        echo "<tr>";

                        echo "<td class='asset-id'>";
                        echo htmlspecialchars($row['Asset_ID']);
                        echo "</td>";

                        echo "<td class='asset-name'>";
                        echo htmlspecialchars($row['Asset_Name']);
                        echo "</td>";

                        echo "<td>";
                        echo htmlspecialchars($row['Category']);
                        echo "</td>";

                        echo "<td>";

                        if ($row['Purchase_Date'] !== null) {
                            echo $row['Purchase_Date']->format('Y-m-d');
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td class='price'>";

                        if ($row['Price'] !== null) {
                            echo number_format(
                                (float)$row['Price'],
                                2
                            );
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td>";

                        if ($row['Supplier_ID'] !== null) {
                            echo htmlspecialchars($row['Supplier_ID']);
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td>";

                        echo "<span class='status-badge'>";

                        echo htmlspecialchars($row['Status']);

                        echo "</span>";

                        echo "</td>";

                        echo "</tr>";
                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>

</html>