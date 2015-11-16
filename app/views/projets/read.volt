<div class="progress">
    {{ q['progress'] }}
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="sidebar-nav">
            <div class="navbar " role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible-xs navbar-brand">Sidebar menu</span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">

                        <li><a href="#">A propos</a></li>
                        <li><a href="#">Contributeurs</a></li>
                        <li><a href="#">Usecases / Tâches</a></li>
                        <li><a href="#">Statistiques</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Messages <span class="badge">0</span></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container">
            <div class="col-md-2" >
                <img class="logo-projet" src="{{ projet.getImage() }}">
            </div>
            <div class="col-md-6" >
                <h2> Projet : {{ projet.getNom() }}</h2>
            </div>
        <hr>
        <div class="row">
            <div class="col-md-1" >
            </div>
            <div class="col-md-5">
                <p1>{{ projet.getDescription()}}</p1>
            </div>
        </div>
    </div>
</div>