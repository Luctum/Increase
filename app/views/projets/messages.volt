<div class="container">

    {%  for m in messages %}
        <div class="media">
            <div class="media-left">
                    <img class="media-object" src="..." alt="Avatar">
            </div>
            <div class="media-body">

                <h5 class="media-heading">
                    {{ m.getUser().getIdentite() }}
                {% if session.get("user").getId() == m.getUser().getId() %}
                    <i>(Vous)</i>
                {% endif %}</h5>

                {{ m.getContent() }}
            </div>
        </div>

    {% endfor %}
    </ul>
</div>