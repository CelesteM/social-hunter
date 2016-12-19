<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

	$connection = get_connection();
	$connection->beginTransaction();

	

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
                            Sales Report
                            
                        </h1>
                    </div>
                </div>
                </br>

                <?php

                    // month selection
                    echo '<div class="row">
                    <div class="col-lg-2">
                        <label style="font-size: 14pt">Select Month</label>
                    </div>
                    <div class="col-lg-4">
                        <select name="month-selection" class="form-control form-control-lg" style="font-size: 14pt; height: 3vw">
                          <option>01</option>
                          <option>02</option>
                          <option>03</option>
                          <option>04</option>
                          <option>05</option>
                          <option>06</option>
                          <option>07</option>
                          <option>08</option>
                          <option>09</option>
                          <option>10</option>
                          <option>11</option>
                          <option>12</option>
                        </select>
                    </div>
                </div>
                </br>';

                    // Find user selected month
                    $selectOption = $_POST['month-selection'];

                    $text = "SELECT TransactionID, SalesDate, AdvertisementID, NumberOfUnits, Total
                                FROM Sales
                                WHERE SalesDate LIKE '2016/'";
                    $text .= $selectOption;
                    $text .= "%";

                    $bind = [];

                    $results = select($text, $bind, $connection);

                    // show table
                    echo "<div class='row'>
                    <div class=\"col-lg-12\">
                    <table class=\"table table-striped table-hover\" style=\"font-size: 12pt\">
                        <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date Time</th>
                            <th>Advertisement ID</th>
                            <th>Number Of Units</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>";


                    foreach($results as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["TransactionID"] . "</td>";
                        echo "<td>" . $row['SalesDate'] . "</td>";
                        echo "<td>" . $row['AdvertisementID'] . "</td>";
                        echo "<td>" . $row['NumberOfUnits'] . "</td>";
                        echo "<td>" . $row['Total'] . "</td>";
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