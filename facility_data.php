<?php
if(!empty($_GET['facilityID'])) {
    $facilityID = $_GET['facilityID'];

    require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
    //Retrieve specific vendor data using prepared statements:
    $query = "SELECT DISTINCT doctorID, firstName, lastName, phoneNum, docEmail, dateStarted, facilityID  FROM Doctor NATURAL JOIN Employer NATURAL JOIN Location WHERE facilityID = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "i", $facilityID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);
    if($rows >= 1){ //Client found
        $all_rows= mysqli_fetch_all($result, MYSQLI_ASSOC); //Fetches the row as an associative array with DB attributes as keys
    } // end if($result)
    else {
        echo "<h2>That facility was not found</h2>";
        mysqli_close($dbc);
        exit;
    }
}
else {
    echo "You have reached this page in error";
    exit;
}
//Clients found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Facility&Doc</title>
    <meta charset ="utf-8">
</head>
<body>
<h2>Facility and Doctors</h2>

<table>
    <tr>
        <th>docID</th>
        <th>firstN</th>
        <th>lastN</th>
        <th>phone</th>
        <th>Email</th>
        <th>Started</th>
        <th>facility</th>

    </tr>
    <?php foreach ($all_rows as $client) {
        echo "<tr>";
        echo "<td>".$client['doctorID']."</td>";
        echo "<td>".$client['firstName']."</td>";
        echo "<td>".$client['lastName']."</td>";
        echo "<td>".$client['phoneNum']."</td>";
        echo "<td>".$client['docEmail']."</td>";
        echo "<td>".$client['dateStarted']."</td>";
        echo "<td>".$client['facilityID']."</td>";

        echo "</tr>";
    }
    ?>
</table>
</body>
</html>