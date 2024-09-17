<?php
include "db.php";

// CREATE operation
if(isset($_POST['create'])) {
    $total_amount_of_income_generated_from_concessionairres = $_POST['total_amount_of_income_generated_from_concessionairres'];

    if(empty($total_amount_of_income_generated_from_concessionairres)) {
        echo "All fields are required.";
    } else {
        $query = "INSERT INTO 12_5_2(total_amount_of_income_generated_from_concessionairres) VALUES('$total_amount_of_income_generated_from_concessionairres')";
        $add_research = mysqli_query($conn, $query);

        if(!$add_research) {
            echo "Something went wrong: ". mysqli_error($conn);
        } else {
            echo "<script type='text/javascript'>alert('Research added successfully');</script>";
        }
    }
}

// READ operation
$query = "SELECT * FROM 12_5_2";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Concessionaires</title>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
    color: #333;
}

.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

.container h2 {
    margin-bottom: 20px;
}

.form-container {
    margin-bottom: 20px;
}

form div {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

input[type="submit"] {
    padding: 10px 20px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.back-link {
    text-align: center;
    margin-top: 20px;
}

.back-link a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.back-link a:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body background="backgroundf.avif">
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div>
                    <label for="total_amount_of_income_generated_from_concessionairres">Total Amount of Income from Concessionaires:</label>
                    <input type="text" name="total_amount_of_income_generated_from_concessionairres" id="total_amount_of_income_generated_from_concessionairres">
                </div>
                <div>
                    <input type="submit" name="create" value="Submit">
                </div>
            </form>
        </div>
        <div class="back-link">
            <a href="home.html">Back</a>
        </div>
    </div>

    <div class="container">
        <h2>Research Data</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Total Amount of Income from Concessionaires</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['total_amount_of_income_generated_from_concessionairres'] . "</td>";
                echo "<td>
                        <form action='' method='post'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='submit' name='edit' value='Edit'>
                            <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                        </form>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <?php
    // DELETE operation
    if(isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM 12_5_2 WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        if($result) {
            echo "<script type='text/javascript'>alert('Research deleted successfully');</script>";
        } else {
            echo "Something went wrong: ". mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
