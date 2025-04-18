<?php
// app/Http/Kernel.php

namespace App\Http\Middleware;

class Kernel
{
protected $routeMiddleware = [
    // middleware lainnya...
    'role' => \App\Http\Middleware\CheckRole::class,
];
}
