<form name="frmAjout">
    <div class="form-group">
        <label>Nom du Projet</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="MonProjet">

        <label>Description</label>
        <input type="text" class="form-control" name="description" placeholder="Description du projet">

        <label>Client</label>
        <select class="form-control" name="idClient">
            {% for c in clients %}
                <option value="{{ c.getId() }}">{{ c.getIdentite() }}</option>
            {% endfor %}
        </select>

        <label>Date de lancement</label>
        <input type="date" class="form-control" name="dateLancement">

        <label>Date de fin prévue</label>
        <input type="date" class="form-control" name="dateFinPrevue">

        <label>Image du projet en png</label>
        <input type="text" class="form-control" name="image" placeholder="http://www.example.com/imageduprojet.png">
    </div>
</form>
