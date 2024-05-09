<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CelestialUI Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../front/template/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="../front/template/vendors/css/vendor.bundle.base.css">
    <!-- endinject --> 
    <!-- inject:css -->
    <link rel="stylesheet" href="">
    <!-- endinject -->
    <link rel="shortcut icon" href="../front/template/images/favicon.png" />
    <style>
        /* Custom CSS for navbar */
        .navbar {
            background-color: red;
            color: white;
        }
        
        .navbar-brand-wrapper {
            padding: 10px;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .navbar-menu-wrapper {
            margin-left: auto;
            padding-right: 15px;
        }

        .navbar-toggler {
            border: none;
            background: none;
            color: white;
            font-size: 24px;
        }

        .navbar-toggler:focus {
            outline: none;
        }

        .navbar-toggler:hover {
            cursor: pointer;
        }

        /* Custom CSS for other elements */
        .statistics-container {
            margin: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pie-chart {
            width: 60%; /* Adjust the width as needed */
            height: auto;
        }
        html, body {
             height: 100%;
             margin: 0;
        }

        .container-scroller {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Include Sidebar Menu -->
    <?php include "c:/wamp64/www/forum/commentaire/view/front/addCommentaire.php"; ?>

<div class="container-scroller">
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- Statistics Container -->
                <div class="statistics-container">
                    <h2>Comment Statistics by Sentiment</h2>
                    <!-- Display Pie Chart -->
                    <div class="pie-chart" id="pieChart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Load necessary scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Fetch data from PHP controller and create pie chart
        <?php
            // Include the necessary files and initialize the controller
            require_once 'C:/wamp64/www/forum/commentaire/controller/commentaireC.php';
            $commentaireController = new CommentaireC();

            // Call the listCommentaires_stat() function to get comment statistics
            $commentaires = $commentaireController->listCommentaires_stat();

            // Initialize an array to store sentiments and their counts
            $sentiments = ['positif' => 0, 'negatif' => 0];
            foreach ($commentaires as $commentaire) {
                $sentiment = $commentaire->getSentiment(); // Assuming you have a method to get the sentiment of a comment
                if (array_key_exists($sentiment, $sentiments)) {
                    $sentiments[$sentiment]++;
                }'"'
            }

            // Convert data to JavaScript array format
            $labels = array_keys($sentiments);
            $data = array_values($sentiments);
        ?>

        // Create pie chart using ApexCharts
        var options = {
            chart: {
                type: 'pie',
            },
            labels: <?php echo json_encode($labels); ?>,
            series: <?php echo json_encode($data); ?>,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }

        var chart = new ApexCharts(document.querySelector("#pieChart"), options);

        chart.render();
    </script>
</body>