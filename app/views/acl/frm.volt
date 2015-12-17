<form name="frmAjout" method="post" action="{{ url("Acl/update") }}">
    <div class="form-group">
        <label>Operation</label>
        <select class="form-control" name="idOperation">
            {% for o in operations %}
                <option value="{{ o.getId() }}">{{ o.getOperation() }}</option>
            {% endfor %}
        </select>

        <label>Ressource</label>
        <select class="form-control" name="idRessource">
            {% for r in ressources %}
                <option value="{{ r.getId() }}">{{ r.getLibelle() }}</option>
            {% endfor %}
        </select>

        <label>Type d'utilisateur</label>
        <select class="form-control" name="idTypeUser">
            {% for t in typesUser %}
                <option value="{{ t.getId() }}">{{ t.getLibelle() }}</option>
            {% endfor %}
        </select>

    </div>
    <hr>
    <input type="submit" class="btn btn-primary" value="Envoyer">
</form>