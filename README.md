Task Tracker
============

A simple Task Tracker command line interface (CLI) App built with PHP that used to track and manage your tasks.  
This project is my solution to the [roadmap.sh challenge](https://roadmap.sh/projects/task-tracker).

Features :
----------

* Add, Update, and Delete tasks
* Mark a task as in progress or done
* List all tasks
* List all tasks that are done
* List all tasks that are not done
* List all tasks that are in progress

Prerequisites :
---------------
To run this CLI tool, you’ll need:
* PHP: Version 8.3 or newer

Examples :
----------

```shell
# Adding a new task
php task-cli.php add "Buy groceries"

# Updating and deleting tasks
php task-cli.php update 1 "Buy groceries and cook dinner"
php task-cli.php delete 1

# Marking a task as in progress or done
php task-cli.php mark-in-progress 1
php task-cli.php mark-done 1

# Listing all tasks
php task-cli.php list

# Listing tasks by status
php task-cli.php list done
php task-cli.php list todo
php task-cli.php list in-progress
```