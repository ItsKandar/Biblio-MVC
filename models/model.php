<?php
// Connexion à la base de données
function connectDb() {
    // Remplacez les valeurs de connexion avec celles de votre base de données
    $host = "localhost";
    $dbname = "mvc";
    $user = "root";
    $password = "";
    
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        return $db;
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

function getAllBooks() {
    $db = connectDb();
    $query = $db->query("SELECT * FROM books");
    return $query->fetchAll();
}

function modifyBook($id, $name, $author, $year, $summary) {
    $pdo = connectDb();
    $query = "UPDATE books SET name = :name, author = :author, year = :year, summary = :summary WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'id' => $id,
        'name' => $name,
        'author' => $author,
        'year' => $year,
        'summary' => $summary
    ]);
}

function deleteBook($id) {
    $pdo = connectDb();
    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
}

function getBookById($id) {
    $pdo = connectDb();
    $query = "SELECT * FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

?>