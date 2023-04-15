<?php
require_once 'header.php';
require_once '../models/model.php';
$books = getAllBooks();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['selected_book'])) {
    $book = $_SESSION['selected_book'];
    unset($_SESSION['selected_book']);
}
?>
    <h1>Modification</h1>

    <h2>Ajouter un livre</h2>

    <form action="../controllers/controller.php?action=add" method="post">
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

    <h2>Modifier un livre</h2>
    <form action="../controllers/controller.php?action=select_book" method="post">
        <label for="book">Sélectionnez un livre :</label>
        <select name="id" id="book">
            <option value="" selected>Choisissez un livre</option>
            <?php foreach ($books as $book): ?>
                <option value="<?php echo $book['id']; ?>"><?php echo $book['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Choisir">
    </form>

    <form action="../controllers/controller.php?action=modify" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo isset($book) ? $book['id'] : ''; ?>">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" required value="<?php echo isset($book) ? $book['name'] : ''; ?>">
        <br>
        <label for="author">Auteur :</label>
        <input type="text" name="author" id="author" required value="<?php echo isset($book) ? $book['author'] : ''; ?>">
        <br>
        <label for="year">Année de publication :</label>
        <input type="number" name="year" id="year" required value="<?php echo isset($book) ? $book['year'] : ''; ?>">
        <br>
        <label for="summary">Résumé :</label>
        <textarea name="summary" id="summary" rows="4" cols="50" required><?php echo isset($book) ? $book['summary'] : ''; ?></textarea>
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
