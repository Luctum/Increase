<!DOCTYPE html>
<html>
<head>
    <title>Increase</title>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

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
<nav class="navbar navbar-inverse" id="navbar">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand brandFalcon" href="{{ baseUrl }}"><img src="{{ baseUrl }}/public/img/logo.png"
                                                                          alt="FocusFalcon" id="icone"/></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="{{ baseUrl }}Projets/index">Projets</a></li>
            <li><a href="{{ baseUrl }}Users/index">Utilisateurs</a></li>
            {% if session.has("user") and session.get("user").getIdTypeUser() == 0 %}
                <li><a href="{{ baseUrl }}Acl/index">Gestion des Acl</a></li>
            {% endif %}
        </ul>

        <div class="nav navbar-nav navbar-right">

            {% if this.session.has("user") %}
                <li class="dropdown" id="profilbtn">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{{ session.user.getIdentite() }} <img id="icone"
                                                                                   src="{{ session.user.getImage() }}"><span
                                class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="{{ url("Users/read/"~session.user.getId()) }}">My Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url.get(controller~"/logout") }}">Sign out</a></li>
                    </ul>
                </li>
            {% else %}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Sign In<span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="{{ url("Users/login") }}">Sign In</a></li>
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
    {% if q is defined  and q['btFrm'] is defined and q['modal'] is defined %}
        {{ q['btFrm'] }}
        {{ q['modal'] }}
    {% endif %}
</div>
<footer id="footer">
    <div class="container">
    </div>
</footer>
</body>
</html>