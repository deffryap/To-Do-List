<?php
class Task
{
    private $id;
    private $taskName;
    private $note;
    private $deadline;

    public function __construct($taskName, $note = '', $deadline = '')
    {
        $this->taskName = $taskName;
        $this->note = $note;
        $this->deadline = $deadline;
    }

    // Getter dan setter untuk enkapsulasi
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTaskName()
    {
        return $this->taskName;
    }

    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note)
    {
        $this->note = $note;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    public function deleteTask($taskId)
    {
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    $this->connection->query($sql);
    }

    // Metode lain sesuai kebutuhan
}
?>
