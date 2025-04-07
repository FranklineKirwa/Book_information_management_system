<?php
class Database {
    private $db;

    public function __construct() {
        $this->db = new SQLite3('books.db');
        $this->createTables();
    }

    private function createTables() {
        // Users table
        $this->db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL
        )");

        // Books table
        $this->db->exec("CREATE TABLE IF NOT EXISTS books (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            title TEXT NOT NULL,
            author TEXT NOT NULL,
            year_of_publish INTEGER,
            recommendations TEXT,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )");
    }

    public function getConnection() {
        return $this->db;
    }
}

$db=new database();
echo "Database and tables have been created.";