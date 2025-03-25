<?php

function pozdrav() {
    $hour = date('H');
    if ($hour < 12) {
        echo "<h3>Dobré ráno</h3>";
    } elseif ($hour < 18) {
        echo "<h3>Dobrý deň</h3>";
    } else {
        echo "<h3>Dobrý večer</h3>";
    }
}

function generateSlides($dir) {
    $files = glob($dir . "/*.jpg");
    $json = file_get_contents("data/datas.json");
    $data = json_decode($json, true);
    $text = $data["text_banner"];

        foreach ($files as $file) {
            echo '<div class="slide fade">';
            echo '<img src="' . $file . '">';
            echo '<div class="slide-text">';

            echo ($text[basename($file)]);
            echo '</div>';
            echo '</div>';
        }
}

function otazkyyy(){
    $json = file_get_contents("data/datas.json");
    $data = json_decode($json, true);    $otazky = $data["otazky"];
    $odpovede = $data["odpovede"];
    echo '<section class="container" >';
    for ($i = 0; $i < count($otazky); $i++) {
        echo '<div class="accordion">
                <div class="question">'.
                    $otazky[$i].'
                </div>
                <div class="answer">'.
                    $odpovede[$i].'
                </div>              
                </div>';
    }
    echo '</section>';
}

function validateMenuType(string $type): bool
{
    $menuTypes = [
        "header",
        "footer"
    ];
    if(in_array($type, $menuTypes)) {
        return true;
    } else {
        return false;
    }
}

function getMenuData(string $type): array{
    $menu = [];
    if(validateMenuType($type)) {
        if($type === "header") {
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'portfolio' => [
                    'name' => 'Portfólio',
                    'path' => 'portfolio.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]
            ];
        }
    }
    return $menu;
}

function printMenu(array $menu){
    foreach ($menu as $menuName => $menuData) {
        echo '<li><a href="'.$menuData['path'].'">'.$menuData['name'].'</a></li>';
    }
}

function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array{
    $portfolio = [];
    $colIndex = 1;
    for ($i = 1; $i <= $numberOfRows; $i++) {
        for($j = 1; $j <= $numberOfCols; $j++) {
            $portfolio[$i][$j] = $colIndex;
            $colIndex++;
        }
    }
    return $portfolio;
}


function getCSS(){
    $jsonStr = file_get_contents("data/datas.json");
    $data = json_decode($jsonStr, true);
    $stranka = basename($_SERVER['REQUEST_URI']);
    $stranka = explode(".", $stranka)[0];
    $suboryCSS = $data['stranky'][$stranka];
    foreach ($suboryCSS as $subor) {
        echo "<link rel='stylesheet' href='$subor'>";
    }
}

function finishPortfolio() {
    $portfolioData = preparePortfolio();
    $data = json_decode(file_get_contents("data/datas.json"), true);
    foreach ($portfolioData as $row => $col) {
        echo '<div class="row">';
        foreach ($col as $index) {
            $text = $data["portfolio-text-url"]["portfolio{$index}.jpg"]["text"];
            $link = $data["portfolio-text-url"]["portfolio{$index}.jpg"]["link"];
            echo '<a id="portfolio-' . $index . '" class="col-25 portfolio" href="' . $link . '">';
            echo '    <div class="text-center">';
            echo          $text;
            echo '    </div>';
            echo '</a>';
        }
        echo '</div>';
    }
}

?>

