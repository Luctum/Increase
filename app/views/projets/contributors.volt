{% for c in contributors %}
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ c.getImage() }}" id="avatar">  </img> {{ c.getIdentite() }}
        </div>

        {% for u in usecases %}
            <div class="list-group">
                {% if c == u.getUser() %}
                    <button class="list-group-item"><h5 class="list-group-item-heading">{{ u.toString() }}</h5></button>
                {% endif %}
            </div>
        {% endfor %}
    </div>
{% endfor %}