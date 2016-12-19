<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

	$connection = get_connection();
	$connection->beginTransaction();

    $query_ads = "SELECT AdvertisementID, EmployeeID, DISTINCT ItemName, Category, UnitPrice, AvailableUnits, AdvertisedDate, Company
        FROM Advertisements";

    $query_sales = "SELECT TransactionID, SalesDate, AdvertisementID, UserID, NumberOfUnits, Total
                                FROM Sales";

    $bind = [];

    $results_ads = select($query_ads, $bind, $connection);
    $results_sales = select($query_sales, $bind, $connection);
	

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

                    // Show Best Seller items
                    echo ' <div class="row">
                    <form method="POST">
                        <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" value="best-seller-items">
                            Best Seller Items
                          </label>
                        </div>
                        <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="most-active-items">
                            Most Active Items
                          </label>
                        </div>
                    </form>
                    </div>';

                    if(isset($_POST['radio']))// most active items
                    { 
                        if ($selectOption === "best-seller-items" or 
                            $selectOption === "most-active-items") {
                            
                            $text = "SELECT ItemName
                                    FROM Advertisements JOIN
                                    (SELECT 
                                        AdvertisementID, SUM(NumberOfUnits) AS UnitsSum 
                                        FROM Sales GROUP BY AdvertisementID ORDER BY UnitsSum) a
                                    ON Advertisements.AdvertisementID = a.AdvertisementID
                                    LIMIT 5";

                            $bind = [];

                            $results_best_seller = select($text, $bind, $connection);

                            // show table: best seller
                            echo "<div class='row'>
                            <div class=\"col-lg-12\">
                            <table class=\"table table-striped table-hover\" style=\"font-size: 12pt\">
                                <thead>
                                <tr>
                                    <th>Item Name</th>
                                </tr>
                                </thead>
                                <tbody>";


                            foreach($results_best_seller as $row)
                            {
                                echo "<tr>";
                                echo "<td>" . $row["ItemName"] . "</td>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }




                    // show customers who bought a particular item
                    echo '<div class="row"> 
                        <form action="#" method="post">
                        <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="radio-customer">
                            Company
                          </label>
                          </div>
                          <div class="col-lg-9">
                            <select name="item-selection" class="form-control form-control-lg" >';
                   foreach($query as $row) {
                        echo "<option value='" . $row['ItemName'] . "'>" . $row['ItemName'] . "</option>";
                    };
                    echo '</select>
                        </div>
                        </form>
                    </div>';

                    if(isset($_POST['radio']))
                    {
                         // Find the selected item
                        $selectOption = $_POST['item-selection'];

                        $text = $query_sales."WHERE ItemName = ";
                        $text .= $selectOption;

                        $bind = [];

                        $results_sales_customer = select($text, $bind, $connection);

                        // show table: items listed by the company 
                        echo "<div class='row'>
                        <div class=\"col-lg-12\">
                        <table class=\"table table-striped table-hover\" style=\"font-size: 12pt\">
                            <thead>
                            <tr>
                                <th>UserID</th>
                            </tr>
                            </thead>
                            <tbody>";


                        foreach($results_sales_customer as $row)
                        {
                            echo "<tr>";
                            echo "<td>" . $row["UserID"] . "</td>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                    }



                    // show by company
                    echo '<div class="row"> 
                        <form action="#" method="post">
                        <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="radio-company">
                            Company
                          </label>
                          </div>
                          <div class="col-lg-9">
                            <select name="company-selection" class="form-control form-control-lg" >';
                   foreach($results_ads as $row) {
                        echo "<option value='" . $row['Company'] . "'>" . $row['Company'] . "</option>";
                    };
                    echo '</select>
                        </div>
                        </form>
                    </div>';

                    if(isset($_POST['radio']))
                    {
                         // Find the selected company
                        $selectOption = $_POST['company-selection'];

                        $text = "SELECT AdvertisementID, EmployeeID, DISTINCT ItemName, Category, UnitPrice, AvailableUnits, AdvertisedDate, Company
                                FROM Advertisements
                                WHERE Company = ";
                        $text .= $selectOption;

                        $bind = [];

                        $results_ads_company = select($text, $bind, $connection);

                        // show table: items listed by the company 
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
                            </tr>
                            </thead>
                            <tbody>";


                        foreach($results_ads_company as $row)
                        {
                            echo "<tr>";
                            echo "<td>" . $row["AdvertisementID"] . "</td>";
                            echo "<td>" . $row["EmployeeID"] . "</td>";
                            echo "<td>" . $row['ItemName'] . "</td>";
                            echo "<td>" . $row['Category'] . "</td>";
                            echo "<td>" . $row['UnitPrice'] . "</td>";
                            echo "<td>" . $row['AvailableUnits'] . "</td>";
                            echo "<td>" . $row['AdvertisedDate'] . "</td>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                    }

                   

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