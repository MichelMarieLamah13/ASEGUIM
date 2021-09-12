<?php $title = "Notifications"; ?>
<?php include('partials/_header.php'); ?>
<div id="main-content">
    <div class="container">
        <h1 class="lead">Vos notifications</h1>
        <ul class="list-group">
            <?php foreach($notifications as $notification): ?>
                <li class="list-group-item <?= $notification->seen == '0' ? 'not_seen' : '' ?>" >
                    <?php require("partials/notifications/{$notification->name}.php" ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="pagination"><?= $pagination ?></div>
    </div>
</div>
<!-- SCRIPTS -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".timeago").timeago();
    });
</script>
</body>
</html>
