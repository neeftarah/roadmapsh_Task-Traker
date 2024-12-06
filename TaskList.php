<?php
require_once 'Task.php';

class TaskList
{
    private const string FILE = 'tasks.json';
    private array $tasks;

    public function __construct()
    {
        if (is_file(self::FILE)) {
            $this->tasks = json_decode(file_get_contents(self::FILE));
        }
    }

    public function add($description, $status = 'todo'): void
    {
        $id = !empty($this->tasks) ? count($this->tasks) + 1 : 1;
        $task = new Task($id, $description, $status);
        $this->tasks[] = $task;
        $this->save();

        echo 'Task successfully added!';
    }

    public function update(string $id, string $description): void
    {
        $key = array_search($id, array_column($this->tasks, 'id'));

        if (false === $key) {
            echo 'Task not found!';
            exit(1);
        }

        $this->tasks[$key]->description = $description;
        $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');

        $this->save();

        echo 'Task successfully updated!';
    }

    private function changeStatus($id, $status): void
    {
        $key = array_search($id, array_column($this->tasks, 'id'));

        if (false === $key) {
            echo 'Task not found!';
            exit(1);
        }

        if (!in_array($status, ['todo', 'in-progress', 'done'])) {
            echo 'Error: Unknown status';
            exit(1);
        }

        $this->tasks[$key]->status = $status;
        $this->tasks[$key]->updatedAt = date('Y-m-d H:i:s');

        $this->save();

        echo 'Task successfully updated!';
    }

    public function markInProgress(string $id): void
    {
        $this->changeStatus($id, 'in-progress');
    }

    public function markDone(string $id): void
    {
        $this->changeStatus($id, 'done');
    }

    public function delete($id): void
    {
        $key = array_search($id, array_column($this->tasks, 'id'));

        if (false === $key) {
            echo 'Task not found!';
            exit(1);
        }

        unset($this->tasks[$key]);

        $this->save();

        echo 'Task successfully deleted!';
    }

    public function list($status = null): void
    {
        //this is for beautify the output
        echo str_repeat("-", 88) . "\n";
        printf("| %-4s | %-20s | %-10s | %-19s | %-19s |\n", "Id", "Description", "Status", "Create at", "Updated At");
        echo str_repeat("-", 88) . "\n";

        if (empty($this->tasks)) {
            echo "|" . str_pad("No task have been saved!", 86, ' ', STR_PAD_BOTH) . "|\n";
        } else {
            foreach ($this->tasks as $task) {
                if (empty($status) || $status == $task->status) {
                    printf(
                        "| %-4s | %-20s | %-10s | %-19s | %-19s |\n",
                        $task->id,
                        $task->description,
                        $task->status,
                        $task->createdAt,
                        $task->updatedAt
                    );
                }
            }
        }

        echo str_repeat("-", 88) . "\n";
    }

    private function save(): void
    {
        file_put_contents(self::FILE, json_encode($this->tasks));
    }
}