{% for c in contributors %}
    <div class="panel panel-default">
        <div class="panel-heading">
        {{ c.getIdentite() }}   {{ c.getImage() }}
        </div>

            {% for u in usecases %}
             <div class="list-group">
                {%  if c == u.getUser() %}

                    <button class="list-group-item"><h5 class="list-group-item-heading">{{ u.toString() }}</h5></button>
                    <div class="list-group">
                        <p class="list-group-item-text">
                    {% for t in taches %}

                        {% if t.getCodeUseCase() == u.getCode()%}
                        <button class="list-group-item"> {{ t.toString() }} </button>
                        {% endif %}

                    {% endfor %}
                        </p>
                    </div>

                {% endif %}
            </div>
            {% endfor %}

    </div>
{% endfor %}