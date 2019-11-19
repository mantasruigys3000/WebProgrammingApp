<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Connection and Disconnection Demo - PDO with SSL</title>
    </head>
    <body>
        <h1>Database Connection and Disconnection Demo - PDO with SSL</h1>
        <?php        
        $username = "s5112120"; // Put your username in the quotations
        $password = "gLTXwhgjoHvrxff9TyFwv3VLnHexEmni"; // Put your database password in the quotations
        $host = "db.bucomputing.uk";
        $port = 6612; // Note our MySQL server doesn't use the standard MySQL port, hence why we need to specify it
        $database = $username;  // In our case the database name is the same as the username (normally it is 
        // different) so we can set it as the same as the username

        $dsn = "mysql:host=$host;dbname=$database;port=$port";
        $options = array ( 'usessl' => true );
        
        try {
            $dbh = new PDO($dsn,
                           $username,
                           $password,
                           array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                                 PDO::MYSQL_ATTR_SSL_CAPATH => '/public_html',
                                 PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => 0));
            
            echo "<p>Connected to server: " . $host . "</p>";

            // ADD CODE THAT USES THE DATABASE CONNECTION HERE
                
                
            // After all work with the database is complete disconnect the database connection 
            // (we are finished with the database)
            $dbh = null; // Removing the value from the connection's variable prompts database disconnection
            echo "<p>Disconnected from server: " . $host . "</p>";
        }catch (PDOException $e) {
           echo 'Error: ' . $e->getMessage();
        }
        ?>
    </body>
</html>
