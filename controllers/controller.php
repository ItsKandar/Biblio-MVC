<?php
/**
 * Ce fichier sert de contrôleur pour gérer les différentes actions liées aux livres.
 * Il gère les actions d'ajout, de modification, de suppression et de sélection des livres.
 */

require_once '../models/model.php';
require_once '../views/header.php';

session_start();

// Récupérer l'action depuis l'URL ou définir une action par défaut
$action = isset($_GET['action']) ? $_GET['action'] : 'page3';

// Liste des actions possibles
switch ($action) {
    // Afficher la page d'accueil
    case 'page1':
        require_once '../views/page1.php';
        break;

    // Afficher la page de consultation des livres
    case 'page2':
        $books = getAllBooks();
        require_once '../views/page2.php';
        break;

    // Afficher la page de modification des livres
    case 'page3':
        if (isset($_SESSION['selected_book'])) {
            $selectedBook = $_SESSION['selected_book'];
            unset($_SESSION['selected_book']);
        }    
        require_once '../views/page3.php';
        break;

    // Sélectionner un livre pour le modifier
    case 'select_book':
        // Vérifier si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookId = $_POST['id'];
            $book = getBookById($bookId);

            // Si le livre existe, le stocker dans la session et rediriger vers la page de modification
            if ($book) {
                $_SESSION['selected_book'] = $book;
                header('Location: ../views/index.php?action=page3');
            } else {
                // Rediriger vers la page de modification si le livre n'est pas trouvé
                header('Location: ../views/index.php?action=page3');
            }
        }
        break;

    // Modifier un livre
    case 'modify':
        // Vérifier si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];

            // Modifier le livre dans la base de données
            modifyBook($id, $name, $author, $year, $summary);
            header('Location: ../views/index.php?action=page2');
        }
        break;

    // Ajouter un livre
    case 'add':
        // Vérifier si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];

            // Ajouter le livre dans la base de données
            addBook($name, $author, $year, $summary);
            header('Location: ../views/index.php?action=page2');
        }
        break;

    // Supprimer un livre
    case 'delete':
        // Vérifier si la requête est de type POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookId = $_POST['book_id_delete']; // Utiliser $_POST['book_id_delete'] au lieu de $_GET['id']
            
            // Supprimer le livre de la base de données
            deleteBook($bookId);
            header('Location: ../views/index.php?action=page2');
        }
        break;

    // Si l'action n'est pas reconnue, rediriger vers la page de modification par défaut
    default:
        header('Location: ../views/index.php?action=page3');
        break;
    }