<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Sanitize and validate input
$labDepartment = isset($_GET['department']) ? htmlspecialchars($_GET['department']) : "Unknown Department";

// Connect to the database
require '../partials/_dbConnector.php';

try {
    // Check if department exists
    $sql_dept = "SELECT `ShortName` FROM `departments` WHERE `FullName` = ?";
    $stmt_dept = $conn->prepare($sql_dept);

    if (!$stmt_dept) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt_dept->bind_param("s", $labDepartment); // 's' for string
    $stmt_dept->execute();
    $result_dept = $stmt_dept->get_result();
    $departmentShortName = $result_dept->fetch_assoc();

    if ($departmentShortName) {
        // Fetch labs by department
        $sql_labs = "SELECT * FROM `rooms` WHERE `Department` = ? AND `RoomType` = 'lab'";
        $stmt_labs = $conn->prepare($sql_labs);

        if (!$stmt_labs) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        // Bind department ID parameter
        $stmt_labs->bind_param("i", $departmentShortName['ShortName']); // 'i' for integer
        $stmt_labs->execute();
        $result_labs = $stmt_labs->get_result();
        $labs = $result_labs->fetch_all(MYSQLI_ASSOC);
    } else {
        $labs = []; // No department found
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labs - <?php echo $labDepartment; ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Page Styling (can move to external styles.css) */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        header {
            background-color: #001f54;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        button {
            background-color: navy;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php require '../partials/_navBar.php' ?>

    <div class="container mt-5">
        <div class="text-center">
            <h1>Labs of <?php echo $labDepartment; ?></h1>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php foreach ($labs as $lab) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title
                            "><?php echo $lab['RoomName']; ?></h5>
                            <p class="card-text">Room No: <?php echo $lab['RoomNo']; ?></p>
                            <a href="../equipments.php?room_no=<?php echo $lab['RoomNo']; ?>" class="btn btn-primary">View Lab</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <?php require '../partials/_footer.php' ?>

</body>

</html>