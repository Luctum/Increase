{% for user in users %}
    {{ user.getMail() }} - {{ user.getIdentite() }}<br/>

{% endfor %}