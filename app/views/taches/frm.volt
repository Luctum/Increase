<form method="POST" action="{{ url("Taches/update/"~id) }}" name="frmUsecases">
    <div class="form-group">
        Nom : <input type="text" name="libelle" placeholder="ex: Gérer ACL">
    </div>
    <div class="form-group">
        Date : <input type="date" name="date">
    </div>
    <div class="form-group">
        UseCase parente :
        <select name="codeUseCase">
            {% for u in usecases %}
                <option value="{{ u.getCode() }}">{{ u.getNom() }}</option>
            {% endfor %}
        </select>
    </div>
    <input type="hidden" name="avancement" value="0">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>
</form>