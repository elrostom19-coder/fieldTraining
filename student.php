<?php
require_once("navbar.php");
require_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid" style="display:flex;flex-direction:row; justify-content: space-evenly; ">
        <form style="width: 300px; margin-top:30px" method="POST">
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputName">

            </div>
            <div class="mb-3">
                <label for="exampleInputScore" class="form-label">Score</label>
                <input type="number" name="score" class="form-control" id="exampleInputScore">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
<?php
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); 
    $delete_query = "DELETE FROM students WHERE id = $id";
    mysqli_query($conn, $delete_query);
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<div class="card" style="margin-top: 30px; width: 60%; max-width: 1200px; margin-left: auto; margin-right: auto;">
    <div class="card-title" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Score Sheet</div>
    <div class="card-body">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #ddd;"> ID </th>
                    <th style="padding: 10px; border: 1px solid #ddd;"> Name </th>
                    <th style="padding: 10px; border: 1px solid #ddd;"> Score </th>
                    <th style="padding: 10px; border: 1px solid #ddd;"> Action </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $select = "SELECT * FROM students";
                $selectquery = mysqli_query($conn, $select);
                
                while ($row = mysqli_fetch_assoc($selectquery)) {
                    ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <?= htmlspecialchars($row["id"]) ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <?= htmlspecialchars($row["name"]) ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <?= htmlspecialchars($row["score"]) ?>
                        </td>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <?php 
                            if ($row["score"] >= 50) {
                                echo '<p style="color: green; display: inline; margin-right: 15px;">pass</p>';
                            } else {
                                echo '<p style="color: red; display: inline; margin-right: 15px;">fail</p>';
                            }
                            ?>
                            <a href="?delete=<?= $row["id"] ?>" 
                               style="background-color: red; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px;"
                               onclick="return confirm('Are you sure you want to delete this student?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

   
    </div>
</body>

</html>


<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $score = $_POST["score"];
    $error = [];
    $sqlInsert = "INSERT INTO students( name, score) VALUES ('$name',$score)";
    $resultInsert = mysqli_query($conn, $sqlInsert);
    if (!$resultInsert) {
        die("no");
    }
    if (empty($name) || strlen($name < 3)) {
        die("no");
    }
    if (!is_numeric($score)) {
        die("no");
    }
}



?>