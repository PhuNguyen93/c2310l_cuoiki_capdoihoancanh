protected $routeMiddleware = [
    // Các middleware khác
    'role' => \App\Http\Middleware\CheckRole::class,
];
