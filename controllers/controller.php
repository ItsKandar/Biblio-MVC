<?php
require_once 'models/model.php';
require_once 'views/header.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'page3';

switch ($action) {
    case 'page1':
        require_once 'views/page1.php';
        break;
    case 'page2':
        $books = getAllBooks();
        require_once 'views/page2.php';
        break;
    case 'page3':
        if (isset($_SESSION['selected_book'])) {
            $book = $_SESSION['selected_book'];
            unset($_SESSION['selected_book']);
        }    
        require_once 'views/page3.php';
        break;

    case 'select_book':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookId = $_POST['id'];
            $book = getBookById($bookId);

            if ($book) {
                $_SESSION['selected_book'] = $book; // Stocker le livre sélectionné dans la session
                header('Location: views/index.php?action=page3');
            } else {
                // Rediriger vers page3 si le livre n'est pas trouvé
                header('Location: views/index.php?action=page3');
            }
        } else {
            // Gérer le cas où la méthode n'est pas POST
            header('Location: views/index.php?action=page3');
        }
        break;

    case 'modify':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];
            modifyBook($id, $name, $author, $year, $summary);
            header('Location: views/index.php?action=page2');
            break;
        } else {
            // Gérer le cas où la méthode n'est pas POST
        }
        break;

   case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $summary = $_POST['summary'];
            addBook($name, $author, $year, $summary);
            header('Location: views/index.php?action=page2');
        } else {
            // Gérer le cas où la méthode n'est pas POST
        }
        break;

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $bookId = $_POST['book_id_delete']; // Utiliser $_POST['book_id_delete'] au lieu de $_GET['id']
            deleteBook($bookId);
            header('Location: views/index.php?action=page2');
            break;
        } else {
            // Gérer le cas où la méthode n'est pas POST
        }
        break;
        default:
        header('Location: views/index.php?action=page3');
        break;
}