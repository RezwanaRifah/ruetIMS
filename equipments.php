<?php
// Sanitize and validate input
$roomNo = isset($_GET['room_no']) ? htmlspecialchars($_GET['room_no']) : null;

// Connect to the database
require 'partials/_dbConnector.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Details</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Sticky footer styles */
        html, body {
            height: 100%; /* Full-height layout */
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1 0 auto; /* Makes the content area flexible */
        }

        .footer {
            flex-shrink: 0; /* Ensures footer stays at the bottom */
        }
    </style>
</head>

<body>
    <?php require 'partials/_navBar.php' ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Equipment Details</h1>

        <?php
        if ($roomNo) {
            try {
                // Prepare and execute the query to fetch equipment data by RoomNo
                $sql_equipments = "SELECT * FROM `equipments` WHERE `RoomNo` = ?";
                $stmt = $conn->prepare($sql_equipments);

                if (!$stmt) {
                    throw new Exception("Error preparing statement: " . $conn->error);
                }

                // Bind the room number parameter
                $stmt->bind_param("s", $roomNo); // 's' for string
                $stmt->execute();
                $result = $stmt->get_result();
                $equipments = $result->fetch_all(MYSQLI_ASSOC);

                if (empty($equipments)) {
                    echo "<div class='alert alert-warning'>No equipment found for Room No: <strong>" . htmlspecialchars($roomNo) . "</strong></div>";
                } else {
                    echo "<h2 class='text-center'>Room No: " . htmlspecialchars($roomNo) . "</h2>";
                    echo "<table class='table table-bordered table-hover mt-4'>";
                    echo "<thead class='table-dark'>";
                    echo "<tr><th>ID</th><th>Name</th><th>Room No</th><th>Condition</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($equipments as $equipment) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($equipment['Id']) . "</td>";
                        echo "<td>" . htmlspecialchars($equipment['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($equipment['RoomNo']) . "</td>";
                        echo "<td>" . ($equipment['Condition'] == 1 ? "<span class='badge bg-success'>Good</span>" : "<span class='badge bg-danger'>Bad</span>") . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='alert alert-info'>Please provide a valid Room No in the query string.</div>";
        }
        ?>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer  -->
    <?php require 'partials/_footer.php' ?>
</body>

</html>