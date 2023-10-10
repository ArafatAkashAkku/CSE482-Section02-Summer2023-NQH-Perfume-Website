<?php
require_once '../config.php';
include '../dbConnect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- external css link  -->
    <link rel="stylesheet" href="externals/css/style.css">
    <!-- swipper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- font awesome cdn 6.3.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <!-- favicon link  -->
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- website title  -->
    <title>MTBS | Review Info</title>
    <!-- datatables net  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">


</head>

<body class="overflow-x-hidden">
    <?php
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] == true) {
    ?>
        <!-- header start  -->
        <?php include("includes/header.php") ?>
        <!-- header end  -->

        <!-- main start  -->
        <main class="mx-4 my-3 overflow-scroll">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col" style="display: none;">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Title</th>
                        <th scope="col">Review</th>
                        <th scope="col">Time</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serial = 0;
                    $ret = mysqli_query($con, "select * from reviews");
                    while ($row = mysqli_fetch_array($ret)) {
                        $serial = $serial + 1;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $serial ?> </th>
                            <td style="display: none;"><?php
                                                        echo htmlentities($row["id"]);
                                                        ?> </td>
                            <td><?php
                                echo htmlentities($row["name"]);
                                ?> </td>
                            <td>
                                <?php
                                $queryy = "select * from all_movie_info";
                                $rett = mysqli_query($con, $queryy);
                                $roww = mysqli_fetch_array($rett);
                                while ($roww = mysqli_fetch_array($rett)) {
                                    if ($row['movie'] === $roww['id']) {
                                        echo htmlentities($roww["name"]);
                                    }
                                }
                                ?>
                            </td>
                            <td><?php
                                echo htmlentities(substr($row["title"], 0, 20)) . "....";
                                ?> </td>
                            <td><?php
                                echo htmlentities(substr($row["review"], 0, 20)) . "....";
                                ?> </td>
                            <td><?php
                                echo htmlentities($row["time"]);
                                ?> </td>
                            <td><?php
                                if ($row["verified"] == "1") {
                                    echo "displayed";
                                } else {
                                    echo "hidden";
                                }
                                ?> </td>
                            <td><a target="_blank" href="review_info_view.php?id=<?php
                                                                                    echo htmlentities($row['id']);
                                                                                    ?>" class="pe-1">View</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col" style="display: none;">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Title</th>
                        <th scope="col">Review</th>
                        <th scope="col">Time</th>
                        <th scope="col">Visibility</th>
                        <th scope="col">View</th>
                    </tr>
                </tfoot>
            </table>
        </main>
        <!-- main end  -->

        <!-- footer start  -->
        <?php include("includes/footer.php") ?>
        <!-- footer end  -->
    <?php
    } else {
        echo "<script>
                alert('You need to log in first');
                window.location.href='index.php';
                </script>";
    }
    ?>
    <!-- bootstrap js link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- external js link  -->
    <script type="text/javascript" src="externals/js/script.js"></script>
    <!-- swipper js link  -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!-- jquery js  -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- datatables net  -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
    <script>
        function checkdelete() {
            return confirm('Are you sure want to delete?')
        }
    </script>
</body>

</html>