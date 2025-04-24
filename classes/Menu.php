<?php
class Menu {
    private array $validateMenuTypes = ["header", "footer"];

    public function isValidMenuType(string $type): bool {
        return in_array($type, $this->validateMenuTypes);
    }
    public function getMenuData(string $type): array {
        if (!$this->isValidMenuType($type)) {
            throw new InvalidArgumentException("Invalid menu type: $type");
        }
        $menuData = [
            "header" => [
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
                ],
            ],
        ];
        return $menuData[$type];
    }
    public function printMenu(array $menu): void {
        foreach ($menu as $menuName => $menuItem) {
            echo '<li><a href="' . $menuItem['path'] . '">' . $menuItem['name'] . '</a></li>';
        }
    }

    public function printLoginRegister(): void{
        session_start();
        if (isset($_SESSION['login'])) {
            echo '<li> <a href= db/logout.php >Prihlásený:' . $_SESSION['login'] . ' (' . $_SESSION['rola'] . ')'.'</a> </li> ';
        } else {
            echo '<li> <a href="/sablona/signin.php">Prihlásiť/Registrovať</a> </li>';
        }
    }
}