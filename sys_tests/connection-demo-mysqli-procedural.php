<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Connection and Disconnection Demo - MySQLi (Procedural) with SSL</title>
    </head>
    <body>
        <h1>Database Connection and Disconnection Demo - MySQLi (Procedural) with SSL</h1>
        <?php
        $username = "s5112120"; // Put your username in the quotations
        $password = "gLTXwhgjoHvrxff9TyFwv3VLnHexEmni"; // Put your database password in the quotations
        $host = "db.bucomputing.uk";
        $port = 6612; // Note our MySQL server doesn't use the standard MySQL port, hence why we need to specify it
        $database = $username;  // In our case the database name is the same as the username (normally it is 
        // different) so we can set it as the same as the username

        $connection = mysqli_init(); // Initializes MySQLi and returns a resource for use with mysqli_real_connect()
        if (!$connection) { // If initalising MySQLi failed (i.e. it didn't return true, hence the ! for checking not true)
            echo "<p>Initalising MySQLi failed</p>";
        } else {
            // Establish secure connection using SSL for use with MySQLi
            mysqli_ssl_set($connection, NULL, NULL, NULL, '/public_html/sys_tests', NULL);

            // Connect the MySQL connection
            mysqli_real_connect($connection, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
            if (mysqli_connect_errno()) { // If connection error
                // Display error message and stop the script. We can't do any database work as there is no connection to use
                echo "<p>Failed to connect to MySQL. " .
                "Error (" . mysqli_connect_errno() . "): " . mysqli_connect_error() . "</p>";
            } else {
                echo "<p>Connected to server: " . mysqli_get_host_info($connection) . "</p>";

                // ADD CODE THAT USES THE DATABASE CONNECTION HERE
                
                
                // After all work with the database is complete disconnect the database connection 
                // (we are finished with the database)
                mysqli_close($connection);
                echo "<p>Disconnected from server: " . $host . "</p>";
            }
        }
        ?>
    </body>
</html>
