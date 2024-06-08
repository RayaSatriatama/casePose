<?php
include '../php/connection.php';
$userId = $_SESSION["userId"];

$sqlp_1 = mysqli_query($conn," SELECT p.userId AS id_user,p.projectId AS id_project
,p.projectPicture AS foto_project,p.projectName AS nama_project, 
CONCAT(u.firstName,' ',u.lastName) AS nama_lengkap_2 FROM project p 
JOIN user u ON p.userId = u.userId WHERE p.userId = '$userId'");

$sqlp_2 = mysqli_query($conn,"SELECT u.userId AS id_user,u.profilePicture AS foto_profil
,p.userId AS id_user, p.projectId AS id_project, p.projectPicture AS foto_project
,p.projectName AS nama_project, CONCAT(u.firstName,' ',u.lastName) AS nama_lengkap_2 
FROM project p JOIN user u ON p.userId = u.userId");

$sql_pricing = mysqli_query($conn,"SELECT p.projectId, p.projectName
FROM project p
JOIN user u ON p.userId = u.userId WHERE p.userId = '$userId'
");

$sql_pricing_2 = mysqli_query($conn, "
    SELECT p.projectId, p.projectName, pr.pricingPackage, pr.dateExpired 
    FROM project p 
    JOIN pricing pr ON p.projectId = pr.projectId 
    WHERE p.userId = '$userId'
");

$sql_pricing_limit = mysqli_query($conn, "
    SELECT p.projectId, p.projectName, pr.pricingPackage, pr.dateExpired , u.profilePicture
    FROM project p 
    JOIN pricing pr JOIN user u ON p.projectId = pr.projectId AND p.userId = u.userId
    WHERE p.userId = '$userId'
    ORDER BY RAND()
    LIMIT 3
");

?>