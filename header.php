<?
function get_address(){
    return substr($_SERVER['REQUEST_URI'],6);
};
?>

<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>UnderWatch GM Tool</title>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- W3.CSS Template -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <!-- Font Awesome SVG -->
    <link rel="stylesheet" href="fontawesome/css/fontawesome-all.css">

    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
</head>

<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
    <span class="w3-bar-item w3-right">UnderWatch GM Tool</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container">
        <h5>Dashboard</h5>
    </div>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <a href="battle_input.php" class="w3-bar-item w3-button w3-padding <? if(get_address() == "battle_input.php") echo "w3-green"; ?>"><i class="fas fa-plus fa-fw"></i>  Input Battle</a>
        <a href="player_list.php" class="w3-bar-item w3-button w3-padding <? if(get_address() == "player_list.php") echo "w3-blue"; ?>"><i class="fa fa-users fa-fw"></i>  Player</a>
        <a href="hero_list.php" class="w3-bar-item w3-button w3-padding <? if(get_address() == "hero_list.php") echo "w3-blue"; ?>"><i class="fa fa-eye fa-fw"></i>  Hero</a>
        <a href="skin_list.php" class="w3-bar-item w3-button w3-padding <? if(get_address() == "skin_list.php") echo "w3-blue"; ?>"><i class="fa fa-users fa-fw"></i>  Skin</a>
        <a href="rarity_list.php" class="w3-bar-item w3-button w3-padding <? if(get_address() == "rarity_list.php") echo "w3-blue"; ?>"><i class="fa fa-users fa-fw"></i>  Rarity</a>
    </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">