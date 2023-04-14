<?php
require_once 'header.php';
?>
    <h1>Modification</h1>
    <h2>Ajouter un livre</h2>

    <form action="../controllers/controller.php?action=modify" method="post">
        <input type="hidden" name="id" id="id">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="author">Auteur :</label>
        <input type="text" name="author" id="author" required>
        <br>
        <label for="year">Année de publication :</label>
        <input type="number" name="year" id="year" required>
        <br>
        <label for="summary">Résumé :</label>
        <textarea name="summary" id="summary" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" name="submit" value="Ajouter / Modifier">
    </form>

    <h2>Supprimer un livre</h2>

    <form action="../controllers/controller.php?action=delete" method="post">
        <label for="book_id_delete">ID du livre à supprimer :</label>
        <input type="number" name="book_id_delete" id="book_id_delete" required>
        <br>
        <input type="submit" name="submit" value="Supprimer">
    </form>
</body>
</html>
