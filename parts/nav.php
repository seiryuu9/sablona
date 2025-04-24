<body>

<?php
include "classes/Menu.php";
$menuManager = new Menu();
$theme = isset($_GET["theme"]) ? $_GET["theme"] : "light";
session_start();
$_SESSION['theme'] = $theme;
?>
<header style="background-color: <?php echo $theme === "dark" ? "grey" : "white"; ?>"
        class="container main-header">
    <div  class="logo-holder">
        <a href="<?php echo (isset($menuManager->getMenuData("header")['home']['path'])) ?
            $menuManager->getMenuData("header")['home']['path'] : ''; ?>">
            <img alt="img" src="img/logo.png" height="40">
        </a>
    </div>
    <nav class="main-nav">
        <ul class="main-menu" id="main-menu container">
            <li> <a href=<?php echo $theme === "dark" ? "?theme=light" : "?theme=dark"; ?> >Zmena témy</a> </li>
            <?php
            // Overenie validácie typu navigácie
            if ($menuManager->isValidMenuType("header")) {
                $menuData = $menuManager->getMenuData("header");
                $menuManager->printMenu($menuData);
            } else {
                echo "Neplatný typ menu";
            };
            echo $menuManager->printLoginRegister()
            ?>
        </ul>
        <a class="hamburger" id="hamburger">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</header>