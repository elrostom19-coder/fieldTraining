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
<style>
    /* #x{
        padding-top: 50px;
        padding-bottom: 50px;
        padding-left: 50px;

        background-color: gray;
        box-shadow: 10px 10px 10px gray;
    } */

        .x {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #6c757d; /* رمادي متناسق */
            padding-top: 20px;
            padding-bottom: 20px;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3); /* ظل أنعم قليلاً */
        }
    </style>

<body>
  <div class="card" style="margin-top: 30px; width: 90%; max-width: 1200px; margin-left: auto; margin-right: auto;">
    <div class="card-title"><h3 style="margin-bottom: 15px;">Student Grade Search</h3></div>
    <div class="card-body">
        <!-- Search Form -->
        <form method="POST" style="margin-bottom: 20px;">
            <input type="text" name="search" placeholder="Search by name..." style="padding: 8px; width: 250px;" required>
            <button type="submit" style="padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Search</button>
        </form>

        <table style="width: 100%; border-collapse: collapse;">
            <thead> 
                <tr style="background-color: #f2f2f2; text-align: left;">
                    <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">NAME</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">SCORE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
                    $search = trim($_POST["search"]);
                    $search_escaped = mysqli_real_escape_string($conn, $search);
                    $search_sql = "SELECT * FROM students WHERE name LIKE '%$search_escaped%'";
                    $search_result = mysqli_query($conn, $search_sql);
                    
                    if ($search_result && mysqli_num_rows($search_result) > 0) {
                        while ($search_row = mysqli_fetch_assoc($search_result)) {
                            ?>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($search_row["id"]) ?></td>
                                <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($search_row["name"]) ?></td>
                                <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($search_row["score"]) ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="3" style="padding: 10px; text-align: center; border: 1px solid #ddd;">No students found.</td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>