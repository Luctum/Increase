<div class="row">
    <div class="col-sm-4"><i>Date de lancement :</i> <span id="dateLancement"
                                                           data-url="{{ url("Projets/soloUpdate") }} " data-type="date"
                                                           data-pk="{{ projet.getId() }}"
                                                           data-title="Date de lancement">{{ projet.getDateLancement() }}</span>
    </div>
    <div class="col-sm-4" style="text-align: center;"><i>Date de fin prévue :</i> <span id="dateFinPrevue"
                                                                                        data-url="{{ url("Projets/soloUpdate") }} "
                                                                                        data-type="date"
                                                                                        data-pk="{{ projet.getId() }}"
                                                                                        data-title="Date de fin prévue">{{ projet.getDateFinPrevue() }}</span>
    </div>
    <div class="col-sm-4" style="text-align: right;"><i>Client :</i> <span
                id="idClient" data-url="{{ url("Projets/soloUpdate") }}" ">{{ projet.getClient().getIdentite() }}</span>
    </div>
    <br/>
</div>
<div class="row">
    <div class="jumbotron">Description : <span id="description"
                                               data-url="{{ url("Projets/soloUpdate") }}"
                                               data-type="textarea"
                                               data-pk="{{ projet.getId() }}"
                                               data-title="Date de fin prévue">{{ projet.getDescription() }}</span>
    </div>
</div>
{{ script_foot }}