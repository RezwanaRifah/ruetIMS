<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
require 'partials/_dbConnector.php';

$deleteSuccess = false;
$deleteError = null;

// Check if equipment ID is provided
if (isset($_GET['id'])) {
    $equipment_id = intval($_GET['id']);

    // Delete equipment from the database
    $sql = "DELETE FROM `equipments` WHERE `Id` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $equipment_id);
        if ($stmt->execute()) {
            $deleteSuccess = true;
        } else {
            $deleteError = "Error deleting equipment: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $deleteError = "Error preparing delete statement: " . $conn->error;
    }
} else {
    $deleteError = "Invalid or missing equipment ID!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Equipment</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require 'partials/_navBar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Delete Equipment</h1>

        <?php if ($deleteSuccess) : ?>
            <div class="alert alert-success text-center">
                Equipment deleted successfully!
            </div>
            <div class="text-center">
                <a href="equipments.php" class="btn btn-primary">Back to Equipment List</a>
            </div>
        <?php elseif ($deleteError) : ?>
            <div class="alert alert-danger text-center">
                <?php echo $deleteError; ?>
            </div>
            <div class="text-center">
                <a href="equipments.php" class="btn btn-primary">Back to Equipment List</a>
            </div>
        <?php else : ?>
            <div class="alert alert-warning text-center">
                No equipment ID provided!
            </div>
            <div class="text-center">
                <a href="equipments.php" class="btn btn-primary">Back to Equipment List</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
