<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

	$connection = get_connection();
	$connection->beginTransaction();

	$text = "SELECT SSN, LastName, FirstName, StartDate, HourlyRate
				FROM employees";

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
                            Employees
                            
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
                            <th>SSN</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Start Date</th>
                            <th>Hourly Rate</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>";


                    foreach($results as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["SSN"] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['StartDate'] . "</td>";
                        echo "<td> <a href='edit.html'><button>edit</button></a> </td>";
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