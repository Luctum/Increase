<form method="post" action="">
    <input type="hidden" id="id" value="">
    <input type="hidden" id="author" value="{{ session.get("user").getId() }}">
    <input type="hidden" id="fil">
    <input type="text" id="objet" placeholder="Entrez un objet">
    <textarea type="text" id="message" placeholder="Entrez un message">

    <input class="btn btn-primary" type="submit" id="btnSubmit">
</form>