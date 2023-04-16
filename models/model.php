<?php
/**
 * Ce fichier contient les fonctions qui interagissent avec la base de données
 * pour gérer les opérations CRUD (Create, Read, Update, Delete) sur les livres.
 */

/**
 * Connecte à la base de données et retourne l'objet PDO.
*/
function connectDb() {
    $host = "localhost";
    $dbname = "mvc";
    $user = "ItsKandar";
    $password = "AZERTY";
    
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        return $db;
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

/**
 * Récupère tous les livres de la base de données.
 */
function getAllBooks() {
    $db = connectDb();
    $query = $db->query("SELECT * FROM books");
    return $query->fetchAll();
}

/**
 * Modifie un livre dans la base de données.
 *
 * $id L'ID du livre à modifier.
 * $name Le nouveau nom du livre.
 * $author Le nouvel auteur du livre.
 * $year La nouvelle année de publication du livre.
 * $summary Le nouveau résumé du livre.
 */
function modifyBook($id, $name, $author, $year, $summary) {
    $pdo = connectDb();
    $query = "UPDATE books SET name = :name, author = :author, year = :year, summary = :summary WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);
    $stmt->execute();
}

/**
 * Ajoute un livre dans la base de données.
 *
 * $name Le nom du livre.
 * $author L'auteur du livre.
 * $year L'année de publication du livre.
 * $summary Le résumé du livre.
 */
function addBook($name, $author, $year, $summary) {
    $pdo = connectDb();
    $query = "INSERT INTO books (name, author, year, summary) VALUES (:name, :author, :year, :summary)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':summary', $summary, PDO::PARAM_STR);
    $stmt->execute();
}

/**
 * Supprime un livre de la base de données.
 */
function deleteBook($id) {
    $pdo = connectDb();
    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * Récupère un livre de la base de données en utilisant son ID.
 *
 * $id L'ID du livre à récupérer.
 */
function getBookById($id) {
    $pdo = connectDb();
    $query = "SELECT * FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    return $book;
}
?>
