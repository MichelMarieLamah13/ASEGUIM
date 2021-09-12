<?php $title = "Edition de profile"; ?>
<?php require_once("partials/_header.php"); ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <?php if ((!empty($_GET['id']) && $_GET['id'] === get_session('user_id'))): ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Completer Mon profile</h3>
                        </div>
                        <div class="panel-body">
                            <!--Pour afficher les messages d'erreurs-->
                            <?php require_once('partials/_errors.php'); ?>
                            <!----------------------------------------->
                            <form data-parsley-validate method="post" class="well" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Nom <span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control" id="name"
                                                   name="name" value="<?= get_input('name') ?: e($user->name) ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="city">Ville <span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control" id="city"
                                                   name="city" value="<?= get_input('city') ?: e($user->city) ?>"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="avatar">Changer mon avatar</label>
                                            <input type="file" name="avatar" id="avatar" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="sex">Sexe</label>
                                            <select name="sex" id="sex" class="form-control">
                                                <option value="H" <?= e($user->sex) == "H" ? "selected" : "" ?>>Homme
                                                </option>
                                                <option value="F" <?= e($user->sex) == "F" ? "selected" : "" ?>>Femme
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="country">Country<span
                                                    class="text-danger">*</span></label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="country"
                                                   name="country"
                                                   value="<?= get_input('country') ?: e($user->country) ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="twitter">Twitter</label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="twitter"
                                                   name="twitter"
                                                   value="<?= get_input('twitter') ?: e($user->twitter) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="github">Github</label>
                                            <input data-parsley-minlength="3" type="text" class="form-control"
                                                   id="github"
                                                   name="github" value="<?= get_input('github') ?: e($user->github) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="checkbox" name="available_for_hiring"
                                                   id="available_for_hiring" <?= e($user->available_for_hiring) ? "checked" : "" ?>>
                                            <label class="control-label" for="available_for_hiring">Disponible pour
                                                emploi </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="bio">Biographie <span class="text-danger">*</span></label>
                                            <textarea name="bio" id="bio" cols="30" rows="10" class="form-control"
                                                      placeholder="Je suis un amoureux de la programmation"
                                                      required><?= get_input('bio') ?: e($user->bio) ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Valider" name="update">

                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- /.container -->
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>
<!-- Uploadify-->
<script src="libraries/uploadify/jquery.uploadify-3.1.js"></script>
<!--Alertify-->
<script src="libraries/alertifyjs/alertify.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.js"></script>
<!-- Parsley -->
<script src="libraries/parsley/parsley.min.js"></script>
<script src="libraries/parsley/i18n/fr.js"></script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#avatar').uploadify({
            'buttonText' : 'Parcourir',
            'fileObjName' : 'avatar',
            'fileTypeDesc' : 'Image Files',
            'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png',
            'formData'     : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                'user_id'   : "<?= get_session('user_id')?>",
                '<?php echo session_name();?>' : '<?php echo session_id();?>'
            },
            'swf'      : './libraries/uploadify/uploadify.swf',
            'uploader' : './libraries/uploadify/uploadify.php',
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alertify.error('The file ' + file.name + ' could not be uploaded: ' + errorString);
            },
            'onUploadSuccess' : function(file, data, response) {
                alertify.success('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                window.location='/profile.php';
            }
        });
    });

    });
    });
    window.ParsleyValidator.setLocale('fr');
</script>
</body>
</html>
