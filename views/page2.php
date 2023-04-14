<?php
require_once 'header.php';
?>
    <h1>Consultation</h1>
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
