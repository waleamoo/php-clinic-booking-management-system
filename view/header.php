<!DOCTYPE html>
<html lang="en"><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../assets/images/botlokwa.png">
        <title>Botlokwa Health Care</title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
        <!-- JS Files -->
        <script src="../assets/js/jquery-3.1.1.js" type="text/javascript"></script>
        <script src="../assets/js/main.js" type="text/javascript"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="?action=index"><img src="../assets/images/botlokwa.png" alt="Logo" style="border-radius: 10px;" width="30" height="30" class="img-responsive"/></a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="?action=supplement_shop">Shop Supplements</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services 
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <?php 
                            $cats = get_consultation_categories();
                            ?>
                            <?php foreach($cats as $cat): ?>
                            <a class="dropdown-item" href="?action=get_consultation&id=<?php echo $cat["c_id"]; ?>"><?php echo $cat["c_name"]; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=about">About Botlokwa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="?action=register">Register at Botlokwa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="?action=cart">
                            <i class="fas fa-shopping-cart fa-1x"></i> <span class="badge badge-danger badge-secondary"><div id="cart_count"></div></span>
                        </a>
                    </li>
                        
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search services" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <br><br>