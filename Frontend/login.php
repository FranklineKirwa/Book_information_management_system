<?php
require_once 'database.php';

class BookManager {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function addBook($user_id, $title, $author, $year, $recommendations) {
        $stmt = $this->db->prepare("INSERT INTO books (user_id, title, author, year_of_publish, recommendations)
            VALUES (:user_id, :title, :author, :year, :recommendations)");
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':year', $year);
        $stmt->bindValue(':recommendations', $recommendations);
        return $stmt->execute();
    }

    public function getUserBooks($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = :user_id");
        $stmt->bindValue(':user_id', $user_id);
        $result = $stmt->execute();
        $books = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $books[] = $row;
        }
        return $books;
    }

    public function updateBook($book_id, $user_id, $title, $author, $year, $recommendations) {
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author = :author,
            year_of_publish = :year, recommendations = :recommendations
            WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':year', $year);
        $stmt->bindValue(':recommendations', $recommendations);
        $stmt->bindValue(':id', $book_id);
        $stmt->bindValue(':user_id', $user_id);
        return $stmt->execute();
    }

    public function deleteBook($book_id, $user_id) {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':id', $book_id);
        $stmt->bindValue(':user_id', $user_id);
        return $stmt->execute();
    }
}