<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

    $connection = get_connection();
    $connection->beginTransaction();

    $text = "SELECT TransactionID, SalesDate, AdvertisementID, NumberOfUnits, Total
                FROM Sales";

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
                            Transactions
                        </h1>
                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="create.html"><button>Make a Purchase</button></a>
                    </div>
                </div>
                </br>

                <?php

                    // make a purchase button
                    echo "<div class=\"row\">
                    <div class=\"col-lg-12\">
                        <a href=\"create.html\"><button>Make a Purchase</button></a>
                    </div>
                    </div>
                    </br>
                    </br>";

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