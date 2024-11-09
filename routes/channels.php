<?php

use App\Broadcasting\TaskChannel;
use App\Models\Task;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('task.3', function ($user, $task) {
    \Illuminate\Support\Facades\Log::info('ss');
    return $task->get();
});
