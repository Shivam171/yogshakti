<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// ---- MySQL Data -----
$servername = "localhost";
$username = "shiv";
$password = " ";
$database = "YogShakti";

// Connecting with Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css" />';
echo ' <link rel="stylesheet" type="text/css" href="confirmation.css">';
echo "Connection successfully.<br><br>";

// ---- Form Variables -------
$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$date = $_REQUEST["date"];
$instructor = $_REQUEST["instructor"];
$message = $_REQUEST["message"];

// Check for duplicate email or phone number
$duplicate_query = "SELECT * FROM Booking_Info WHERE Email = '$email' OR Phone = '$phone'";
$duplicate_result = mysqli_query($conn, $duplicate_query);

if (mysqli_num_rows($duplicate_result) > 0) {
    // Display a message indicating that the email or phone number is already in use
    echo "Error: The provided email or phone number is already in use.<br><br>";
    // Add a button to go back to the HTML page
    echo "<form method='get' action='index.html'>
                    <input type='submit' value='Go Back'>
                  </form>";
} else {
    // Attempt to insert the new record
    $sql = "INSERT INTO Booking_Info (Name, Email, Phone, Date, Instructor, Message) VALUES ('$name', '$email', '$phone', '$date', '$instructor', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successfully.";

        // Showing Data from Table ------
        $select_query = "SELECT * FROM Booking_Info";
        $result = mysqli_query($conn, $select_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<br><br>Data we have:<br>";
            echo "<table border='1'>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Date</th><th>Instructor</th><th>Message</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["Phone"] . "</td>";
                echo "<td>" . $row["Date"] . "</td>";
                echo "<td>" . $row["Instructor"] . "</td>";
                echo "<td>" . $row["Message"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Add a button to go back to the HTML page
            echo "<form method='get' action='index.html'>
                    <input type='submit' value='Go Back'>
                  </form>";
        } else {
            echo "No records found in the database.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    mysqli_close($conn);
}
