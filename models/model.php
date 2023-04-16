<?php
// Connexion à la base de données
function connectDb() {
    // Remplacez les valeurs de connexion avec celles de votre base de données
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

function getAllBooks() {
    $db = connectDb();
    $query = $db->query("SELECT * FROM books");
    return $query->fetchAll();
}

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

function deleteBook($id) {
    $pdo = connectDb();
    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

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