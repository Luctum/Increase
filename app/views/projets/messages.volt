Messages :
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
        </div>
{% endfor %}
<br/><br/>
<form name="envoiMsg" method="post" action="" class="form-group">
    <input class="form-control" type="hidden" id="id" value="">
    <input class="form-control" type="hidden" id="author" value="{{ session.get("user").getId() }}">
    <input class="form-control" type="hidden" id="fil">
    <input class="form-control" type="text" id="objet" placeholder="Entrez un objet">
    <textarea class="form-control" type="text" id="message" placeholder="Entrez un message"></textarea>
    <input class="btn btn-primary" type="submit" id="btnRep" value="Repondre">
</form>

{{ script_foot }}