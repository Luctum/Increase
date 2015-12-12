<form method="POST" action="{{ url("usecases/update/"~id) }}" name="frmUsecases">
   <div class="form-group">
       Code : <input type="text" name="code" placeholder="ex: P-UC4">
   </div>
    <div class="form-group">
        Nom : <input type="text" name="nom" placeholder="ex: Gérer ACL">
    </div>
    <div class="form-group">
        Poids : <input type="text" name="poids" placeholder="ex: 40">
    </div>
    <div class="form-group">
    Assigné à:
        <select name="idDev">
            {% for u in users %}
            <option value="{{ u.getId() }}">{{ u.getIdentite() }}</option>
            {% endfor %}
        </select>
    </div>
    <input type="hidden" name="avancement" value="0">
    <input type="hidden" name="idProjet" value="{{ id }}">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
</form>