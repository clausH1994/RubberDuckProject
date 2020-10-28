<?php require_once "../connection/dbcon.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM customers");
$query->execute();
$getData = $query->fetchAll();
//var_dump($getUsers);
?>
<body>

<div class="container">

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new entry has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Postalcode</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($getData as $getData) {
                    echo "<tr>";
                    echo "<td>". $getData['ID']."</td>";
                    echo "<td>". $getData['username']."</td>";
                    echo "<td>". $getData['Fname']. " " .$getData['Lname']."</td>";
                    echo "<td>". $getData['email']."</td>";
                    echo "<td>";
                    if ($getData['rank']==1){
                        echo '<img src="img/lvl1.png" alt="lvl 1" height="40px">';
                    }
                    elseif ($getData['rank']==2){
                        echo '<img src="img/lvl2.png" alt="lvl 2" height="40px">';
                    }
                    elseif ($getData['rank']==3){
                        echo '<img src="img/lvl3.png" alt="lvl 3" height="40px">';
                    }
                    echo "</td>";
                    echo '<td><a href="editEntry.php?ID='.$getData['ID'].'" class="waves-effect waves-light btn" ">Edit</a></td>';
                    echo '<td><a href="deleteEntry.php?ID='.$getData['ID'].'" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>companyinfo DB!</h3>

        <form class="col s12" name="contact" method="post" action="aboutUsData.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" class="validate" required="" aria-required="true">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="address" name="address" type="text" class="validate" required="" aria-required="true">
                    <label for="address">Address</label>
                </div>
                <div class="input-field col s6">
                    <input id="postalId" name="postalId" type="text" class="validate" required="" aria-required="true">
                    <label for="postalId">Postalcode</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="text" class="validate" required="" aria-required="true">
                    <label for="phone">Phone</label>
                </div>
                <div class="row">
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" class="validate" required="" aria-required="true">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>
</body>
</html>
