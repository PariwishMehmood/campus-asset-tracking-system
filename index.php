<?php
include 'db_connect.php';

/* Get total assets */
$totalAssets = 0;
$result = sqlsrv_query($conn, "SELECT COUNT(*) AS Total FROM Asset");

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $totalAssets = $row['Total'];
}

/* Get available assets */
$availableAssets = 0;
$result = sqlsrv_query(
    $conn,
    "SELECT COUNT(*) AS Total FROM Asset WHERE Status = 'Available'"
);

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $availableAssets = $row['Total'];
}

/* Get assigned assets */
$assignedAssets = 0;
$result = sqlsrv_query(
    $conn,
    "SELECT COUNT(*) AS Total FROM Asset WHERE Status = 'Assigned'"
);

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $assignedAssets = $row['Total'];
}

/* Get assets under maintenance */
$maintenanceAssets = 0;
$result = sqlsrv_query(
    $conn,
    "SELECT COUNT(*) AS Total FROM Asset WHERE Status = 'Under Maintenance'"
);

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $maintenanceAssets = $row['Total'];
}

/* Get damaged assets */
$damagedAssets = 0;
$result = sqlsrv_query(
    $conn,
    "SELECT COUNT(*) AS Total FROM Asset WHERE Status = 'Damaged'"
);

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $damagedAssets = $row['Total'];
}

/* Get number of categories */
$totalCategories = 0;
$result = sqlsrv_query(
    $conn,
    "SELECT COUNT(DISTINCT Category) AS Total FROM Asset"
);

if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $totalCategories = $row['Total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Campus Asset Tracking System</title>

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

            <a href="index.php" class="active">
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

        <!-- Welcome -->

        <section class="welcome-section">

            <div>

                <p class="page-label">CAMPUS MANAGEMENT</p>

                <h2>Asset Management Dashboard</h2>

                <p class="welcome-text">
                    Monitor, manage and track all campus assets from one central system.
                </p>

            </div>


            <a href="add_asset.php" class="primary-button">
                + Add New Asset
            </a>

        </section>


        <!-- Statistics -->

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon">📦</div>

                <div>
                    <p>Total Assets</p>
                    <h3><?php echo $totalAssets; ?></h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">✓</div>

                <div>
                    <p>Available</p>
                    <h3><?php echo $availableAssets; ?></h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">👤</div>

                <div>
                    <p>Assigned</p>
                    <h3><?php echo $assignedAssets; ?></h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">🔧</div>

                <div>
                    <p>Maintenance</p>
                    <h3><?php echo $maintenanceAssets; ?></h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">⚠</div>

                <div>
                    <p>Damaged</p>
                    <h3><?php echo $damagedAssets; ?></h3>
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">▦</div>

                <div>
                    <p>Categories</p>
                    <h3><?php echo $totalCategories; ?></h3>
                </div>

            </div>

        </section>


        <!-- Quick Actions -->

        <section class="dashboard-section">

            <div class="section-heading">

                <div>

                    <h2>Quick Actions</h2>

                    <p>
                        Manage your campus assets efficiently.
                    </p>

                </div>

            </div>


            <div class="quick-actions">

                <a href="view_assets.php" class="action-card">

                    <span class="action-icon">📋</span>

                    <div>

                        <h3>View Assets</h3>

                        <p>
                            Browse all campus assets by category.
                        </p>

                    </div>

                </a>


                <a href="add_asset.php" class="action-card">

                    <span class="action-icon">➕</span>

                    <div>

                        <h3>Add Asset</h3>

                        <p>
                            Register a new campus asset.
                        </p>

                    </div>

                </a>


                <a href="assignments.php" class="action-card">

                    <span class="action-icon">👥</span>

                    <div>

                        <h3>Assignments</h3>

                        <p>
                            Track assets assigned to employees.
                        </p>

                    </div>

                </a>


                <a href="maintenance.php" class="action-card">

                    <span class="action-icon">🔧</span>

                    <div>

                        <h3>Maintenance</h3>

                        <p>
                            View asset maintenance records.
                        </p>

                    </div>

                </a>

            </div>

        </section>


        <!-- Category Overview -->

        <section class="dashboard-section">

            <div class="section-heading">

                <div>

                    <h2>Asset Categories</h2>

                    <p>
                        Assets currently registered in the system.
                    </p>

                </div>

            </div>


            <div class="category-grid">

                <?php

                $categoryQuery = "
                    SELECT Category, COUNT(*) AS Total
                    FROM Asset
                    GROUP BY Category
                    ORDER BY Category
                ";

                $categoryResult = sqlsrv_query(
                    $conn,
                    $categoryQuery
                );

                if ($categoryResult) {

                    while ($category = sqlsrv_fetch_array(
                        $categoryResult,
                        SQLSRV_FETCH_ASSOC
                    )) {

                        echo '
                        <div class="category-card">

                            <div class="category-icon">▦</div>

                            <div>

                                <h3>' .
                                htmlspecialchars($category['Category']) .
                                '</h3>

                                <p>' .
                                $category['Total'] .
                                ' assets</p>

                            </div>

                        </div>
                        ';
                    }
                }

                ?>

            </div>

        </section>

    </main>

</body>

</html>