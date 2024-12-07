<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class IndexTaskController extends Controller
{
    public function __invoke(): JsonResource
    {
        return TaskCollection::collection(Auth::user()->tasks);
    }
}
