<?php

class Task
{
    public function __construct(
        public int $id,             // A unique identifier for the task
        public string $description, // A short description of the task
        public string $status,      // The status of the task (todo, in-progress, done)
        public string $createdAt = "-",
        public string $updatedAt = "-",
    ) {
        $this->createdAt = date('Y-m-d H:i:s');
    }
}