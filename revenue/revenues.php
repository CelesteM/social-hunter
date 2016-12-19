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

    $query_users = "SELECT UserID FROM users";

    $bind = [];

    $results_ads = select($query_ads, $bind, $connection);
    $results_sales = select($query_sales, $bind, $connection);
    $results_users = select($query_users, $bind, $connection);
	

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
                            Revenues
                            
                        </h1>
                    </div>
                </div>
                </br>

                <?php

                    // Show VIP Customer
                    echo ' <form>
                        <div class="row">
                            <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="select-VIP">
                            Item
                          </label>
                          </div>
                          </form>';

                    if(isset($_POST['radio'])) // transaction of an item
                    { 
                            
                        $text = 'SELECT UserID, MAX(total_sum) as total
                                    FROM 
                                        (SELECT UserID, SUM(Total) AS total_sum 
                                            FROM Sales GROUP BY UserID
                                        ) s
                                    GROUP BY UserID
                                    ORDER BY max(total_sum) DESC
                                    LIMIT 1';

                        $bind = [];

                        $results_by_vip = select($text, $bind, $connection);

                        // show VIP
                        echo "<div class=\"col-lg-5\">";
                        echo $results_by_vip["UserID"];
                        echo "</div>
                        <div class=\"col-lg-4\">";
                        echo $results_by_vip["total"];
                        echo "</div>";
                        
                    }

                    // Show Gold Customer Rep
                    echo ' <form>
                        <div class="row">
                            <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="select-gold">
                            Item
                          </label>
                          </div>
                          </form>';

                    if(isset($_POST['radio'])) // transaction of an item
                    { 
                        $text = 'SELECT EmployeeID
                                FROM Advertisements JOIN
                                    (SELECT 
                                        AdvertisementID, SUM(NumberOfUnits) AS UnitsSum 
                                        FROM Sales GROUP BY AdvertisementID ORDER BY UnitsSum) a
                                    ON Advertisements.AdvertisementID = a.AdvertisementID
                                LIMIT 1;';

                        $bind = [];

                        $results_by_gold = select($text, $bind, $connection);

                        // show VIP
                        echo "<div class=\"col-lg-5\">";
                        echo $results_by_vip["EmployeeID"];
                        echo "</div>";
                        
                    }



                    // Show radio button and item selection
                    echo ' <form>
                        <label>Filter By</label>
                        <div class="row">
                            <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="select-item">
                            Item
                          </label>
                          </div>
                          <div class="col-lg-9">
                            <select name="item-selection" class="form-control form-control-lg" >';
                    foreach($results_ads as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["ItemName"] . "</td>";
                    }            
                    echo'</select>
                        </div>
                        </div>';

                    if(isset($_POST['radio'])) // transaction of an item
                    { 
                        $selectOption = $_POST['item-selection']; 
                            
                        $text = 'SELECT *
                                FROM Sales
                                WHERE AdvertisementID = 
                                    (SELECT Advertisements.AdvertisementID FROM Advertisements WHERE ItemName = "';
                        $text .= $selectOption;
                        $text .='")';

                        $bind = [];

                        $results_by_item = select($text, $bind, $connection);

                        // show table: transcations of an item
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


                        foreach($results_by_item as $row)
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
                        
                    }

                    echo "</form>";


                    // show revenues by item type
                    echo ' <form>
                        <div class="row">
                            <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="select-type">
                            Item Type
                          </label>
                          </div>
                          <div class="col-lg-9">
                            <select name="item-type-selection" class="form-control form-control-lg" >';
                    foreach($results_ads as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["Category"] . "</td>";
                    }            
                    echo'</select>
                        </div>
                        </div>';

                    if(isset($_POST['radio'])) // transaction of an item
                    { 
                        $selectOption = $_POST['item-type-selection']; 
                            
                        $text = 'SELECT *
                                FROM Sales
                                WHERE AdvertisementID = 
                                    (SELECT Advertisements.AdvertisementID FROM Advertisements WHERE Category = "';
                        $text .= $selectOption;
                        $text .='")';

                        $bind = [];

                        $results_by_type = select($text, $bind, $connection);

                        // show table: transcations of an item
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


                        foreach($results_by_type as $row)
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
                        
                    }

                    echo "</form>";



                    // revenues by a customer
                    echo ' <form>
                        <label>Filter By</label>
                        <div class="row">
                            <div class="col-lg-3 radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="select-customer">
                            Customer
                          </label>
                          </div>
                          <div class="col-lg-9">
                            <select name="customer-selection" class="form-control form-control-lg" >';
                    foreach($results_users as $row)
                    {
                        echo "<tr>";
                        echo "<td>" . $row["UserID"] . "</td>";
                    }            
                    echo'</select>
                        </div>
                        </div>';

                    if(isset($_POST['radio'])) // transaction of an item
                    { 
                        $selectOption = $_POST['customer-selection']; 
                            
                        $text = 'SELECT SUM(Total)
                                FROM Sales
                                WHERE UserID = ';
                        $text .= $selectOption;

                        $bind = [];

                        $results_by_customer = select($text, $bind, $connection);

                        // show table: transcations of an item
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


                        foreach($results_by_item as $row)
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
                        
                    }

                    echo "</form>";

                   

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