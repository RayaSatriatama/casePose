<?php
session_start();
include '../php/connection.php';

// Cek status login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "loginadmin") {
    header("Location: index.php?pesan=belum_login");
    exit();
}

// Query untuk mendapatkan ranking proyek
$sql = "
SELECT 
    u.userId, 
    u.firstName, 
    u.lastName, 
    COUNT(p.projectId) AS projectCount,
    RANK() OVER (ORDER BY COUNT(p.projectId) DESC) AS rank
FROM 
    user u
LEFT JOIN 
    project p ON u.userId = p.userId
GROUP BY 
    u.userId, u.firstName, u.lastName
ORDER BY 
    projectCount DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Admin</title>
    <link rel="stylesheet" href="../style/admin-home.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/style-detail-project.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../asset/logo/logo_1.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

<div class="content">
    <div class="side-bar">
        <div class="content-side-bar-head">
            <div class="img-casepose"></div>
        </div>
        <div class="side-bar-navigation">
            <a href="home.php">
                <div class="list-navigation ">
                    <!-- SVG icon for Dashboard -->
                    Dashboard
                </div>
            </a>
            <a href="project.php">
                <div class="list-navigation ">
                    <!-- SVG icon for Project -->
                    Project
                </div>
            </a>
            <a href="report.php">
                <div class="list-navigation">
                    <!-- SVG icon for Report -->
                    Report
                </div>
            </a>
            <a href="rank_project.php">
                <div class="list-navigation active">
                    <!-- SVG icon for Rank Project -->
                    Rank Project
                </div>
            </a>
        </div>

        <a href="../php/admin/log-out-admin.php">
            <div class="list-logout">
                <!-- SVG icon for Logout -->
                <label for="">Logout</label>
            </div>
        </a>
    </div>

    <div class="main-content">
        <div class="main-content-head">
            <label for="">Rank Project</label>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Project Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["rank"] . "</td>";
                        echo "<td>" . $row["userId"] . "</td>";
                        echo "<td>" . $row["firstName"] . "</td>";
                        echo "<td>" . $row["lastName"] . "</td>";
                        echo "<td>" . $row["projectCount"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No results found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>