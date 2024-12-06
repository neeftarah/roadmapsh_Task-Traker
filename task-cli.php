<?php
require_once 'TaskList.php';

/**
 * Displays usage instructions for the task management CLI application.
 * @return void
 */
function showHelp(): void
{
    // Print usage instructions for each command and expected arguments
    echo "Usage: php task-cli.php <command> [arguments]\n";
    echo "Available commands:\n";
    echo "  add <description>        Add a new task with the given description\n";
    echo "  update <id> <description> Update the task with the given ID and description\n";
    echo "  delete <id>              Delete the task with the given ID\n";
    echo "  mark-in-progress <id>    Mark the task with the given ID as in progress\n";
    echo "  mark-done <id>           Mark the task with the given ID as done\n";
    echo "  list [status]            List all tasks, optionally filtered by status (todo, in-progress, done)\n";
}

$command = $argv[1] ?? null;
$taskList = new TaskList();

switch ($command) {
    case 'add':
        if (count($argv) < 3) {
            echo "Error: Missing task description\n\n";
            showHelp();
            exit(1);
        }
        $taskList->add($argv[2]);
        break;
    case 'update':
        if (count($argv) < 4) {
            echo "Error: Missing task ID or description\n\n";
            showHelp();
            exit(1);
        }
        $taskList->update($argv[2], $argv[3]);
        break;
    case 'delete':
        if (count($argv) < 3) {
            echo "Error: Missing task ID\n\n";
            showHelp();
            exit(1);
        }
        $taskList->delete($argv[2]);
        break;
    case 'mark-in-progress':
        if (count($argv) < 3) {
            echo "Error: Missing task ID\n\n";
            showHelp();
            exit(1);
        }
        $taskList->markInProgress($argv[2]);
        break;
    case 'mark-done':
        if (count($argv) < 3) {
            echo "Error: Missing task ID\n\n";
            showHelp();
            exit(1);
        }
        $taskList->markDone($argv[2]);
        break;
    case 'list':
        $status = $argv[2] ?? null;
        if (!is_null($status) && !in_array($status, ['todo', 'in-progress', 'done'])) {
            echo 'Error: Unknown status';
            showHelp();
            exit(1);
        }
        $taskList->list($status);
        break;
    default:
        echo "Error: Unknown command\n\n";
        showHelp();
        exit(1);
}