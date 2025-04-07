<?php
session_start();
require_once '../Files/auth.php';
require_once '../Files/books.php';

$auth = new Auth();
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$bookManager = new BookManager();
$books = $bookManager->getUserBooks($_SESSION['user_id']);

if (isset($_POST['add_book'])) {
    $bookManager->addBook($_SESSION['user_id'], $_POST['title'], $_POST['author'],
        $_POST['year'], $_POST['recommendations']);
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">My Book Collection</h1>
            <a href="../Processing/process.php?logout=1" class="bg-red-500 text-white px-4 py-2 rounded">Logout</a>
        </div>

        <!-- Add Book Form -->
        <form method="POST" class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="grid grid-cols-1 gap-4">
                <input type="text" name="title" placeholder="Book Title" required
                    class="p-2 border rounded">
                <input type="text" name="author" placeholder="Author" required
                    class="p-2 border rounded">
                <input type="number" name="year" placeholder="Year"
                    class="p-2 border rounded">
                <textarea name="recommendations" placeholder="Recommendations"
                    class="p-2 border rounded h-32"></textarea>
                <button type="submit" name="add_book"
                    class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                    Add Book
                </button>
            </div>
        </form>

        <!-- Book List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($books as $book): ?>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                    <p>Year: <?php echo htmlspecialchars($book['year_of_publish']); ?></p>
                    <p class="mt-2"><?php echo htmlspecialchars($book['recommendations']); ?></p>
                    <div class="mt-4 flex gap-2">
                        <button onclick="showEditForm(<?php echo $book['id']; ?>, '<?php echo htmlspecialchars($book['title']); ?>', '<?php echo htmlspecialchars($book['author']); ?>', '<?php echo $book['year_of_publish']; ?>', '<?php echo htmlspecialchars($book['recommendations']); ?>')"
                            class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                        <form method="POST" action="../Processing/process.php">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit" name="delete_book"
                                class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Edit Book</h2>
            <form method="POST" action="../Processing/process.php">
                <input type="hidden" name="book_id" id="edit_book_id">
                <div class="mb-4">
                    <input type="text" name="title" id="edit_title" required
                        class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <input type="text" name="author" id="edit_author" required
                        class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <input type="number" name="year" id="edit_year"
                        class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <textarea name="recommendations" id="edit_recommendations"
                        class="w-full p-2 border rounded h-32"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" name="update_book"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    <button type="button" onclick="hideEditForm()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showEditForm(id, title, author, year, recommendations) {
            document.getElementById('edit_book_id').value = id;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_author').value = author;
            document.getElementById('edit_year').value = year;
            document.getElementById('edit_recommendations').value = recommendations;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function hideEditForm() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>