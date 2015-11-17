<div class="container">
    {%  for m in messages %}
        {{ m.getContent() }}
    {% endfor %}
</div>