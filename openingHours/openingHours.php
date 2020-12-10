<?php require_once "../connection/dbcon.php";
require("../admin/adminHeader.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>opening hours</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM OpeningHours");
$query->execute();
$getData = $query->fetchAll();
//var_dump($getUsers);
?>
<div class="container">
<div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr>
                    <th>Weekdays</th>
                    <th>opening</th>
                    <th>closing</th>
                </tr>
                </thead>

                <tbody>
                <?php 
                foreach ($getData as $getData) {
                    echo "<tr>";
                    echo "<td>". $getData['day']."</td>";
                    echo "<td>". $getData['startTime']. "</td>";
                    echo "<td>". $getData['endtime']."</td>";
                    echo "</td>";
                    echo '<td><a href="editOpeningHours.php?ID='.$getData['openinghoursID'].'" class="waves-effect waves-light btn" ">Edit</a></td>';
                    echo '<td><a href="deleteOpeningHours.php?ID='.$getData['openinghoursID']. '&token=' . $token . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
        <hr>
<div class="container">
        <h3>Editing opening hours</h3>
        <form class="col s12" name="openingHours" method="post" action="openingHoursData.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="day" name="day" type="text" value="" class="validate" required="" aria-required="true"/>
                    <label for="day">Weekdays</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="startTime" name="startTime" type="text"value="" class="validate" required="" aria-required="true">
                    <label for="startTime">opening hour</label>
                </div>
                <div class="input-field col s6">
                    <input id="" name="endtime" type="text"value="" class="validate" required="" aria-required="true">
                    <label for="endtime">closing hour</label>
                </div>
            </div>
            <input type="hidden" name="token" value="<?php echo $token; ?>" />
            <button class="waves-effect waves-light btn" type="submit" name="submit">Add
            </button>
            <a href="" class="waves-effect waves-light btn red">cancel
            </button>
        </form>

        