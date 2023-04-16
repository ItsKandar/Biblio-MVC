<?php
/**
 * Page de consultation des livres
 *
 * Cette page affiche la liste des livres stockés dans la base de données,
 * avec leurs informations (ID, Titre, Auteur, Année de publication et Résumé).
 */

require_once 'header.php';
?>
    <h1>Consultation</h1>
    <!-- Création d'un tableau pour afficher les livres et leurs informations -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année de publication</th>
                <th>Resumé</th>
            </tr>
        </thead>
        <tbody>
            <!-- Parcours de la liste des livres et affichage des informations de chaque livre -->
            <?php foreach ($books as $book) : ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= $book['name'] ?></td>
                <td><?= $book['author'] ?></td>
                <td><?= $book['year'] ?></td>
                <td><?= $book['summary'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
