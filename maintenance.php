<?php
include 'db_connect.php';

$sql = "
    SELECT
        m.Maintenance_ID,
        a.Asset_Name,
        m.Maintenance_Date,
        m.Description,
        m.Cost,
        m.Maintenance_Status
    FROM Maintenance m
    INNER JOIN Asset a
        ON m.Asset_ID = a.Asset_ID
    ORDER BY m.Maintenance_ID DESC
";

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

    <title>Maintenance | Campus Asset Tracking System</title>

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

            <a href="maintenance.php" class="active">
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

                <h1>Maintenance Records</h1>

                <p class="page-description">
                    View maintenance activities performed on campus assets.
                </p>

            </div>

        </div>


        <!-- Maintenance Table -->

        <section class="asset-table-section">

            <div class="table-header">

                <div>
                    <h2>Maintenance History</h2>

                    <p>
                        Complete record of asset maintenance activities
                    </p>
                </div>

            </div>


            <div class="table-container">

                <table class="asset-table">

                    <thead>

                        <tr>
                            <th>Maintenance ID</th>
                            <th>Asset Name</th>
                            <th>Maintenance Date</th>
                            <th>Description</th>
                            <th>Cost</th>
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
                        echo htmlspecialchars($row['Maintenance_ID']);
                        echo "</td>";

                        echo "<td class='asset-name'>";
                        echo htmlspecialchars($row['Asset_Name']);
                        echo "</td>";

                        echo "<td>";

                        if ($row['Maintenance_Date'] !== null) {
                            echo $row['Maintenance_Date']->format('Y-m-d');
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td>";
                        echo htmlspecialchars($row['Description']);
                        echo "</td>";

                        echo "<td class='price'>";

                        if ($row['Cost'] !== null) {
                            echo number_format(
                                (float)$row['Cost'],
                                2
                            );
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td>";

                        echo "<span class='status-badge'>";
                        echo htmlspecialchars($row['Maintenance_Status']);
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