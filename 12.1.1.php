<?php
include "db.php";
function calculate_points($indexing_type) {
    if ($indexing_type == "scopus" || $indexing_type == "web_of_science") {
        return 25;
    } else {
        return 10;
    }
} 

// Create
if (isset($_POST['create'])) {
    $responsible = $_POST['consumption_production'];
    $title = $_POST['title_of_research'];
    $author = $_POST['author'];
    $year_of_publication = $_POST['year_of_publication'];
    $total_citations = $_POST['total_number_of_citations'];
    $indexing_type = $_POST['indexing_type'];

    if (empty($responsible) || empty($title) || empty($author) || !is_numeric($year_of_publication) || !is_numeric($total_citations) || empty($indexing_type)) {
        echo "<script type='text/javascript'>alert('All fields are required and year of publication and total citations must be integers.');</script>";
    } else {
        $query = "INSERT INTO 12_1_1 (consumption_production, title_of_research, author, year_of_publication, total_number_of_citations, indexing_type) VALUES ('$responsible', '$title', '$author', '$year_of_publication', '$total_citations', '$indexing_type')";
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
    $responsible = $_POST['consumption_production'];
    $title = $_POST['title_of_research'];
    $author = $_POST['author'];
    $year_of_publication = $_POST['year_of_publication'];
    $total_citations = $_POST['total_number_of_citations'];
    $indexing_type = $_POST['indexing_type'];

    if (empty($responsible) || empty($title) || empty($author) || !is_numeric($year_of_publication) || !is_numeric($total_citations) || empty($indexing_type))  {
        echo "<script type='text/javascript'>alert('All fields are required and year of publication and total citations must be integers.');</script>";
    } else {
        $query = "UPDATE 12_1_1 SET consumption_production= '$responsible', title_of_research='$title', author='$author', year_of_publication='$year_of_publication', total_number_of_citations='$total_citations', indexing_type='$indexing_type' WHERE id='$id'";
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

    $query = "DELETE FROM 12_1_1 WHERE id='$id'";
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
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #34495e;
        }
        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
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
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .edit-form-container {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Research Details</h1>
        <div class="form-container">
            <form action="" method="post">
            <div>
                    <label for="consumption_production">Total number of research on responsible consumption and production:</label>
                    <input type="text" name="consumption_production" id="consumption_production" required>
                </div>
                <div>
                    <label for="title_of_research">Title:</label>
                    <input type="text" name="title_of_research" id="title_of_research" required>
                </div>
                <div>
                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" required>
                </div>
                <div>
                    <label for="year_of_publication">Year of Publication:</label>
                    <input type="number" name="year_of_publication" id="year_of_publication" required>
                </div>
                <div>
                    <label for="total_number_of_citations">Total Citations:</label>
                    <input type="number" name="total_number_of_citations" id="total_number_of_citations" required>
                </div>
                <label for="indexing_type">Indexing Type: </label>
                <select name="indexing_type">
                    <option value="">Select</option>
                    <option value="scopus">Scopus</option>
                    <option value="web_of_science">Web of Science</option>
                    <option value="other">Other Peer Reviewed</option>
                </select>
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
                        <th>Total number of research on responsible consumption and production:</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year of Publication</th>
                        <th>Total Citations</th>
                        <th>Indexing Type</th>
                        <th>Points</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM 12_1_1";
                    $result = mysqli_query($conn, $query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $points = calculate_points($row['indexing_type']);
                            echo "<tr>
                            <td>{$row['consumption_production']}</td>
                                    <td>{$row['title_of_research']}</td>
                                    <td>{$row['author']}</td>
                                    <td>{$row['year_of_publication']}</td>
                                    <td>{$row['total_number_of_citations']}</td>
                                    <td>".$row['indexing_type']."</td>
                                    <td>".$points."</td>
                                    <td class='action-buttons'>
                                        <form action='' method='post' style='display:inline;'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <input type='hidden' name='consumption_production' value='{$row['consumption_production']}'>
                                            <input type='hidden' name='title_of_research' value='{$row['title_of_research']}'>
                                            <input type='hidden' name='author' value='{$row['author']}'>
                                            <input type='hidden' name='year_of_publication' value='{$row['year_of_publication']}'>
                                            <input type='hidden' name='total_number_of_citations' value='{$row['total_number_of_citations']}'>
                                            <input type='hidden' name='indexing_type' value='".$row['indexing_type']."'>
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
        $responsible = $_POST['consumption_production'];
        $title = $_POST['title_of_research'];
        $author = $_POST['author'];
        $year_of_publication = $_POST['year_of_publication'];
        $total_citations = $_POST['total_number_of_citations'];
        $indexing_type = $_POST['indexing_type'];

        echo "<div class='container'>
                <h2>Edit Research Details</h2>
                <div class='form-container'>
                    <form action='' method='post'>
                        <input type='hidden' name='id' value='$id'>
                        <div>
                            <label for='consumption_production'>Total number of research on responsible consumption and production:</label>
                            <input type='text' name='consumption_production' id='consumption_production' value='$responsible' required>
                        </div>
                        <div>
                            <label for='title_of_research'>Title:</label>
                            <input type='text' name='title_of_research' id='title_of_research' value='$title' required>
                        </div>
                        <div>
                            <label for='author'>Author:</label>
                            <input type='text' name='author' id='author' value='$author' required>
                        </div>
                        <div>
                            <label for='year_of_publication'>Year of Publication:</label>
                            <input type='number' name='year_of_publication' id='year_of_publication' value='$year_of_publication' required>
                        </div>
                        <div>
                            <label for='total_number_of_citations'>Total Citations:</label>
                            <input type='number' name='total_number_of_citations' id='total_number_of_citations' value='$total_citations' required>
                        </div>
                        <div class='form-row'>
                    <label for='indexing_type'>Indexing Type: </label>
                    <select name='indexing_type'>
                        <option value='scopus' ".($indexing_type == 'scopus' ? 'selected' : '').">Scopus</option>
                        <option value='web_of_science' ".($indexing_type == 'web_of_science' ? 'selected' : '').">Web of Science</option>
                        <option value='other' ".($indexing_type == 'other' ? 'selected' : '').">Other Peer Reviewed</option>
                    </select>
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
