<div>
    <form method="POST" action="{{ url("Users/update") }}">

        <div class="form-group">


            <input class="form-control" type="hidden" value="http://www.valeursactuelles.com/sites/default/files/styles/va-article/public/bulle_alamy.jpg" name="image"/>
            <input class="form-control" type="hidden" name="id"/>

            <label>Nom : </label> <input class="form-control" type="text" name="identite"/>
            <label>Password: </label> <input class="form-control" type="text" name="password"/>
            <label>Mail : </label><input class="form-control" type="text" name="mail"/>
            <!--Avatar de l'utilisateur -->
            <label>Rang : </label>
            <select name="idTypeUser" class="form-control">
                {% for r in typeUser %}
                   <option value="{{ r.getId() }}">{{ r.getLibelle() }}</option>
                {% endfor %}
            </select>

        </div>
        <input class="btn btn-primary"type="submit" value="Envoyer">
    </form>
</div>