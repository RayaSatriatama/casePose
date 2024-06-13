<?php
session_start();
include 'php/connection.php';
$id_project = $_GET["idproject"];

$rekomendasi_project = mysqli_query($conn,"SELECT u.userId AS id_user,u.profilePicture AS foto_profil
,p.userId AS id_user, p.projectId AS id_project, p.projectPicture AS foto_project
,p.projectName AS nama_project, CONCAT(u.firstName,' ',u.lastName) AS nama_lengkap_2 
FROM project p JOIN user u  ON p.userId = u.userId JOIN pricing pr ON p.projectId = pr.projectId 
ORDER BY RAND() LIMIT 3;");

$query = mysqli_query($conn,"SELECT project.*,user.*,  DATE_FORMAT(STR_TO_DATE(uploadDate, '%Y-%m-%d'), '%d %M %Y') AS tanggal_upload ,user.userId,CONCAT(user.firstName,' ',user.lastName)AS nama_lengkap FROM project JOIN user ON project.userId = user.userId AND project.projectId = '$id_project'");
$rows_project_detail = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts Roboto -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="crossorigin">
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet">
        <!-- Link Style CSS -->
        <link rel="stylesheet" href="style/nav_bar.css">
        <link rel="stylesheet" href="style/style-detail-project.css">
        <link rel="stylesheet" href="style/footer.css"/>
        <link rel="stylesheet" href="style/card.css">
        <link rel="stylesheet" href="style/global.css">

        <!-- Title -->
        <link rel="icon" href="asset/logo/logo_1.png">
        <title>Detail Project</title>
    </head>

    <body>
        <!-- Navigation Bar after-->
        <nav>
            <div class="navbar-toggle">
                <div class="navbar-logo">
                    <a href="index.php"><img src="asset/logo/logo_2.png" alt="" /></a>
                </div>
                <button class="navbar-toggle-button" onclick="toggleColor()">☰</button>
            </div>
            <div class="navbar">
                <div class="navbar-menu">
                    <a href="index.php" class="navbar-item"
                        ><span class="navbar-text">Home </span></a
                    >
                    <a href="about.php" class="navbar-item"
                        ><span class="navbar-text">About</span></a
                    >
                    <a href="pricing.php" class="navbar-item "
                        ><span class="navbar-text">Pricing</span></a
                    >
                </div>
                <div class="navbar-logo">
                    <a href="index.php"><img src="asset/logo/logo_2.png" alt="" /></a>
                </div>
                <div class="navbar-actions">
                    <a href="sign-in.php" class="navbar-button">
                        <div class="navbar-button-text">Sign In</div>
                    </a>
                    <a href="sign-in.php" class="navbar-button-alt">
                        <div class="navbar-button-text-alt">Submit Project</div>
                    </a>
                </div>
            </div>
            <script src="javascript/navbar.js"></script>
        </nav>    
        <!-- content -->
        <div class="content-detail">
            <div class="content-detail-1" style="background-image: url('asset/users/project/halaman/<?php echo $rows_project_detail["projectPicture"];?>');"></div>
            <div class="content-detail-desc ">
                <div class="content-detail-desc-head">
                    <div class="content-detail-desc-head-left">

                        <div class="content-detail-desc-head-title">
                            <label class="label_1 bold2"><?php echo $rows_project_detail["projectName"];?></label>
                        </div>

                        <div class="svg-type">
                            <div class="content-detail-desc-head-line">
                                <img src="asset/svg/Line.png" alt="">
                            </div>
                            
                            <div class="content-detail-desc-head-type">
                                <label class="label_2"><?php echo $rows_project_detail["projectType"];?></label>
                            </div>
                        </div>

                    </div>
                    
                    <div class="content-detail-desc-head-right">
                        <a href="
                        <?php
                        if($rows_project_detail["projectLink"] != "") {
                            echo $rows_project_detail["projectLink"];
                        }
                        ?>
                        " class="open-project-button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                            <label for="">
                                Open Project
                            </label>
                        </a>
                        
                    </div>
                </div>
                <div class="content-detail-desc-head-about">
                    <p><?php echo $rows_project_detail["projectDescription"];?></p>
                </div>
            </div>

            <div class="content-detail-desc">
                <div class="content-detail-more-head bold2">
                    <div class="content-detail-more-head-left">
                        <div class="content-detail-desc-head-line">
                            <img src="asset/svg/Line.png" alt="">
                        </div>
                        <div class="content-detail-desc-title">
                            <label class="label_1">MORE ABOUT PROJECT</label>
                        </div>
                    </div>
                </div>
                <div class="content-detail-list-content">
                    <div class="lbl">
                        <label for="" class="bold2 ft-20">Created</label>
                    </div>
                    <div class="content-lbl">
                        <label for="" class="grey ft-20"><?php echo $rows_project_detail["nama_lengkap"];?></label>
                    </div>
                </div>

                <div class="content-detail-list-content">
                    <div class="lbl">
                        <label for="" class="bold2 ft-20">Contact</label>
                    </div>
                    <div class="content-lbl">
                        <label for="" class="grey ft-20" ><?php echo $rows_project_detail["email"];?></label>
                    </div>
                </div>

                <div class="content-detail-list-content">
                    <div class="lbl">
                        <label for="" class="bold2 ft-20">Date</label>
                    </div>
                    <div class="content-lbl">
                        <label for="" class="grey ft-20"><?php echo $rows_project_detail["tanggal_upload"];?></label>
                    </div>
                </div>
            </div>

            <!-- more project -->
            <div class="more-project">
                <div class="more-project-1">
                    <label class="more-project-label">LET’S EXPLORE
                        <br></label>
                    <label class="more-project-label bold">ANOTHER RELATED
                        <br></h1>
                    <label class="more-project-label bold">PROJECT
                        <br></h1>
                </div>
                <div class="content_card">
                    <?php while ($rows_project2 = mysqli_fetch_assoc($rekomendasi_project)) : ?>
                        <!-- seleksi kondisi apakah yang membuka project user atau viewer -->
                        <a href=" <?php 
                            if($userId == $rows_project2["id_user"]){
                                echo 'detail_project_user.php?idproject='.$rows_project2["id_project"];
                            }else{
                                echo 'detail_project_viewer.php?idproject='.$rows_project2["id_project"];
                            }
                            ?>"><div class="card">
                            <!-- <div class="card_image" style="background-image: url('asset/card/card3.png');"> -->
                            <div class="card_image" style="background-image: url('asset/users/project/halaman/<?php echo $rows_project2["foto_project"];?>')">
                                <div class="card_image_hover"></div>
                            </div>
                            <div class="div-label">
                                <label class="roboto bold"><?php echo $rows_project2["nama_project"];?></label><br>
                                <label for=""class="roboto">by <?php echo $rows_project2["nama_lengkap_2"];?></label>
                            </div>
                        </div></a>
                    <?php endwhile ;?>
                </div>
            </div>

        </div>
  <!-- footer -->
    <footer class="footer">
        <div class="footer-navigation">
            <div class="footer-navigation-item">
                <a href="index.php" class="footer-frame"><div class="footer-text-wrapper-1">Home</div></a>
                <a href="about.php" class="footer-frame"><div class="footer-text-wrapper-1">About</div></a>
                <a href="pricing.php" class="footer-frame"><div class="footer-text-wrapper-1">Pricing</div></a>
                <a href="faqs.php" class="footer-frame"><div class="footer-text-wrapper-1">FAQs</div></a>
            </div>
            <div class="footer-navigation-button">
                <a href="https://instagram.com" class="footer-social-button" target="_blank" rel="noopener" title="Follow us on Instagram">
                    <span class="visually-hidden">Follow us on Instagram</span>
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="ri:instagram-fill">
                            <path id="Vector-icon"
                                d="M17.3707 3.1665C18.8707 3.1705 19.632 3.1785 20.2893 3.19717L20.548 3.2065C20.8467 3.21717 21.1413 3.2305 21.4973 3.2465C22.916 3.31317 23.884 3.53717 24.7333 3.8665C25.6133 4.20517 26.3547 4.66384 27.096 5.40384C27.774 6.07037 28.2986 6.87662 28.6333 7.7665C28.9627 8.61584 29.1867 9.58384 29.2533 11.0038C29.2693 11.3585 29.2827 11.6532 29.2933 11.9532L29.3013 12.2118C29.3213 12.8678 29.3293 13.6292 29.332 15.1292L29.3333 16.1238V17.8705C29.3366 18.843 29.3264 19.8156 29.3027 20.7878L29.2947 21.0465C29.284 21.3465 29.2707 21.6412 29.2547 21.9958C29.188 23.4158 28.9613 24.3825 28.6333 25.2332C28.2996 26.1235 27.7748 26.93 27.096 27.5958C26.4293 28.2736 25.6231 28.7982 24.7333 29.1332C23.884 29.4625 22.916 29.6865 21.4973 29.7532C21.181 29.7681 20.8645 29.7814 20.548 29.7932L20.2893 29.8012C19.632 29.8198 18.8707 29.8292 17.3707 29.8318L16.376 29.8332H14.6307C13.6577 29.8365 12.6847 29.8263 11.712 29.8025L11.4533 29.7945C11.1368 29.7825 10.8204 29.7687 10.504 29.7532C9.08533 29.6865 8.11733 29.4625 7.26666 29.1332C6.37689 28.799 5.57095 28.2743 4.90533 27.5958C4.22672 26.9296 3.70163 26.1233 3.36666 25.2332C3.03733 24.3838 2.81333 23.4158 2.74666 21.9958C2.73181 21.6795 2.71847 21.363 2.70666 21.0465L2.7 20.7878C2.67543 19.8156 2.66431 18.8431 2.66666 17.8705V15.1292C2.66294 14.1566 2.67272 13.1841 2.696 12.2118L2.70533 11.9532C2.716 11.6532 2.72933 11.3585 2.74533 11.0038C2.812 9.58384 3.036 8.61717 3.36533 7.7665C3.70015 6.87571 4.22629 6.0692 4.90666 5.40384C5.57212 4.7258 6.37752 4.20115 7.26666 3.8665C8.11733 3.53717 9.084 3.31317 10.504 3.2465C10.8587 3.2305 11.1547 3.21717 11.4533 3.2065L11.712 3.1985C12.6843 3.17481 13.6568 3.16459 14.6293 3.16784L17.3707 3.1665ZM16 9.83317C14.2319 9.83317 12.5362 10.5355 11.286 11.7858C10.0357 13.036 9.33333 14.7317 9.33333 16.4998C9.33333 18.2679 10.0357 19.9636 11.286 21.2139C12.5362 22.4641 14.2319 23.1665 16 23.1665C17.7681 23.1665 19.4638 22.4641 20.714 21.2139C21.9643 19.9636 22.6667 18.2679 22.6667 16.4998C22.6667 14.7317 21.9643 13.036 20.714 11.7858C19.4638 10.5355 17.7681 9.83317 16 9.83317ZM16 12.4998C16.5253 12.4998 17.0454 12.6031 17.5308 12.8041C18.0161 13.005 18.4571 13.2996 18.8286 13.6709C19.2001 14.0423 19.4948 14.4832 19.6959 14.9685C19.897 15.4538 20.0006 15.9739 20.0007 16.4992C20.0007 17.0245 19.8974 17.5446 19.6964 18.03C19.4955 18.5153 19.2009 18.9563 18.8296 19.3278C18.4582 19.6993 18.0173 19.994 17.532 20.1951C17.0467 20.3962 16.5266 20.4998 16.0013 20.4998C14.9405 20.4998 13.923 20.0784 13.1729 19.3283C12.4228 18.5781 12.0013 17.5607 12.0013 16.4998C12.0013 15.439 12.4228 14.4216 13.1729 13.6714C13.923 12.9213 14.9405 12.4998 16.0013 12.4998M23.0013 7.83317C22.5593 7.83317 22.1354 8.00877 21.8228 8.32133C21.5103 8.63389 21.3347 9.05781 21.3347 9.49984C21.3347 9.94186 21.5103 10.3658 21.8228 10.6783C22.1354 10.9909 22.5593 11.1665 23.0013 11.1665C23.4434 11.1665 23.8673 10.9909 24.1798 10.6783C24.4924 10.3658 24.668 9.94186 24.668 9.49984C24.668 9.05781 24.4924 8.63389 24.1798 8.32133C23.8673 8.00877 23.4434 7.83317 23.0013 7.83317Z"
                                fill="white" />
                        </g>
                    </svg>
                </a>
                <a href="https://linkedin.com" class="footer-social-button" target="_blank" rel="noopener" title="Connect with us on LinkedIn">
                    <span class="visually-hidden">Connect with us on LinkedIn</span>
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector-icon"
                            d="M9.25338 7.16654C9.25302 7.87378 8.97173 8.55192 8.47139 9.05176C7.97104 9.55161 7.29262 9.83222 6.58538 9.83187C5.87813 9.83152 5.2 9.55022 4.70015 9.04988C4.2003 8.54953 3.91969 7.87111 3.92004 7.16387C3.9204 6.45662 4.20169 5.77849 4.70204 5.27864C5.20238 4.77879 5.8808 4.49818 6.58804 4.49854C7.29529 4.49889 7.97342 4.78018 8.47327 5.28053C8.97312 5.78087 9.25373 6.45929 9.25338 7.16654ZM9.33338 11.8065H4.00004V28.4999H9.33338V11.8065ZM17.76 11.8065H12.4534V28.4999H17.7067V19.7399C17.7067 14.8599 24.0667 14.4065 24.0667 19.7399V28.4999H29.3334V17.9265C29.3334 9.69987 19.92 10.0065 17.7067 14.0465L17.76 11.8065Z"
                            fill="white" />
                    </svg>
                </a>
                <a href="https://twitter.com" class="footer-social-button" target="_blank" rel="noopener" title="Follow us on Twitter">
                    <span class="visually-hidden">Follow us on Twitter</span>
                    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector-icon"
                            d="M24.2733 3.5H28.684L19.048 14.5133L30.384 29.5H21.5067L14.5547 20.4107L6.59999 29.5H2.18666L12.4933 17.72L1.62 3.5H10.72L17.004 11.808L24.2733 3.5ZM22.7253 26.86H25.1693L9.39333 6.00133H6.77066L22.7253 26.86Z"
                            fill="white" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-logo">
            <div class="footer-copyright">
                <div class="footer-text-wrapper-2">casePose</div>
                <div class="footer-text-wrapper-3">© 2024</div>
            </div>
        </div>
    </footer>
</body>

</html>