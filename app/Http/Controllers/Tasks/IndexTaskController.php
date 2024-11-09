<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class IndexTaskController extends Controller
{
    public function __invoke(): Collection
    {
        return Auth::user()->tasks()->get();
    }
}
