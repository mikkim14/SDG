<?php
include "db.php";
function calculatePoints($landfill) {
    return $landfill;
 }
// Create
if (isset($_POST['create'])) {
    $landfill_waste = $_POST['landfill_waste'];
    $title = $_POST['title_of_the_ppa'];
    $short_desc = $_POST['short_description_of_the_ppa'];
    $cost = $_POST['total_cost'];
    $fund = $_POST['fund_source'];

    if (empty($landfill_waste) || empty($title) || empty($short_desc) || !is_numeric($cost) || empty($fund)) {
        echo "<script type='text/javascript'>alert('All fields are required and total cost must be a number.');</script>";
    } else {
        $query = "INSERT INTO 12_2_3 (landfill_waste, title_of_the_ppa, short_description_of_the_ppa, total_cost, fund_source) VALUES ('$landfill_waste','$title', '$short_desc', '$cost', '$fund')";
        $add_research = mysqli_query($conn, $query);

        if (!$add_research) {
            echo "<script type='text/javascript'>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Research added successfully');</script>";
        }
    }
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $landfill_waste = $_POST['landfill_waste'];
    $title = $_POST['title_of_the_ppa'];
    $short_desc = $_POST['short_description_of_the_ppa'];
    $cost = $_POST['total_cost'];
    $fund = $_POST['fund_source'];

    if (empty($landfill_waste) || empty($title) || empty($short_desc) || !is_numeric($cost) || empty($fund)) {
        echo "<script type='text/javascript'>alert('All fields are required and total cost must be a number.');</script>";
    } else {
        $query = "UPDATE 12_2_3 SET landfill_waste= '$landfill_waste', title_of_the_ppa='$title', short_description_of_the_ppa='$short_desc', total_cost='$cost', fund_source='$fund' WHERE id='$id'";
        $update_research = mysqli_query($conn, $query);

        if (!$update_research) {
            echo "<script type='text/javascript'>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Research updated successfully');</script>";
        }
    }
}

// Delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM 12_2_3 WHERE id='$id'";
    $delete_research = mysqli_query($conn, $query);

    if (!$delete_research) {
        echo "<script type='text/javascript'>alert('Something went wrong: " . mysqli_error($conn) . "');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Research deleted successfully');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research on Responsible Consumption and Production</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .form-container, .table-container {
            margin: 20px 0;
        }
        .form-container div, .table-container div {
            margin-bottom: 15px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            color: #34495e;
        }
        .form-container input[type="text"], 
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #2ecc71;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #3498db;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
    </style>
</head>
<body background="backgroundf.avif">
    <div class="container">
        <h1>Add Research Details</h1>
        <div class="form-container">
            <form action="" method="post">
            <div>
                    <label for="landfill_waste">Total number of waste disposal policy for landfill waste:</label>
                    <input type="text" name="landfill_waste" id="landfill_waste" required>
                </div>
                <div>
                    <label for="title_of_the_ppa">Title:</label>
                    <input type="text" name="title_of_the_ppa" id="title_of_the_ppa" required>
                </div>
                <div>
                    <label for="short_description_of_the_ppa">Short Description:</label>
                    <input type="text" name="short_description_of_the_ppa" id="short_description_of_the_ppa" required>
                </div>
                <div>
                    <label for="total_cost">Total Cost:</label>
                    <input type="number" name="total_cost" id="total_cost" required>
                </div>
                <div>
                    <label for="fund_source">Fund Source:</label>
                    <input type="text" name="fund_source" id="fund_source" required>
                </div>
                <div>
                    <input type="submit" name="create" value="Submit">
                </div>
            </form>
        </div>
        <div class="back-link">
            <a href="home.html">Back</a>
        </div>
        <div class="table-container">
            <h2>Research Table</h2>
            <table>
                <thead>
                    <tr>
                        <th>Total number of waste disposal policy for landfill waste:</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Total Cost</th>
                        <th>Fund Source</th>
                        <th>Points</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM 12_2_3";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) { 
                            $points = calculatePoints($row['landfill_waste']);
                            echo "<tr>
                                     <td>{$row['landfill_waste']}</td>
                                    <td>{$row['title_of_the_ppa']}</td>
                                    <td>{$row['short_description_of_the_ppa']}</td>
                                    <td>{$row['total_cost']}</td>
                                    <td>{$row['fund_source']}</td>
                                    <td>".$points."</td>
                                    <td class='action-buttons'>
                                        <form action='' method='post' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <input type='hidden' name='landfill_waste' value='{$row['landfill_waste']}'>
                                            <input type='hidden' name='title_of_the_ppa' value='{$row['title_of_the_ppa']}'>
                                            <input type='hidden' name='short_description_of_the_ppa' value='{$row['short_description_of_the_ppa']}'>
                                            <input type='hidden' name='total_cost' value='{$row['total_cost']}'>
                                            <input type='hidden' name='fund_source' value='{$row['fund_source']}'>
                                            <input type='submit' name='edit' value='Edit'>
                                        </form>
                                        <form action='' method='post' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $landfill_waste = $_POST['landfill_waste'];
        $title = $_POST['title_of_the_ppa'];
        $short_desc = $_POST['short_description_of_the_ppa'];
        $cost = $_POST['total_cost'];
        $fund = $_POST['fund_source'];

        echo "<div class='container'>
                <h2>Edit Research Details</h2>
                <div class='form-container'>
                    <form action='' method='post'>
                        <input type='hidden' name='id' value='$id'>
                        <div>
                        <label for='landfill_waste'>Total number of waste disposal policy for landfill waste:</label>
                        <input type='text' name='landfill_waste' id='landfill_waste' value='$landfill_waste' required>
                    </div>
                        <div>
                            <label for='title_of_the_ppa'>Title:</label>
                            <input type='text' name='title_of_the_ppa' id='title_of_the_ppa' value='$title' required>
                        </div>
                        <div>
                            <label for='short_description_of_the_ppa'>Short Description:</label>
                            <input type='text' name='short_description_of_the_ppa' id='short_description_of_the_ppa' value='$short_desc' required>
                        </div>
                        <div>
                            <label for='total_cost'>Total Cost:</label>
                            <input type='number' name='total_cost' id='total_cost' value='$cost' required>
                        </div>
                        <div>
                            <label for='fund_source'>Fund Source:</label>
                            <input type='text' name='fund_source' id='fund_source' value='$fund' required>
                        </div>
                        <div>
                            <input type='submit' name='update' value='Update'>
                        </div>
                    </form>
                </div>
              </div>";
    }
    ?>
</body>
</html>
