<?php
include_once "../sablona/parts/header.php";
?>

<?php
include_once "../sablona/parts/nav.php";
?>
  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Q&A</h1>
      </div>
    </section>
    <section class="container" style="background-color: <?php echo $theme === "dark" ? "darkgrey" : "white"; ?>">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Elit culpa id mollit irure sit. Ex ut et ea esse culpa officia ea incididunt elit velit veniam qui. Mollit deserunt culpa incididunt laborum commodo in culpa.</em></strong></p>
        </div>
      </div>
    </section>
    <section class="container" style="background-color: <?php echo $theme === "dark" ? "grey" :  "white"; ?>">

        <?php
        include_once "classes/qna.php";
        use otazkyodpovede\QnA;

        $qna = new QnA(); //nova instancia triedy QnA do premennej
        $qna->insertQnA(); //zavola metodu na objekt qna
        $qna->getQnA();
        ?>

    </section>

  </div>
  </main>
<?php
include_once "../sablona/parts/footer.php";
?>
<script src="js/accordion.js"></script>
<script src="js/menu.js"></script>
</body>
</html>