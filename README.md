
# 📚 Book Information Management System (PHP + Tailwind CSS)

## 🎯 Objective

This is a web application built using **Vanilla PHP**, **SQLite**, and **Tailwind CSS**. The application allows users to register, log in, and manage their personal collection of books in a simple, responsive, and elegant interface.

---

## 🛠 Features

### 🔐 User Authentication
- Register with a username and password.
- Login and logout functionality.
- Passwords are hashed before storing in the database.
- Users are redirected to a dashboard after successful login.

### 📘 Book Management
- Authenticated users can:
  - Add books with:
    - Title
    - Author
    - Year of Publication
    - Personal Recommendations
  - View a list of their books.
  - Edit or delete existing book entries.
- Each user only sees and manages their own books.

### 🌐 Front-End
- Clean and fully responsive UI with **Tailwind CSS**.
- Mobile-friendly design for all pages.
- Styled login, register, and book dashboard interfaces.

---

## 🧱 Database Structure (SQLite)

### Database: `database/database.db`

#### `users` Table
| Column        | Type     | Description              |
|---------------|----------|--------------------------|
| id            | INTEGER  | Primary Key              |
| username      | TEXT     | Unique username          |
| password_hash | TEXT     | Hashed password          |

#### `books` Table
| Column           | Type     | Description                      |
|------------------|----------|----------------------------------|
| id               | INTEGER  | Primary Key                      |
| user_id          | INTEGER  | Foreign Key (users.id)           |
| title            | TEXT     | Title of the book                |
| author           | TEXT     | Author of the book               |
| year_of_publish  | INTEGER  | Year published                   |
| recommendations  | TEXT     | User’s notes or review           |

---

## 🧪 Technologies Used

- **PHP (Vanilla PHP 7.4+)**
- **SQLite**
- **Tailwind CSS 3**
- **HTML5 & Blade-like PHP templates**
- **Sessions for authentication**

---

## 🚀 Getting Started

### 🖥 Requirements

- PHP 7.4+ installed
- SQLite3 installed
- Tailwind CSS compiled or CDN version
- A local server like XAMPP, WAMP, or PHP’s built-in server

### ⚙️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/FranklineKirwa/Book_information_management_system.git
   cd Book_information_management_system
