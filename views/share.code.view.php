<?php $title = "Partage de codes sources"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div id="main-content-share-code">
        <form autocomplete="off" method="post">
            <textarea name="code" id="code" placeholder="<?= $contenu['share1'][get_session('locale')] ?>"
                      required><?= e($code); ?></textarea>

            <div class="btn-group navb">
                <a href="share.code.php" class="btn btn-danger"><?= $contenu['share2'][get_session('locale')] ?></a>
                <input type="submit" name="save" value="<?= $contenu['share3'][get_session('locale')] ?>" class="btn btn-success">
            </div>

        </form>
    </div>
    <!-- /.container -->
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.js"></script>
<!---Tabby.js---------------------------->
<script src="assets/js/tabby.js"></script>

<script>
    $('#code').tabby();
    $('#code').height($(window).height() - 95);
</script>

</body>
</html>