<?php
include '../connection.php';
session_start();
$userId = $_SESSION["userId"];

$id_project = $_POST["projectId"];
$projectName = $_POST["projectName"];
$projectDescription = $_POST["projectDescription"];
$projectType = $_POST["projectType"];

// Cek apakah projectName, projectDescription, atau projectType kosong
if (empty($projectName) || empty($projectDescription) || empty($projectType)) {
    header("Location: ../../after/edit-project/edit-project-1.php?pesan=kosong&idproject=$id_project");
} else {
    if (strlen($projectName) > 40) {
        // Redirect jika panjang melebihi 40 karakter
        header("Location: ../../after/edit-project/edit-project-1.php?pesan=project-name-length-40&idproject=$id_project");
    } else {
        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("UPDATE project SET projectName = ?, projectDescription = ?, projectType = ? WHERE projectId = ?");
        $stmt->bind_param("ssss", $projectName, $projectDescription, $projectType, $id_project);

        if ($stmt->execute()) {
            $sql = mysqli_query($conn, "SELECT MAX(id) AS last_id FROM logactivity");
            $hasil = mysqli_fetch_assoc($sql);
            $last_id = $hasil["last_id"];
            $trigger = mysqli_query($conn, "UPDATE logactivity SET userId = '$userId' WHERE id = '$last_id'");

            header("Location: ../../after/edit-project/edit-project-1.php?pesan=sukses&idproject=$id_project");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
