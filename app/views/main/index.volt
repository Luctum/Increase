<table class='table table-striped'>
    <thead><tr><th colspan='3'>{{title}}</th></tr></thead>
    <tbody>
    {% for object in objects %}
        <tr>
            <td>{{object.toString()}}</td>
            <td class='td-center'><a class='btn btn-primary btn-xs' href='{{controller~"/frm/"~object.getId()}}'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
            <td class='td-center'><a class='btn btn-warning btn-xs' href='{{controller~"/delete/"~object.getId()}}'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
<a class='btn btn-primary' href='{{controller}}/frm'>Ajouter...</a>