<?php require_once "../connection/dbcon.php";
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
                    <input id="" name="endTIme" type="text"value="" class="validate" required="" aria-required="true">
                    <label for="endTime">closing hour</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
            <button class="btn waves-effect waves-light" type="submit" name="cancel">cancel
            </button>
        </form>



