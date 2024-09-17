<?php
include "db.php";

// CREATE operation
if(isset($_POST['create'])) {
    $total_amount_of_campus_procurement = $_POST['total_amount_of_campus_procurement'];

    if(empty($total_amount_of_campus_procurement)) {
        echo "All fields are required.";
    } else {
        $query = "INSERT INTO 12_5_1(total_amount_of_campus_procurement) VALUES('$total_amount_of_campus_procurement')";
        $add_research = mysqli_query($conn, $query);

        if(!$add_research) {
            echo "Something went wrong: ". mysqli_error($conn);
        } else {
            echo "<script type='text/javascript'>alert('Research added successfully');</script>";
        }
    }
}

// READ operation
$query = "SELECT * FROM 12_5_1";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Concessionaires</title>
    <style>
        /* Styles for the body */
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

/* Styles for the main container */
.container {
    width: 100%;
    max-width: 600px;
    margin: 20px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
    animation: fadeIn 1s ease-in-out;
}

/* Styles for the form container */
.form-container {
    width: 100%;
}

/* Styles for the form elements */
form {
    display: flex;
    flex-direction: column;
}

form div {
    margin-bottom: 20px;
}

label h2 {
    color: #444;
    margin-bottom: 10px;
    font-size: 1.2em;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Styles for the back link */
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
   

    </style>
</head>

<body background="backgroundf.avif">
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div>
                    <label for="total_amount_of_campus_procurement"><h2>Total Amount of Campus Procurement</h2></label>
                    <input type="text" name="total_amount_of_campus_procurement">
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
                <th>Total Amount of Campus Procurement</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['total_amount_of_campus_procurement'] . "</td>";
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
        $query = "DELETE FROM 12_5_1 WHERE id='$id'";
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
