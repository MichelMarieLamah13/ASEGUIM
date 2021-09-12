<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <?php if (is_logged_in()): ?>
                <ul class="nav navbar-nav">
                    <li class="<?= set_active("list.users.php") ?>">
                        <a href="list.users.php"><?= $menu['liste_u'][get_session('locale')] ?></a>
                    </li>
                    <li>
                        <input type="search" placeholder="<?= $menu['liste_u1'][get_session('locale')] ?>" id="searchbox"
                               class="form-control">
                        &nbsp;
                        <i class="fas fa-spinner fa-spin"
                           style="display: none;"
                            id="spinner"></i>
                        <div id="display-results">

                        </div>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= set_active("index.php") ?>"><a
                        href="index.php"><?= $menu['acceuil'][get_session('locale')] ?></a></li>
                <?php if (is_logged_in()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                src="<?= get_session('avatar') ?: get_avatar_url(get_session('email')); ?>"
                                alt="Image de profile de <?= get_session('pseudo'); ?>"
                                class="avatar-xs"> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="<?= set_active("profile.php") ?>">
                                <a href="profile.php?id=<?= get_session('user_id'); ?>"><?= $menu['mon_profil'][get_session('locale')] ?></a>
                            </li>
                            <li class="<?= set_active("change.password.php") ?>">
                                <a href="change.password.php"><?= $menu['change_password'][get_session('locale')] ?></a>
                            </li>
                            <li class="<?= set_active("edit.user.php") ?>">
                                <a href="edit.user.php?id=<?= get_session('user_id'); ?>"><?= $menu['editer_profil'][get_session('locale')] ?></a>
                            </li>
                            <li class="<?= set_active("share.code.php") ?>"><a
                                    href="share.code.php"><?= $menu['share_code'][get_session('locale')] ?></a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><?= $menu['deconnexion'][get_session('locale')] ?></a></li>
                        </ul>
                    </li>
                    <li class="<?= $notifications_count > 0 ? 'have_notifs' : '' ?>">
                        <a href="notifications.php">
                            <i class="fas fa-bell"></i>
                            &nbsp;
                            <?= $notifications_count > 0 ? "($notifications_count)" : ''; ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="<?= set_active("login.php") ?>"><a
                            href="login.php"><?= $menu['connexion'][get_session('locale')] ?></a></li>
                    <li class="<?= set_active("register.php") ?>"><a
                            href="register.php"><?= $menu['inscription'][get_session('locale')] ?></a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <?php if (get_session('locale') == 'en'): ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="flag-icon flag-icon-us"> </span> <?= $menu['en'][get_session('locale')] ?>
                            <span class="caret"></span>
                        </a>
                    <?php endif; ?>
                    <?php if (get_session('locale') == 'fr'): ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="flag-icon flag-icon-fr"> </span> <?= $menu['fr'][get_session('locale')] ?>
                            <span class="caret"></span>
                        </a>
                    <?php endif; ?>
                    <ul class="dropdown-menu" role="menu">
                        <?php if (get_session('locale') != 'fr'): ?>
                            <li>
                                <a class="dropdown-item" href="?lang=fr">
                                    <span
                                        class="flag-icon flag-icon-fr"> </span> <?= $menu['fr'][get_session('locale')] ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_session('locale') != 'en'): ?>
                            <li>
                                <a class="dropdown-item" href="?lang=en">
                                    <span
                                        class="flag-icon flag-icon-us"> </span> <?= $menu['en'][get_session('locale')] ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>