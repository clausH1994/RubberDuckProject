<?php 
  require_once "connection/dbcon.php";
  require_once "connection/Redirector.php";
  $total_price=0; 
 
  require_once "connection/session.php";

  $session = new Session();

if (isset($_SESSION['user_id'])) {
    $customerID = htmlspecialchars($_SESSION['user_id']);
    $dbCon = dbCon();
    $query = $dbCon->prepare("SELECT * FROM Customer, PostalCode WHERE CustomerID=$customerID AND PostalCode.zipcodeID=Customer.postalID");
    $query->execute();
    $getCustomer = $query->fetchAll();

    require_once "header.php";
    
    
    $orders = $dbCon->prepare("SELECT * FROM InvoiceOrderData");
    $orders->execute();
    $getOrders = $orders->fetchAll();
    
    ?>

<body>

<div class="container">

    <h2>Order overview</h2>
    
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Image URL</th>
                        <th>Quantity</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($getOrders as $getOrder) {
                        echo "<tr>
                        <td>" . $getOrder['ID'] . "</td>
                        <td>" . $getOrder['code'] . "</td>
                        <td>" . $getOrder['name'] . "</td>
                        <td>" . $getOrder['color'] . "</td>
                        <td>" . $getOrder['price'] . "</td>
                        <td>" . $getOrder['image'] . "</td> 
                        <td>" . $getOrder['quantity'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>