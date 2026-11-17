<?php
include 'db_connect.php';

$sql = "
    SELECT 
        aa.Assignment_ID,
        a.Asset_Name,
        e.Employee_Name,
        aa.Assignment_Date,
        aa.Return_Date
    FROM Asset_Assignment aa
    INNER JOIN Asset a 
        ON aa.Asset_ID = a.Asset_ID
    INNER JOIN Employee e 
        ON aa.Employee_ID = e.Employee_ID
    ORDER BY aa.Assignment_ID DESC
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

    <title>Assignments | Campus Asset Tracking System</title>

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

            <a href="assignments.php" class="active">
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

                <h1>Asset Assignments</h1>

                <p class="page-description">
                    View assets assigned to campus employees.
                </p>

            </div>

        </div>


        <!-- Assignment Table -->

        <section class="asset-table-section">

            <div class="table-header">

                <div>
                    <h2>Assignment Records</h2>

                    <p>
                        Complete list of asset assignments
                    </p>
                </div>

            </div>


            <div class="table-container">

                <table class="asset-table">

                    <thead>

                        <tr>
                            <th>Assignment ID</th>
                            <th>Asset Name</th>
                            <th>Employee Name</th>
                            <th>Assignment Date</th>
                            <th>Return Date</th>
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
                        echo htmlspecialchars($row['Assignment_ID']);
                        echo "</td>";

                        echo "<td class='asset-name'>";
                        echo htmlspecialchars($row['Asset_Name']);
                        echo "</td>";

                        echo "<td>";
                        echo htmlspecialchars($row['Employee_Name']);
                        echo "</td>";

                        echo "<td>";

                        if ($row['Assignment_Date'] !== null) {
                            echo $row['Assignment_Date']->format('Y-m-d');
                        } else {
                            echo "-";
                        }

                        echo "</td>";

                        echo "<td>";

                        if ($row['Return_Date'] !== null) {
                            echo $row['Return_Date']->format('Y-m-d');
                        } else {
                            echo "-";
                        }

                        echo "<td>";

$status = ($row['Return_Date'] === null) ? "Active" : "Returned";

echo "<span class='status-badge'>";
echo $status;
echo "</span>";

if ($status == "Active") {
    echo "<a href='return_asset.php?id=" . $row['Assignment_ID'] . "' class='return-button'>";
    echo "Return";
    echo "</a>";
}

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