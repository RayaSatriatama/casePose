<?php
include '../connection.php';
session_start();
$userId = $_SESSION["userId"];

// Ambil data dari form
$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$projectType = $_POST["projectType"];

// Cek apakah projectName, projectDescription, atau projectType kosong
if (empty($projectName) || empty($projectDescription) || empty($projectType)) {
    header('Location: ../../after/submit-project/submit-project-1.php?pesan=kosong');
    exit();
} else {
    if (strlen($projectName) > 40) {
        // Redirect jika panjang melebihi 40 karakter
        header('Location: ../../after/submit-project/submit-project-1.php?pesan=project-name-length-40');
        exit();
    } else {
        // Menghasilkan projectId unik
        $result = $conn->query("SELECT COUNT(*) AS total FROM project");
        $row = $result->fetch_assoc();
        $new_id = $projectName . ($row['total'] + 1);

        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("INSERT INTO project (projectId, projectName, projectDescription, projectType, userId) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $new_id, $projectName, $projectDescription, $projectType, $userId);

        if ($stmt->execute()) {
            header('Location: ../../after/submit-project/submit-project-2.php?pesan=sukses');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
