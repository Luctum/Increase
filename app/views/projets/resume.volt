<div class="row">
    <div class="col-sm-4"><i>Date de lancement :</i> {{ projet.getDateLancement() }}</div>
    <div class="col-sm-4" style="text-align: center;"><i>Date de fin prévue :</i> {{ projet.getDateFinPrevue() }}</div>
    <div class="col-sm-4" style="text-align: right;"><i>Client :</i> {{ projet.getClient().getIdentite() }}</div>
    <br/>
</div>
    <div class="row">
        <div class="jumbotron">Description : {{ projet.getDescription() }}</div>
    </div>
