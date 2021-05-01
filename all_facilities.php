<?php
ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
require_once('../mysqli_config.php'); //Connect to the database
$query = 'SELECT facilityID, street, city, state, zip, numOfBeds, facilityName FROM Location';
$result = mysqli_query($dbc, $query);
//Fetch all rows of result as an associative array
if($result)
    $all_rows= mysqli_fetch_all($result, MYSQLI_ASSOC); //get the result as an associative, 2-dimensional array
else {
    echo "<h2>We are unable to process this request right now.</h2>";
    echo "<h3>Please try again later.</h3>";
    exit;
}
mysqli_close($dbc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Locations</title>
    <meta charset ="utf-8">
</head>
<body>
<h2>All Facilities</h2>

<table>
    <tr>
        <th>facilityID</th>
        <th>Street</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Number of Beds</th>
        <th>Facility Name</th>
    </tr>
    <?php foreach ($all_rows as $client) {
        echo "<tr>";
        echo "<td>".$client['facilityID']."</td>";
        echo "<td>".$client['street']."</td>";
        echo "<td>".$client['city']."</td>";
        echo "<td>".$client['state']."</td>";
        echo "<td>".$client['zip']."</td>";
        echo "<td>".$client['numOfBeds']."</td>";
        echo "<td>".$client['facilityName']."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
