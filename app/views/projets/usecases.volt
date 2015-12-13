<table class="table table-bordered">
    <tr>
        <td>Nom</td>
        <td>Poids</td>
        <td>Avancement</td>
        <td>Développeur</td>
    </tr>
    {% for u in usecases %}
        <tr class="active">
            <td id="libelle">
                <div id="grp-button-uc">
                    <a href="{{ url("Usecases/delete/"~u.getId()) }}" class="btn btn-xs btn-default" role="button" style="border-radius: 50%;"><span class="glyphicon glyphicon-remove-sign"></span></a>
                {{ u.toString() }}</div>
            </td>
            <td class="poids" id="poids" data-type="text" data-pk="{{ u.getId() }}" data-url="{{ url("Usecases/soloUpdate") }}"
                data-title="Entrez le poids du usecase">{{ u.getPoids() }}</td>
            <td>
                <div class="progress " style="height:20px; margin: 0;">
                    {% if u.getAvancement() == 0 %}0%{% endif %}
                    <div class="progress-bar" role="progressbar" aria-valuenow="{{ u.getAvancement() }}"
                         aria-valuemin="0" aria-valuemax="100" style="width: {{ u.getAvancement() }}%;" >
                        {{ u.getAvancement() }}%
                    </div>
                </div>
            </td>
            <td>{{ u.getUser().getIdentite() }}</td>
        </tr>
        {% for t in taches %}
            {% if t.getCodeUseCase() is u.getCode() %}
                <tr class="decale" style="text-indent: 5%;">
                    <td style="font-size: 12px;">
                        <i>{{ t.toString() }}</i>
                    </td>
                    <td></td>
                    <td>
                        <div class="progress" style="height:20px; margin: 0;">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar"
                                 aria-valuenow="{{ t.getAvancement() }}"
                                 aria-valuemin="0" aria-valuemax="100" style="width: {{ t.getAvancement() }}%;" >
                                <a style="color: #ffdbe2;"id="avancement" class="avancement" data-type="text" data-pk="{{ t.getId() }}" data-url="{{ url("Taches/soloUpdate") }}"
                                   data-title="Entrez l'avancement de la tache">{{ t.getAvancement() }}</a>%
                            </div>
                        </div>
                    </td>
                </tr>
            {% endif %}
        {% endfor %}
    {% endfor %}
</table>
{% if q is defined  and q['btFrm'] is defined and q['modal'] is defined %}
    {{ q['btFrm'] }}
    {{ q['btFrmTache'] }}
    {{ q['modal'] }}
    {{ q['modalTache'] }}
{% endif %}
{{ script_foot }}