<?php
// Include the database configuration file
include "../inc/dbinfo.inc";

// Establish a database connection
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Select the database
$database = mysqli_select_db($connection, DB_DATABASE);

// Ensure that the NEW_TABLE table exists
VerifyNewTable($connection, DB_DATABASE);

// Process form submission
$employee_name = htmlentities($_POST['NAME']);
$employee_address = htmlentities($_POST['ADDRESS']);
$employee_phone = htmlentities($_POST['PHONE']);
$employee_terms = isset($_POST['TERMS']) ? 1 : 0;

if (!empty($employee_name) || !empty($employee_address) || !empty($employee_phone) || isset($_POST['TERMS'])) {
    AddEmployee($connection, $employee_name, $employee_address, $employee_phone, $employee_terms);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sample Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        form {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 5px;
            margin: 5px -5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="checkbox"] {
            margin: 5px 0;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Sample Page</h1>

    <!-- Input form -->
    <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
        <table>
            <tr>
                <td>NOME</td>
                <td>ENDEREÇO</td>
                <td>TELEFONE</td>
                <td>TERMO ACEITO ?</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="NAME" maxlength="45" />
                </td>
                <td>
                    <input type="text" name="ADDRESS" maxlength="90" />
                </td>
                <td>
                    <input type="number" name="PHONE" maxlength="90" />
                </td>
                <td>
                    <input type="checkbox" name="TERMS" />
                </td>
                <td>
                    <input type="submit" value="Add Data" />
                </td>
            </tr>
        </table>
    </form>

    <!-- Display table data -->
    <table>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>ENDEREÇO</th>
            <th>TELEFONE</th>
            <th>TERMO ACEITO</th>
        </tr>

        <?php
        $result = mysqli_query($connection, "SELECT * FROM NEW_TABLE");

        while ($query_data = mysqli_fetch_row($result)) {
            echo "<tr>";
            echo "<td>", $query_data[0], "</td>",
                "<td>", $query_data[1], "</td>",
                "<td>", $query_data[2], "</td>",
                "<td>", $query_data[3], "</td>",
                "<td>", $query_data[4] ? 'Sim' : 'Não', "</td>";
            echo "</tr>";
        }
        ?>

    </table>

    <!-- Clean up -->
    <?php
    mysqli_free_result($result);
    mysqli_close($connection);
    ?>

</body>

</html>

<?php
/* Add an employee to the table */
function AddEmployee($connection, $name, $address, $phone, $terms)
{
    $n = mysqli_real_escape_string($connection, $name);
    $a = mysqli_real_escape_string($connection, $address);
    $p = mysqli_real_escape_string($connection, $phone);

    $query = "INSERT INTO NEW_TABLE (NAME, ADDRESS, PHONE, TERMS) VALUES ('$n', '$a', '$p', '$terms');";

    if (!mysqli_query($connection, $query)) {
        echo ("<p>Error adding employee data.</p>");
    }
}

/* Check whether the table exists and, if not, create it */
function VerifyNewTable($connection, $dbName)
{
    if (!TableExists("NEW_TABLE", $connection, $dbName)) {
        $query = "CREATE TABLE NEW_TABLE (
            ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(45),
            ADDRESS VARCHAR(90),
            PHONE INT(45),
            TERMS TINYINT(1)
        )";

        if (!mysqli_query($connection, $query)) {
            echo ("<p>Error creating table.</p>");
        }
    }
}

/* Check for the existence of a table */
function TableExists($tableName, $connection, $dbName)
{
    $t = mysqli_real_escape_string($connection, $tableName);
    $d = mysqli_real_escape_string($connection, $dbName);

    $checktable = mysqli_query($connection,
        "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

    if (mysqli_num_rows($checktable) > 0) {
        return true;
    }

    return false;
}
?>
