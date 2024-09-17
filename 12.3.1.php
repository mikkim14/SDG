<?php
include "db.php";
function calculatePoints($total_amount_of_campus_waste_generated) {
    return !empty($total_amount_of_campus_waste_generated) ? 15 : 0;
}

if (isset($_POST['create'])) {
    $total_amount_of_campus_waste_generated = $_POST['total_amount_of_campus_waste_generated'];
    $municipal_solid_waste = $_POST['municipal_solid_waste'];
    $total_amount_of_waste_recycled = $_POST['total_amount_of_waste_recycled'];
    $total_amount_of_waste_send_to_landfill = $_POST['total_amount_of_waste_send_to_landfill'];
    $total_campus_income_from_recyclables = $_POST['total_campus_income_from_recyclables'];

    // Insert data into database
    $query = "INSERT INTO 12_3_1 (total_amount_of_campus_waste_generated, municipal_solid_waste, total_amount_of_waste_recycled, total_amount_of_waste_send_to_landfill, total_campus_income_from_recyclables) 
    VALUES ('$total_amount_of_campus_waste_generated', '$municipal_solid_waste', '$total_amount_of_waste_recycled', '$total_amount_of_waste_send_to_landfill', '$total_campus_income_from_recyclables')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script type='text/javascript'>alert('Research added successfully');</script>";
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }
}

// Read operation (Display data in table)
$query = "SELECT * FROM 12_3_1";
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
                    <label for="total_amount_of_campus_waste_generated">Total Amount of Campus Waste Generated:</label>
                    <input type="number" name="total_amount_of_campus_waste_generated" id="total_amount_of_campus_waste_generated" required>
                </div>
                <div>
                    <label for="municipal_solid_waste">Municipal Solid Waste:</label>
                    <input type="number" name="municipal_solid_waste" id="municipal_solid_waste" required>
                </div>
                <div>
                    <label for="total_amount_of_waste_recycled">Total Amount of Waste Recycled:</label>
                    <input type="number" name="total_amount_of_waste_recycled" id="total_amount_of_waste_recycled" required>
                </div>
                <div>
                    <label for="total_amount_of_waste_send_to_landfill">Total Amount of Waste Sent to Landfill:</label>
                    <input type="number" name="total_amount_of_waste_send_to_landfill" id="total_amount_of_waste_send_to_landfill" required>
                </div>
                <div>
                    <label for="total_campus_income_from_recyclables">Total Campus Income from Recyclables:</label>
                    <input type="number" name="total_campus_income_from_recyclables" id="total_campus_income_from_recyclables" required>
                </div>
                <div>
                    <input type="submit" name="create" value="Submit">
                </div>
            </form>
        </div>
        <a href="home.html" class="back-link">Back</a>
    </div>

    <div class="container">
        <h2>Waste Tracking Data</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Total Campus Waste Generated</th>
                <th>Municipal Solid Waste</th>
                <th>Total Waste Recycled</th>
                <th>Total Waste Sent to Landfill</th>
                <th>Total Campus Income from Recyclables</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $points = calculatePoints($row['total_amount_of_campus_waste_generated']);
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['total_amount_of_campus_waste_generated'] . "</td>";
                echo "<td>" . $row['municipal_solid_waste'] . "</td>";
                echo "<td>" . $row['total_amount_of_waste_recycled'] . "</td>";
                echo "<td>" . $row['total_amount_of_waste_send_to_landfill'] . "</td>";
                echo "<td>" . $row['total_campus_income_from_recyclables'] . "</td>";
                echo "<td>".$points."</td>";
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
        $query = "SELECT * FROM 12_3_1 WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display edit form with pre-filled values
        echo "
        <div class='container'>
            <h1>Edit Waste Tracking Data</h1>
            <div class='form-container'>
                <form action='' method='post'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <div>
                        <label for='total_amount_of_campus_waste_generated'>Total Amount of Campus Waste Generated:</label>
                        <input type='number' name='total_amount_of_campus_waste_generated' id='total_amount_of_campus_waste_generated' value='" . $row['total_amount_of_campus_waste_generated'] . "' required>
                    </div>
                    <div>
                        <label for='municipal_solid_waste'>Municipal Solid Waste:</label>
                        <input type='number' name='municipal_solid_waste' id='municipal_solid_waste' value='" . $row['municipal_solid_waste'] . "' required>
                    </div>
                    <div>
                        <label for='total_amount_of_waste_recycled'>Total Amount of Waste Recycled:</label>
                        <input type='number' name='total_amount_of_waste_recycled' id='total_amount_of_waste_recycled' value='" . $row['total_amount_of_waste_recycled'] . "' required>
                    </div>
                    <div>
                        <label for='total_amount_of_waste_send_to_landfill'>Total Amount of Waste Sent to Landfill:</label>
                        <input type='number' name='total_amount_of_waste_send_to_landfill' id='total_amount_of_waste_send_to_landfill' value='" . $row['total_amount_of_waste_send_to_landfill'] . "' required>
                    </div>
                    <div>
                        <label for='total_campus_income_from_recyclables'>Total Campus Income from Recyclables:</label>
                        <input type='number' name='total_campus_income_from_recyclables' id='total_campus_income_from_recyclables' value='" . $row['total_campus_income_from_recyclables'] . "' required>
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
        $total_amount_of_campus_waste_generated = $_POST['total_amount_of_campus_waste_generated'];
        $municipal_solid_waste = $_POST['municipal_solid_waste'];
        $total_amount_of_waste_recycled = $_POST['total_amount_of_waste_recycled'];
        $total_amount_of_waste_send_to_landfill = $_POST['total_amount_of_waste_send_to_landfill'];
        $total_campus_income_from_recyclables = $_POST['total_campus_income_from_recyclables'];

        // Update the record in the database
        $query = "UPDATE 12_3_1 SET 
        total_amount_of_campus_waste_generated='$total_amount_of_campus_waste_generated', 
        municipal_solid_waste='$municipal_solid_waste', 
        total_amount_of_waste_recycled='$total_amount_of_waste_recycled', 
        total_amount_of_waste_send_to_landfill='$total_amount_of_waste_send_to_landfill', 
        total_campus_income_from_recyclables='$total_campus_income_from_recyclables' 
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
        $query = "DELETE FROM 12_3_1 WHERE id='$id'";
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
