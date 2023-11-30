<?php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'to-do list';
    private $connection;

    public function __construct()
    {
        // Menggunakan constructor untuk membuka koneksi ke database
        $this->connect();
    }

    private function connect()
    {
        // Implementasi koneksi ke database
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getTasks()
    {
        $tasks = array();
        $result = $this->connection->query("SELECT * FROM tasks");

        while ($row = $result->fetch_assoc()) {
            $task = new Task($row['task_name'], $row['note'], $row['deadline']);
            $task->setId($row['id']);
            $tasks[] = $task;
        }

        return $tasks;
    }

    public function addTask(Task $task)
    {
        // Implementasi untuk menambahkan tugas baru
        $taskName = $task->getTaskName();
        $note = $task->getNote();
        $deadline = $task->getDeadline();

        $sql = "INSERT INTO tasks(task_name, note, deadline) VALUES ('$taskName', '$note', '$deadline')";
        $this->connection->query($sql);
    }

    public function deleteTask($taskId)
    {
        $sql = "DELETE FROM tasks WHERE id = $taskId";
        $this->connection->query($sql);
    }

    // Tambahkan metode lain sesuai kebutuhan (update, delete, dll.)
}
?>
