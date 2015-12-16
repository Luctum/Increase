<div class="row">
    {% for p in projets %}

        <div class="col-sm-6 col-md-3">
            <div class="imgRes">
                <img src="{{ p.getImage() }}">
            </div>

            <div class="thumbnail">
                <div class="caption">
                    <h4 style="margin-top: 20px;"><a href="{{ url("Projets/read/"~p.getId()) }}">{{ p.toString() }}</a>
                    </h4>

                    <div id="contentCaption">
                        <p>{{ p.getDescription() }}</p>
                    </div>
                    <hr>
                    <a href="{{ url("Users/read/"~p.getClient().getId()) }}">Client
                        : {{ p.getClient().getIdentite() }}</a>

                    <div id="grp-button">
                        <p><a href="#" class="btn btn-xs btn-default" role="button"
                              style="border-radius: 50%;">
                            </a>

                            <a href="{{ url("Projets/delete/"~p.getId()) }} " class="btn btn-xs btn-default"
                               role="button"
                               style="border-radius: 50%;">
                                <span class="glyphicon glyphicon-remove-sign"></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    {% endfor %}
</div>

{{ script_foot }}