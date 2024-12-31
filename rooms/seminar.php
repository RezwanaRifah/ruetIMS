<?php
// Sanitize and validate input
$seminarDepartment = isset($_GET['department']) ? htmlspecialchars($_GET['department']) : "Unknown Department";

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
    $stmt_dept->bind_param("s", $seminarDepartment); // 's' for string
    $stmt_dept->execute();
    $result_dept = $stmt_dept->get_result();
    $departmentShortName = $result_dept->fetch_assoc();

    if ($departmentShortName) {
        // Fetch seminars by department ID
        $sql_seminars = "SELECT * FROM `rooms` WHERE `Department` = ? AND `RoomType` = 'seminar'";
        $stmt_seminars = $conn->prepare($sql_seminars);

        if (!$stmt_seminars) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        // Bind department ID parameter
        $stmt_seminars->bind_param("i", $departmentShortName['ShortName']); // 'i' for integer
        $stmt_seminars->execute();
        $result_seminars = $stmt_seminars->get_result();
        $seminars = $result_seminars->fetch_all(MYSQLI_ASSOC);
    } else {
        $seminars = []; // No department found
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
    <title>Facilities - <?php echo $seminarDepartment; ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            <h1>Seminars of <?php echo $seminarDepartment; ?></h1>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php foreach ($seminars as $seminar) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title
                            "><?php echo $seminar['RoomName']; ?></h5>
                            <p class="card-text">Room No: <?php echo $seminar['RoomNo']; ?></p>
                            <a href="../equipments.php?room_no=<?php echo $seminar['RoomNo']; ?>" class="btn btn-primary">View Seminar</a>
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