<!-- index.php -->
<?php
require_once 'Database.php';
require_once 'Task.php';

$db = new Database();
$tasks = $db->getTasks();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses form submission untuk menambahkan tugas
    if (isset($_POST['addTask'])) {
        $taskName = $_POST['taskName'];
        $note = $_POST['note'];
        $deadline = $_POST['deadline'];

        $newTask = new Task($taskName, $note, $deadline);
        $db->addTask($newTask);

        // Perbarui daftar tugas setelah menambahkan tugas baru
        $tasks = $db->getTasks();
    } elseif (isset($_POST['deleteTask'])) {
        // Proses form submission untuk menghapus tugas
        $taskId = $_POST['taskId'];
        $db->deleteTask($taskId);

        // Perbarui daftar tugas setelah menghapus tugas
        $tasks = $db->getTasks();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Todo List</h1>
    </header>
    <div>
        <form method="post" action="">
            <label for="taskName">Task Name:</label>
            <input type="text" name="taskName" required>
            
            <label for="note">Note:</label>
            <textarea name="note"></textarea>
            
            <label for="deadline">Deadline:</label>
            <input type="date" name="deadline">
            
            <input type="submit" name="addTask" value="Add Task">
        </form>
    </div>

    <div>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <!-- Checkbox untuk checklist -->
                    <input type="checkbox" id="task<?php echo $task->getId(); ?>" name="task<?php echo $task->getId(); ?>">
                    
                    <label for="task<?php echo $task->getId(); ?>">
                        <strong><?php echo $task->getTaskName(); ?></strong>
                        <?php echo $task->getNote() ? " - {$task->getNote()}" : ''; ?>
                        <?php echo $task->getDeadline() ? " (Deadline: {$task->getDeadline()})" : ''; ?>
                    </label>

                    <!-- Tombol delete -->
                    <form method="post" action="">
                        <input type="hidden" name="taskId" value="<?php echo $task->getId(); ?>">
                        <input type="submit" name="deleteTask" value="Delete">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    
</body>
</html>