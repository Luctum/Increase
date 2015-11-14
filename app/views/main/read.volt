<div class="panel panel-primary">
    {% for o in object %}
        <div class="panel-heading">
            {{ o.toString() }}
        </div>
        <div class="panel-content">
            {{ o.getPrincipal() }}
        </div>
    {% endfor %}
</div>