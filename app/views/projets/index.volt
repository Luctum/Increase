<div class="row">
    {% for p in projets %}

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ p.getImage() }}" alt="chaton">

                <div class="caption">
                    <h3><a href="{{ url("Projets/read/"~p.getId()) }}">{{ p.toString() }}</a></h3>

                    <p>{{ p.getDescription() }}</p>

                    <p><a href=" #" class="btn btn-default" role="button">Button</a>
                        <a href="#" class="btn btn-danger" role="button">Button</a>
                    </p>
                </div>
            </div>
        </div>

    {% endfor %}
</div>

