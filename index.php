<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RUET Instrument Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <?php require 'partials/_navBar.php' ?>

    <div id="main-content">
        <!-- Hero Section -->
        <section class="hero" id="home">
            <h1>Resource Management System for RUET</h1>
        </section>

        <!-- Department Grid Section -->
        <section class="departments" id="departments">
            <h2>Departments</h2>
            <div class="container mt-5">
                <div class="row">
                    <?php foreach ($departments as $department): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $department; ?></h5>
                                    <a href="facilities.php?department=<?php echo urlencode($department); ?>" class="btn btn-primary">
                                        View More
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Bootstrap JS Bundle -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </section>
    </div>

    <!-- Footer -->
    <?php require 'partials/_footer.php' ?>
</body>

</html>