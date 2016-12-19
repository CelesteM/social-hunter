<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

	$connection = get_connection();
	$connection->beginTransaction();

	$text = "SELECT AdvertisementID, EmployeeID, DISTINCT ItemName, Category, UnitPrice, AvailableUnits, AdvertisedDate, Company
    FROM Advertisements";

	$bind = [];

	$results = select($text, $bind, $connection);

} catch(Exception $e) {
	$e->getMessage();
}


?>

    <div id="wrapper">

        <?php echo navigation($loginID); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Items
                            
                        </h1>
                    </div>
                </div>
                </br>

                <?php

                    // show table
                    echo "<div class='row'>
                    <div class=\"col-lg-12\">
                    <table class=\"table table-striped table-hover\" style=\"font-size: 12pt\">
                        <thead>
                        <tr>
                             <th>Advertisement ID</th>
                            <th>Employee ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Availale Units</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>";


                    foreach($results as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["AdvertisementID"] . "</td>";
                        echo "<td>" . $row["EmployeeID"] . "</td>";
                        echo "<td>" . $row['ItemName'] . "</td>";
                        echo "<td>" . $row['Category'] . "</td>";
                        echo "<td>" . $row['UnitPrice'] . "</td>";
                        echo "<td>" . $row['AvailableUnits'] . "</td>";
                        echo "<td>" . $row['AdvertisedDate'] . "</td>";
                        echo "<td>" . $row['Company'] . "</td>";
                        echo "<td> <button>delete</button> </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";

                ?>
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>

<? include "../include/bottom.php"; ?>