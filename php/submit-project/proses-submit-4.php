<?php
session_start();
include '../../php/connection.php';

$userId = $_SESSION["userId"];
$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$projectType = $_POST["projectType"];
$projectLink = $_POST["projectLink"];
$projectDate = $_POST["projectDate"];
$name_file = $_POST['projectPicture'];
$projectTag = $_POST["projectTag"];
$projectStatus = $_POST["projectStatus"];

if (empty($projectName) || empty($projectDescription) || empty($projectType) || empty($projectLink) || empty($projectTag) || empty($projectStatus)) {
    header("Location: ../../after/submit-project/submit-project-4.php?" .
        "projectName=$projectName&projectDescription=$projectDescription&projectType=$projectType" .
        "&projectLink=$projectLink&projectPicture=$name_file" .
        "&projectTag=$projectTag&projectStatus=$projectStatus&pesan=kosong");
    exit();
} else {
    if (strlen($projectName) > 40) {
        header("Location: ../../after/submit-project/submit-project-4.php?" .
            "projectName=$projectName&projectDescription=$projectDescription&projectType=$projectType" .
            "&projectLink=$projectLink&projectPicture=$name_file" .
            "&projectTag=$projectTag&projectStatus=$projectStatus&pesan=project-name-length-40");
        exit();
    } else {
        if (substr($projectLink, 0, 8) !== "https://") {
            header("Location: ../../after/submit-project/submit-project-4.php?" .
                "projectName=$projectName&projectDescription=$projectDescription&projectType=$projectType" .
                "&projectLink=$projectLink&projectPicture=$name_file" .
                "&projectTag=$projectTag&projectStatus=$projectStatus&pesan=https");
            exit();
        } else {
            if (strlen($projectTag) > 255) {
                header("Location: ../../after/submit-project/submit-project-4.php?" .
                    "projectName=$projectName&projectDescription=$projectDescription&projectType=$projectType" .
                    "&projectLink=$projectLink&projectPicture=$name_file" .
                    "&projectTag=$projectTag&projectStatus=$projectStatus&pesan=project-tag-length-255");
                exit();
            } else {
                $lengt = mysqli_query($conn, "SELECT COUNT(projectId) AS total FROM project");
                $hasil = mysqli_fetch_assoc($lengt);
                $new_id = $projectName . ($hasil["total"] + 1);

                // Menggunakan prepared statement untuk menghindari SQL injection
                $stmt = $conn->prepare("INSERT INTO project (projectId, projectName, projectDescription, projectType, projectLink, uploadDate, projectPicture, projectTag, projectStatus, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssss", $new_id, $projectName, $projectDescription, $projectType, $projectLink, $projectDate, $name_file, $projectTag, $projectStatus, $userId);

                if ($stmt->execute()) {
                    echo "Data berhasil ditambahkan";
                    header("Location: ../../after/index.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    }
}

$conn->close();
?>
