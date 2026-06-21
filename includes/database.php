<?php





     function StartConnection($dbname)
    {
// Function to establish database connection

        global $conn;
// Access global connection variable

        $host = "localhost";
// Database server hostname
        $dbname = "auto_api";
// Commented out default database name
        $username = "root";
// Database username
        $password = ""; // Empty on default in XAMPP
// Database password (empty for XAMPP default)

        try {
// Try to create PDO connection
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
// Create PDO instance with MySQL host, database, and charset

// Turns on PDO errors
            $conn->setAttribute(PDO::ATTR_ERRMODE, 2);
// Set error mode to exception for better error handling
//echo "Verbinding met $dbname gemaakt!";
// Commented out success message
            return $conn;
// Return the connection object

        } catch (PDOException $e) {
// Catch connection errors
            echo "Verbinding mislukt: " . $e->getMessage();
// Display connection failure message with error details
        }
    }


     function ExecuteSelectQuery($selectQuery)
    {

        global $conn;
        echo "Query $selectQuery";
        try {

            //$conn = startConnection($dbname);

            $stmt = $conn->prepare($selectQuery);
            $stmt->execute();

            // Resultaat als associatieve array
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //echo "Query $query";
            return $result;
        } catch (PDOException $e) {
            echo "Query fout: " . $e->getMessage();
            return [];
        }

}