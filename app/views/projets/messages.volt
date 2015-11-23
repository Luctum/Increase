Messages :

<div id="messages">
{% for r in msg %}
        <div class="media" id="msgGlobal">
            <div class="media-left">
                    <img class="media-object" id="avatar" src="{{ r.getUser().getImage() }}" alt="Avatar">
            </div>
            <div class="media-body" id="msg">
                <h5 class="media-heading">
                    {{ r.getUser().getIdentite() }} <span>{{ r.getUser().getMail() }}</span>
                {% if session.get("user") != null and session.get("user").getId() == r.getUser().getId() %}
                    <i>(Vous)</i>
                {% endif %}</h5>
                {{ r.getContent() }}
            </div>
            <div id="newMsg">

            </div>
        </div>
{% endfor %}
</div>
<form name="newMsgForm" method="post" action="{{ url("Messages/update") }}">
    <div class="form-group">
        <input  class="form-control" type="hidden" id="idProjet" value="{{ idProj }}" name="idProjet">
        <input  class="form-control" type="hidden" id="author" name="idUser" value="{{ session.get("user").getId() }}">
        <input  class="form-control" type="text" id="objet" name="objet" placeholder="Entrez un objet">
        <textarea  class="form-control" type="text" id="message" placeholder="Entrez un message" name="content"></textarea>
        <input type="submit" value="Envoyer">
    </div>
</form>
{{ q['submitMsg'] }}


{{ script_foot }}
