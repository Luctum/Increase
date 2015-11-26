
{% for c in contributors %}
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ c.getImage() }}" id="avatar">  </img> {{ c.getIdentite() }}
        </div>

        {% for u in usecases %}
            <div class="list-group">
                {% if c == u.getUser() %}

                    <button class="list-group-item"><h5 class="list-group-item-heading">{{ u.toString() }}</h5></button>
                    <div class="decale" id="borderNone">
                        <p class="list-group-item-text">
                            {% for t in taches %}

                            {% if t.getCodeUseCase() == u.getCode() %}

                        <div class="list-group-item">
                            {{ t.toString() }}
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar"
                                 aria-valuenow="{{ t.getAvancement() }}"
                                 aria-valuemin="0" aria-valuemax="100" style="width: {{ t.getAvancement() }}%">
                            </div>
                        </div>


                        {% endif %}

                        {% endfor %}
                        </p>
                    </div>

                {% endif %}
            </div>
        {% endfor %}

    </div>
{% endfor %}