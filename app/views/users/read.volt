<div class="row">
    <div class="col-md-3">
        <img id="logoProfil" src="{{ user.getImage() }}">
        <hr/>
        <h4 id="identite"
            data-url="{{ url("Users/soloUpdate") }} " data-type="text" data-pk="{{ user.getId() }}"
            data-title="Nom de l'utilisateur">{{ user.getIdentite() }}</h4>

        <p id="mail"
           data-url="{{ url("Users/soloUpdate") }} " data-type="text" data-pk="{{ user.getId() }}"
           data-title="Mail de l'utilisateur">{{ user.getMail() }}</p>
        <hr/>
    </div>

    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Mes projets</div>

                    {% for p in projets %}
                        <div class="list-group">
                            <a href="{{ url("Projets/read/"~p.getId()) }}" class="list-group-item">{{ p.getNom() }}</a>
                        </div>
                    {% endfor %}

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Contributions</div>
                    {% for pc in projetsCree %}
                        <div class="list-group">
                            <a class="list-group-item"
                               href="{{ url("Projets/read/"~pc.getId()) }}">{{ pc.getNom() }}</a>
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
</div>
{{ script_foot }}

