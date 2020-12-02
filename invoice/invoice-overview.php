<?php require_once "../connection/dbcon.php";
require "../admin/adminHeader.php";

$query = dbCon()->prepare("SELECT o.*, c.fname, c.lname FROM `Order` o,Customer c WHERE o.customer = c.customerID");
$query->execute();
$getOrder = $query->fetchAll();

?>
        <div class="row">
            <div class="row">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>date</th>
                            <th>Number of products</th>
                            <th>Customer</th>
                            <th>invoice</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($getOrder as $getOrders) {
                            echo "<tr>
                            <td>" . $getOrders['orderID'] . "</td>
                            <td>" . $getOrders['date'] . "</td>
                            <td>" . $getOrders['numberOfProducts'] . "</td>
                            <td>" . $getOrders['fname'] . " " . $getOrders['lname'] . "</td>
                            <td>" . $getOrders['invoice'] . "</td>";
                            echo '<td><a href="invoice-data.php?ID=' . $getOrders['invoice'] . '" class="waves-effect waves-light btn" ">Invoice</a></td>';
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                </table>

