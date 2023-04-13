<?php
require_once 'models/model.php';
require_once 'views/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'page1';

switch ($action) {
    case 'page1':
        require_once 'views/page1.php';
        break;
    case 'page2':
        $books = getAllBooks();
        require_once 'views/page2.php';
        break;
    case 'page3':
        require_once 'views/page3.php';
        break;
    case 'modify':
        $bookId = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            modifyBook($bookId, $_POST['name'], $_POST['author'], $_POST['year'], $_POST['summary']);
            header('Location: controller.php?action=page2');
        } else {
            $book = getBookById($bookId);
            require_once 'views/modifyBook.php';
        }
        break;
    case 'delete':
        $bookId = $_GET['id'];
        deleteBook($bookId);
        header('Location: controller.php?action=page2');
        break;
    default:
        require_once 'views/page1.php';
        break;
}
?>