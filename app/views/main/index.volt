<table class='table table-striped'>
    <thead><tr><th colspan='3'>{{title}}</th></tr></thead>
    <tbody>
    {% for object in objects %}
        <tr>
            <td><a href="{{baseUrl~controller~"/read/"~object.getId()}}">{{object.toString()}}</a></td>
            <td class='td-center'><a class='btn btn-primary btn-xs' href='{{baseUrl~controller~"/frm/"~object.getId()}}'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></td>
            <td class='td-center'><a class='btn btn-warning btn-xs' href='{{baseUrl~controller~"/delete/"~object.getId()}}'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
<a class='btn btn-primary' href='{{ baseUrl~controller }}/frm/'>Nouveau</a>