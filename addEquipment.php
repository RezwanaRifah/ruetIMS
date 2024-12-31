<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$addedSuccessfully = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "partials/_dbConnector.php";

    // Retrieve data from the POST request
    $equipment_name = $_POST['equipment_name'];
    $room_no = $_POST['room_no'];
    $department = $_POST['department'];
    $condition = $_POST['condition'] == 'Good' ? 1 : 0;

    $sql = "INSERT INTO `equipments` (`Name`, `RoomNo`, `Department`, `Condition`) VALUES ('$equipment_name', '$room_no', '$department', '$condition')";
    $result = mysqli_query($conn, $sql);

    if ($result)
        $addedSuccessfully = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Equipment Information</title>
    <!-- Include Bootstrap CSS (adjust path as needed) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <?php require 'partials/_navBar.php' ?>

    <?php
    if (!$hasAccess) {
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-danger" role="alert">';
        echo 'You do not have permission to update rooms and equipment.';
        echo '</div></div>';
        exit;
    }
    ?>

    <div class="container mt-5">
        <h2>Add Equipment Information</h2>
        <form action="addEquipment.php" method="post">
            <!-- Equipment Name -->
            <div class="mb-3">
                <label for="equipment-name" class="form-label">Equipment Name</label>
                <input
                    type="text"
                    id="equipment-name"
                    class="form-control"
                    name="equipment_name"
                    placeholder="Enter equipment name (eg. Projector, Laptop, Fan)"
                    required>
            </div>

            <!-- Room No -->
            <div class="mb-3">
                <label for="room-no" class="form-label">Room No</label>
                <input
                    type="text"
                    id="room-no"
                    class="form-control"
                    name="room_no"
                    placeholder="Enter room number (eg. CSE101, EEE202)"
                    required>
            </div>

            <!-- Department -->
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input
                    type="text"
                    id="department"
                    class="form-control"
                    name="department"
                    placeholder="Enter department (eg. CSE, EEE)"
                    required>
            </div>

            <!-- Condition (Dropdown) -->
            <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select
                    class="form-select"
                    id="condition"
                    name="condition"
                    required>
                    <option value="Good">Good</option>
                    <option value="Bad">Bad</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Add Equipment</button>
        </form>

        <?php
        if ($addedSuccessfully) {
            echo '<div class="alert alert-success mt-3" role="alert">
                Equipment added successfully!
            </div>';
        }
        ?>
    </div>

    <!-- Include Bootstrap JS (if needed) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>