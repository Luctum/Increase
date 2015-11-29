


<div class="progress">
    {{ q['progress'] }}
</div>
    <div class="alert alert-custom" style="background-color: rgb({{ color["r"] }},{{ color["g"] }},{{ color["b"] }});">
    <img class="logo-projet" src="{{ projet.getImage() }}">
    <span class="h">Projet : {{ projet.getNom() }}</span>
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="sidebar-nav">
            <div class="navbar " role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible-xs navbar-brand">Sidebar menu</span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a id="menu1">A propos</a></li>
                        <li><a id="menu2">Contributeurs</a></li>
                        <li><a id="menu3">Usecases / Tâches</a></li>
                        <li><a id="menu4">Statistiques</a></li>
                        <li class="divider"></li>
                        <li><a id="menu5">Messages<span class="badge">{{ messages.count() }}</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div id="contentProjet">
        </div>
    </div>
</div>
{{ script_foot }}