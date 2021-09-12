<?php $title = "Page de profile"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Profile de <?= e($user->pseudo); ?>&nbsp;
                            (<?= friends_count(); ?>&nbsp;ami<?= friends_count() > 1 ? 's' : '' ?>)
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?= $user->avatar ?: get_avatar_url($user->email, 100); ?>"
                                     alt="Image de profile de <?= e($user->pseudo); ?>"
                                     class="avatar-md">
                            </div>
                            <div class="col-md-7">
                                <?php if (!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')): ?>
                                    <?php require('partials/_relation.link.php'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="fas fa-user"></i>
                                <strong><?= e($user->pseudo); ?></strong> <br>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:<?= e($user->email); ?>"><?= e($user->email); ?></a><br>
                                <?=
                                e($user->city) && e($user->country) ? '<i class="fas fa-location"></i>&nbsp;' . e($user->city) . ' - ' . e($user->country) . '<br>' : '';
                                ?>
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps?q=<?= e($user->city) . ' ' . e($user->country) ?>"
                                   target="_blank">Voir
                                    sur Google Maps</a>

                            </div>
                            <div class="col-sm-6">
                                <?=
                                e($user->twitter) ? '<i class="fab fa-twitter"></i>&nbsp;<a href="//twitter.com/' . e($user->twitter) . '">@' . e($user->twitter) . '</a><br>' : '';
                                ?>
                                <?=
                                e($user->github) ? '<i class="fab fa-github"></i>&nbsp;<a href="//github.com/' . e($user->github) . '">@' . e($user->github) . '</a><br>' : '';
                                ?>
                                <?php
                                if (e($user->sex) == 'H') {
                                    echo '<i class="fas fa-male"></i>';
                                } elseif (e($user->sex) == 'H') {
                                    echo '<i class="fas fa-female"></i>';
                                } else {
                                    echo '';
                                }
                                ?>
                                <?=
                                e($user->available_for_hiring) ? 'Disponible pour emploi' : 'Non disponible pour emploi';
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 well">
                                <h5>Petite biographie de <?= e($user->name) ?></h5>
                                <?=
                                e($user->bio) ? nl2br(e($user->bio)) : 'Aucune biographie pour le moment';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <?php if ((!empty($_GET['id']) && $_GET['id'] === get_session('user_id'))): ?>
                    <div class="status-post">
                        <!--Pour afficher les messages d'erreurs-->
                        <?php require_once('partials/_errors.php'); ?>
                        <!----------------------------------------->
                        <form action="microposts.php" method="post" data-parsley-validate>
                            <div class="form-group">
                                <label for="content" class="sr-only">Status:</label>
                            <textarea name="content" id="content" rows="3" class="form-control" minlength="3"
                                      maxlength="140" data-parsley-maxlength="140"
                                      data-parsley-minlength="3" data-parsley-trigger="keypress"
                                      placeholder="Alors quoi de neuf" required></textarea>
                            </div>
                            <div class="form-group status-post-submit">
                                <input type="submit" name="publish" value="Publier" class="btn btn-default btn-xs">
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

                <?php if(is_already_friend()): ?>
                    <?php if (count($microposts) != 0): ?>
                        <?php foreach ($microposts as $micropost): ?>
                            <?php require('partials/_micropost.php'); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Cet utilisateur n'a encore rien posté pour le moment</p>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

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
<!-- Timeago -->
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<!--<script src="assets/js/jquery.livequery.min.js"></script>-->
<!--Sweet alert-->
<script src="libraries/sweetAlert/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<!-- Parsley -->
<script src="libraries/parsley/parsley.min.js"></script>
<script src="libraries/parsley/i18n/fr.js"></script>
<script>
    window.ParsleyValidator.setLocale('fr');
</script>
<!-- Timeago and Livequery-->
<script>
    $(document).ready(function () {
        $('.timeago').timeago();

        $("a.like").on("click", function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            var url = 'ajax/micropost.like.php';
            /*var action=$(this).attr("data-action");*/
            var action = $(this).data("action");
            var micropostId = id.split("like")[1];
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    micropost_id: micropostId,
                    action: action
                },
                success: function (likers) {
                    $("#likers_" + micropostId).html(likers);
                    if (action == 'like') {
                        $("#" + id).html("<i class='fas fa-thumbs-down'></i> Je n'aime pas").data("action", "unlike");
                    } else {
                        $("#" + id).html("<i class='fas fa-thumbs-up'></i> J'aime").data("action", "like");
                    }
                }
            });
        });
    });
</script>

<!--<script>
    $(document).ready(function() {
        $('.timeago').livequery(function() {
            $(this).timeago();
        });
    });
</script>-->
</body>
</html>