<?php
include "db.php";
function calculatePoints($reportType) {
    if ($reportType == "public") {
        return 10;
    } elseif ($reportType == "with report") {
        return 5;
    } else {
        return 0;
    }
}

if (isset($_POST['create'])) {
    $report = $_POST['campus_sustainability_report'];
    $evidence= $_POST['evidence'];
    

    // Insert data into database
    $query = "INSERT INTO 12_4_1 (campus_sustainability_report, evidence) 
    VALUES ('$report', '$evidence')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script type='text/javascript'>alert('Sustainability report added successfully');</script>";
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }
}

// Read operation (Display data in table)
$query = "SELECT * FROM 12_4_1";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Tracking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 20px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1, h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-container {
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f7f7f7;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions input[type="submit"] {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .actions input[type="submit"][name="delete"] {
            background-color: #dc3545;
        }

        .actions input[type="submit"][name="delete"]:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body background="backgroundf.avif">
    <div class="container">
        <h1>Add Waste Tracking Data</h1>
        <div class="form-container">
            <form action="" method="post">
                <div>
                    <label for="campus_sustainability_report">Campus Sustainability Report:</label>
                    <input type="text" name="campus_sustainability_report" id="campus_sustainability_report" required>
                </div>
                <div>
                    <label for="evidence">Evidence:</label>
                    <input type="text" name="evidence" id="evidence" required>
                </div>
                <div>
                    <input type="submit" name="create" value="Submit">
                </div>
            </form>
        </div>
        <a href="home.html" class="back-link">Back</a>
    </div>

    <div class="container">
        <h2>Campus Sustainability Report</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Campus Sustainability Report</th>
                <th>Evidence</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['campus_sustainability_report'] . "</td>";
                echo "<td>" . $row['evidence'] . "</td>";
                echo "<td>" . calculatePoints($row['campus_sustainability_report']) . "</td>";
            
                echo "<td>
                        <div class='actions'>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                <input type='submit' name='edit' value='Edit'>
                                <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                            </form>
                        </div>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <?php
    // Edit operation
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        // Fetch the record to edit
        $query = "SELECT * FROM 12_4_1 WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display edit form with pre-filled values
        echo "
        <div class='container'>
            <h1>Annual Campus Sustainability Report</h1>
            <div class='form-container'>
                <form action='' method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <div>
                        <label for='campus_sustainability_report'>Campus Sustainability Report</label>
                        <input type='text' name='campus_sustainability_report' id='campus_sustainability_report' value='" . $row['campus_sustainability_report'] . "' required>
                    </div>
                    <div>
                        <label for='evidence'>Evidence:</label>
                        <input type='text' name='evidence' id='evidence' value='" . $row['evidence'] . "' required>
                    </div>
                    <div>
                        <input type='submit' name='update' value='Update'>
                    </div>
                </form>
            </div>
        </div>";
    }

    // Update operation
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        // Retrieve updated form data
        $report = $_POST['campus_sustainability_report'];
        $evidence= $_POST['evidence'];

        // Update the record in the database
        $query = "UPDATE 12_4_1 SET 
        campus_sustainability_report='$report', 
        evidence='$evidence', 
        
        WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script type='text/javascript'>alert('Research updated successfully');</script>";
        } else {
            echo "Something went wrong: " . mysqli_error($conn);
        }
    }

    // Delete operation
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        // Delete the record from the database
        $query = "DELETE FROM 12_4_1 WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script type='text/javascript'>alert('Research deleted successfully');</script>";
        } else {
            echo "Something went wrong: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
