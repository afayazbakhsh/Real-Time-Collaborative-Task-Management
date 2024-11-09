<?php

namespace App\Broadcasting;

use App\Models\Task;
use App\Models\User;

class TaskChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, Task $task): array|bool
    {
        $task->user->id === $user->id;
    }
}
