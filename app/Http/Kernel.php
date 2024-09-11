protected $routeMiddleware = [
    // Các middleware khác...
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    'auth' => \App\Http\Middleware\Authenticate::class, // Middleware auth đã tích hợp sẵn
];
