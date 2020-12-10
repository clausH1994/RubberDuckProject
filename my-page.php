<?php
require_once "connection/dbcon.php";
require_once "connection/Redirector.php";
$total_price = 0;

$customerID = "";

require_once "connection/session.php";

$session = new Session();

if (isset($_SESSION['user_id'])) {
    $customerID = htmlspecialchars($_SESSION['user_id']);
    $dbCon = dbCon();
    $query = $dbCon->prepare("SELECT * FROM Customer, PostalCode WHERE CustomerID=$customerID AND PostalCode.zipcodeID=Customer.postalID");
    $query->execute();
    $getCustomer = $query->fetchAll();
}

$dbCon = dbCon();
$orders = $dbCon->prepare("SELECT * FROM InvoiceOrderData where customerID=$customerID ORDER BY invoice");
$orders->execute();
$getOrders = $orders->fetchAll();

require_once "header.php";
?>

<div class="container">

    <h2>Order overview</h2>


    <div class="row">
        <table class="highlight">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Price</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($getOrders as $getOrder) {
                    echo "<tr> 
                        <td>" . $getOrder['invoice'] . "</td>
                        <td>" . $getOrder['date'] . "</td>
                        <td>" . $getOrder['name'] . "</td>
                        <td>" . $getOrder['quantity'] . "</td>
                        <td>" . $getOrder['price'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


</div>