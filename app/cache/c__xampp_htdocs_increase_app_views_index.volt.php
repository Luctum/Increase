<!DOCTYPE html>
<html>
<head>
    <title>Increase</title>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

    <?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
    <?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
    <?php echo $this->tag->stylesheetLink('css/styles.css'); ?>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->url->get('img/logo.png'); ?>">
</head>
<meta charset="UTF-8">
<body>
<nav class="navbar navbar-inverse" id="navbar">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand brandFalcon" href="<?php echo $baseUrl; ?>"><img src="<?php echo $baseUrl; ?>/public/img/logo.png"
                                                                          alt="FocusFalcon" id="icone"/></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="<?php echo $baseUrl; ?>Projets/index">Projets</a></li>
            <li><a href="<?php echo $baseUrl; ?>Users/index">Utilisateurs</a></li>
        </ul>

        <div class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input class="form-control" placeholder="Search" type="text">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <?php if ($this->session->has('user')) { ?>
                <li class="dropdown" id="profilbtn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $this->session->user->getIdentite(); ?> <img id="icone"
                                                                                   src="<?php echo $this->session->user->getImage(); ?>"><span
                                class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="<?php echo $this->url->get('Users/read/' . $this->session->user->getId()); ?>">My Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $this->url->get($controller . '/logout'); ?>">Sign out</a></li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Sign In<span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="#">Sign In</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Sign Up !</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $this->url->get($controller . '/asUser'); ?>">asUser</a></li>
                        <li><a href="<?php echo $this->url->get($controller . '/asAdmin'); ?>">asAdmin</a></li>
                    </ul>
                </li>
            <?php } ?>
        </div>

    </div>
</nav>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo $baseUrl; ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a></li>
        <li><a href="<?php echo $baseUrl . $controller; ?>">&nbsp;<?php echo $controller; ?></a></li>
    </ol>
    <div class="content">
        <?php echo $this->getContent(); ?>
    </div>
    <?php if (isset($q) && isset($q['btFrm']) && isset($q['modal'])) { ?>
        <?php echo $q['btFrm']; ?>
        <?php echo $q['modal']; ?>
    <?php } ?>
</div>
<footer id="footer">
    <div class="container">
    </div>
</footer>
</body>
</html>