<?php
include_once "../sablona/parts/header.php";
?>

<?php
include_once "../sablona/parts/nav.php";
?>

        <main>
            <section class="banner">
                <div class="container text-white">
                    <h1>Portfólio</h1>
                </div>
            </section>
              <section class="container">
                  <?php
                  finishPortfolio();
                  ?>
            </section>   

        </main>
    <?php
    include_once "../sablona/parts/footer.php";
    ?>
    <script src="js/menu.js"></script>
    </body>
</html>