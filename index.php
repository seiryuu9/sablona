<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
include_once "../sablona/parts/header.php";
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