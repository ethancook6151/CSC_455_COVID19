<?php
ini_set ('error_reporting', 1); //Turns on error reporting - remove once everything works.
require_once('../mysqli_config.php'); //Connect to the database
$query = 'SELECT doctorID, firstName, lastName, phoneNum, docEmail FROM Doctor';
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
    <title>HAFA</title>
    <meta charset ="utf-8">
</head>
<body>
<h2>All Doctors</h2>

<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>Email</th>
    </tr>
    <?php foreach ($all_rows as $client) {
        echo "<tr>";
        echo "<td>".$client['doctorID']."</td>";
        echo "<td>".$client['firstName']."</td>";
        echo "<td>".$client['lastName']."</td>";
        echo "<td>".$client['phoneNum']."</td>";
        echo "<td>".$client['docEmail']."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>