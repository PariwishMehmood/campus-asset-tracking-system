<?php
include 'db_connect.php';

$success = "";
$error = "";

if (isset($_POST['submit'])) {

    $name = $_POST['asset_name'];
    $category = $_POST['category'];
    $date = $_POST['purchase_date'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier_id'];

    $sql = "INSERT INTO Asset
            (Asset_Name, Category, Purchase_Date, Price, Supplier_ID)
            VALUES (?, ?, ?, ?, ?)";

    $params = [
        $name,
        $category,
        $date,
        $price,
        $supplier
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        $success = "Asset added successfully!";
    } else {
        $error = "Unable to add asset.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Asset | Campus Asset Tracking System</title>

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

            <a href="add_asset.php" class="active">
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

                <h1>Add New Asset</h1>

                <p class="page-description">
                    Register a new asset in the campus inventory.
                </p>

            </div>

        </div>


        <!-- Add Asset Form -->

        <section class="asset-form-section">

            <div class="form-header">

                <h2>Asset Information</h2>

                <p>
                    Enter the details of the asset below.
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


            <form method="POST" class="asset-form">

                <div class="form-grid">

                    <div class="form-group">

                        <label>Asset Name</label>

                        <input
                            type="text"
                            name="asset_name"
                            placeholder="Enter asset name"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Category</label>

                        <select name="category" required>

                            <option value="">Select category</option>

                            <option value="Electronics">
                                Electronics
                            </option>

                            <option value="Books">
                                Books
                            </option>

                            <option value="Furniture">
                                Furniture
                            </option>

                            <option value="Laboratory Equipment">
                                Laboratory Equipment
                            </option>

                            <option value="Sports Equipment">
                                Sports Equipment
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label>Purchase Date</label>

                        <input
                            type="date"
                            name="purchase_date"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Price</label>

                        <input
                            type="number"
                            name="price"
                            step="0.01"
                            placeholder="Enter price"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>Supplier ID</label>

                        <input
                            type="number"
                            name="supplier_id"
                            placeholder="Enter supplier ID"
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
                        + Add Asset
                    </button>

                </div>

            </form>

        </section>

    </main>

</body>

</html>