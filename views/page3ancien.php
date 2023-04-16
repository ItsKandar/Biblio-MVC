<main>
    <?php
    require_once '../views/header.php';
    require_once '../models/model.php';
    $books = getAllBooks();

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
        <h1>Modification</h1>

        <h2>Ajouter un livre</h2>

        <form action="../controllers/controller.php?action=add" method="post">
            <label for="add_name">Nom :</label>
            <input type="text" name="name" id="add_name" required>
            <br>
            <label for="add_author">Auteur :</label>
            <input type="text" name="author" id="add_author" required>
            <br>
            <label for="add_year">Année de publication :</label>
            <input type="number" name="year" id="add_year" required>
            <br>
            <label for="add_summary">Résumé :</label>
            <textarea name="summary" id="add_summary" rows="4" cols="50" required></textarea>
            <br>
            <input type="submit" name="submit" value="Ajouter">
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
            <input type="hidden" name="id" id="mod_id" value="<?php echo isset($selectedBook) ? $selectedBook['id'] : ''; ?>">
            <label for="mod_name">Nom :</label>
            <input type="text" name="name" id="mod_name" required value="<?php echo isset($selectedBook) ? $selectedBook['name'] : ''; ?>">
            <br>
            <label for="mod_author">Auteur :</label>
            <input type="text" name="author" id="mod_author" required value="<?php echo isset($selectedBook) ? $selectedBook['author'] : ''; ?>">
            <br>
            <label for="mod_year">Année de publication :</label>
            <input type="number" name="year" id="mod_year" required value="<?php echo isset($selectedBook) ? $selectedBook['year'] : ''; ?>">
            <br>
            <label for="mod_summary">Résumé :</label>
            <textarea name="summary" id="mod_summary" rows="4" cols="50" required><?php echo isset($selectedBook) ? $selectedBook['summary'] : ''; ?></textarea>
            <br>
            <input type="submit" name="submit" value="Modifier">
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
</main>