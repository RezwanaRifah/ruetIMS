<?php
// Check if the department is set in the URL
$department = isset($_GET['department']) ? htmlspecialchars($_GET['department']) : "Unknown Department";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities - <?php echo $department; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php require 'partials/_navBar.php' ?>

    <div class="container mt-5">
        <div class="text-center">
            <h1>Facilities of <?php echo $department; ?></h1>
        </div>
    </div>


    <!-- Main Content -->
    <main>
        <div class="container mt-5">
            <div class="row">

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Lab</h5>
                            <p>Explore state-of-the-art labs for all departments.</p>
                            <a href="rooms/lab.php?department=<?php echo urlencode($department); ?>" class="btn btn-primary">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Class Rooms</h5>
                            <p>Modern classrooms equipped with advanced tools.</p>
                            <a href="rooms/class.php?department=<?php echo urlencode($department); ?>" class="btn btn-primary">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Seminar Rooms</h5>
                            <p>Well-equipped seminar rooms for workshops and events.</p>
                            <a href="rooms/seminar.php?department=<?php echo urlencode($department); ?>" class="btn btn-primary">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h5 class="card-title">Teacher's Rooms</h5>
                            <p>Comfortable spaces for teachers and academic meetings.</p>
                            <a href="rooms/teachersroom.php?department=<?php echo urlencode($department); ?>" class="btn btn-primary">
                                View More
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Bootstrap JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </main>

    <!-- Footer Section -->
    <?php require 'partials/_footer.php' ?>
</body>

</html>