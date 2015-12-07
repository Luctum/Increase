<!DOCTYPE html>
<html>
<head>
    <title>Increase</title>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    {{ stylesheet_link("css/bootstrap.min.css") }}
    {{ javascript_include('js/bootstrap.min.js') }}
    {{ stylesheet_link("css/styles.css") }}

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
          rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('img/logo.png') }}">
</head>
<meta charset="UTF-8">
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand brandFalcon" href="{{ baseUrl }}"><img src="{{ baseUrl }}/public/img/logo.png"
                                                                          alt="FocusFalcon" id="icone"/></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ baseUrl }}Projets/index">Projets</a></li>
            <li><a href="{{ baseUrl }}Users/index">Utilisateurs</a></li>
        </ul>

        <div class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input class="form-control" placeholder="Search" type="text">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            {% if this.session.has("user") %}
                <li class="dropdown" id="profilbtn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ session.user.getIdentite() }} <img id="icone"
                                                                                   src="{{ session.user.getImage() }}"><span
                                class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="#">My Profile</a></li>
                        <li><a href="#">My Projects</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url.get(controller~"/logout") }}">Sign out</a></li>
                    </ul>
                </li>
            {% else %}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Sign In<span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="#">Sign In</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Sign Up !</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url.get(controller~"/asUser") }}">asUser</a></li>
                        <li><a href="{{ url.get(controller~"/asAdmin") }}">asAdmin</a></li>
                    </ul>
                </li>
            {% endif %}
        </div>

    </div>
</nav>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ baseUrl }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home</a></li>
        <li><a href="{{ baseUrl~controller }}">&nbsp;{{ controller }}</a></li>
    </ol>
    <div class="content">
        {{ content() }}
    </div>
</div>
<footer id="footer">
    <div class="container">
    </div>
</footer>
</body>
</html>