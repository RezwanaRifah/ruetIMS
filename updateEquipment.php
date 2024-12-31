<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
require 'partials/_dbConnector.php';

$updateSuccess = false;
$updateError = null;

// Check if equipment ID is provided
if (isset($_GET['id'])) {
    $equipment_id = intval($_GET['id']);

    // Fetch equipment details
    $sql = "SELECT `Id`, `Name`, `RoomNo`, `Condition` FROM `equipments` WHERE `Id` = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $equipment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $equipment = $result->fetch_assoc();
    } else {
        die("Error preparing statement: " . $conn->error);
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['condition'])) {
    $new_condition = $_POST['condition'] == 'Good' ? 1 : 0;

    $update_sql = "UPDATE `equipments` SET `Condition` = ? WHERE `Id` = ?";
    $update_stmt = $conn->prepare($update_sql);
    if ($update_stmt) {
        $update_stmt->bind_param("ii", $new_condition, $equipment_id);
        if ($update_stmt->execute()) {
            $updateSuccess = true;
        } else {
            $updateError = "Error updating condition: " . $update_stmt->error;
        }
    } else {
        $updateError = "Error preparing update statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Equipment Condition</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php require 'partials/_navBar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Update Equipment Condition</h1>

        <?php if (isset($equipment)) : ?>
            <div class="card mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <h5 class="card-title">Equipment: <?php echo htmlspecialchars($equipment['Name']); ?></h5>
                    <p class="card-text">Room No: <?php echo htmlspecialchars($equipment['RoomNo']); ?></p>
                    <p class="card-text">Current Condition: 
                        <?php echo $equipment['Condition'] == 1 ? '<span class="badge bg-success">Good</span>' : '<span class="badge bg-danger">Bad</span>'; ?>
                    </p>

                    <form action="updateEquipmentCondition.php?id=<?php echo $equipment['Id']; ?>" method="post">
                        <div class="mb-3">
                            <label for="condition" class="form-label">Update Condition</label>
                            <select class="form-select" id="condition" name="condition" required>
                                <option value="Good" <?php echo $equipment['Condition'] == 1 ? 'selected' : ''; ?>>Good</option>
                                <option value="Bad" <?php echo $equipment['Condition'] == 0 ? 'selected' : ''; ?>>Bad</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update</button>
                    </form>

                    <?php if ($updateSuccess) : ?>
                        <div class="alert alert-success mt-3">Condition updated successfully!</div>
                    <?php elseif ($updateError) : ?>
                        <div class="alert alert-danger mt-3"><?php echo $updateError; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger text-center">Invalid Equipment ID!</div>
        <?php endif; ?>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
