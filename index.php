<?php
include_once "../sablona/parts/header.php";
?>

<?php
include_once "../sablona/parts/nav.php";
?>
    
    <main>
      <section class="slides-container">
        <?php
        include_once "functions.php";
        generateSlides("../sablona/img/banners");
        ?>
        
        <a id="prev" class="prev">❮</a>
        <a id="next" class="next">❯</a>
        
      </section>
      <section class="container">
        <div class="row">
          <div class="col-100 text-center">
            <?php
                pozdrav();
              ?>


          </div>
        </div>
      </section>
    </main>
    
<?php
include_once "../sablona/parts/footer.php";
?>

    <script src="js/menu.js"></script>
    <script src="js/slider.js"></script>
</body>
</html>