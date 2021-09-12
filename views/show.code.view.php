<?php $title = "Affichage de codes sources"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div id="main-content-share-code">
        <pre class="prettyprint linenums"><?= e($data->code); ?></pre>
        <div class="btn-group navb">
            <a href="share.code.php?id=<?=e($_GET['id'])?>" class="btn btn-warning">Cloner</a>
            <a href="share.code.php" class="btn btn-primary">Nouveau</a>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.js"></script>
<!---Pretiffy.js---------------------------->
<script src="assets/js/google-code-prettify/prettify.js"></script>
<script>
    prettyPrint();
</script>
</body>
</html>