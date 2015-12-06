<div class="row">
    {% for p in projets %}

        <div class="col-sm-6 col-md-3">
            <div class="imgRes">
                <img src="{{ p.getImage() }}">
            </div>

            <div class="thumbnail">
                <div class="caption">
                    <h3><a href="{{ url("Projets/read/"~p.getId()) }}">{{ p.toString() }}</a></h3>

                    <div id="contentCaption">
                        <p>{{ p.getDescription() }}</p>
                    </div>
                    <hr>
                    <p>Client : {{ p.getClient().getIdentite() }}</p>

                    <div id="grp-button">
                        <p><a href="#" class="btn btn-xs btn-default" role="button"
                              style="border-radius: 50%;">
                                <span class="glyphicon glyphicon-pencil"></span></a>

                            <a href="{{ url("Projets/delete") }}" class="btn btn-xs btn-default" role="button"
                               style="border-radius: 50%;">
                                <span class="glyphicon glyphicon-remove-sign"></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    {% endfor %}
</div>
{{ q['btFrm'] }}
{{ q['modal'] }}
{{ script_foot }}