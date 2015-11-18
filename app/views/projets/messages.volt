
<h5>Messages : </h5>{%  for m in messages %}
        <div class="media" id="msgGlobal">
            <div class="media-left">
                    <img class="media-object" id="avatar" src="{{ m.getUser().getImage() }}" alt="Avatar">
            </div>
            <div class="media-body" id="msg">
                <h5 class="media-heading">
                    {{ m.getUser().getIdentite() }} <span>{{ m.getUser().getMail() }}</span>
                {% if session.get("user") != null and session.get("user").getId() == m.getUser().getId() %}
                    <i>(Vous)</i>
                {% endif %}</h5>

                {{ m.getContent() }}
            </div>
        </div>
{% endfor %}

