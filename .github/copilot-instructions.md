# Copilot Instructions for project10

## Architecture Overview

This is a **Laravel 10 full-stack application** (blog/donation platform) with the following data model:

- **Users**: Authentication via Laravel auth, with optional `admin` and `avatar` fields
- **Posts**: Published blog content with `published` (boolean) and `published_at` (timestamp) fields; use `Post::isPublished()` for publication status checks
- **Donates**: Basic model for donation tracking (see `database/migrations/2026_01_15_152453_create_donates_table.php`)
- **Comments**: Nested under posts (route model binding via `routes/main.php`)

### Route Structure
- **Public**: Home, blog listing/detail (unauthenticated)
- **Auth**: Login/register views
- **Admin**: Admin CRUD (see `routes/admin.php`)
- **API**: Sanctum token-based endpoints (see `routes/api.php`)

## Database & Query Patterns

### Eloquent Models Location
All models are in `app/Models/` with property type hints in PHPDoc blocks (example: `@property bool $published`).

### Migration-First Approach
- Migrations stored in `database/migrations/` with timestamps for tracking
- Use `foreignId()` with `->constrained()` for foreign keys (see `posts` migration)
- Always define `$fillable` in models for mass assignment security

### Filtering in Controllers
The `BlogController::index()` demonstrates the preferred pattern:
```php
$query = Post::query()
    ->where('published', true)
    ->whereNotNull('published_at');
    
if ($search = $validated['search'] ?? null) {
    $query->where('title', 'ilike', "%{$search}%");
}
// ... more filters ...
$posts = $query->latest('published_at')->paginate(12);
```

## Controller Organization

Controllers are organized in subdirectories by feature:
- `app/Http/Controllers/Admin/` → Admin-only CRUD
- `app/Http/Controllers/User/` → User profile/settings
- `app/Http/Controllers/Api/` → API endpoints
- `app/Http/Controllers/Posts/` → Nested resources (comments under posts)

Use **single-action controllers** where appropriate (e.g., `TestController`).

## Frontend & Build

- **Template Engine**: Blade (Laravel's template engine)
- **View Organization**: `resources/views/` → category folders (`blog/`, `auth/`, `home/`, `components/`)
- **Asset Pipeline**: Vite (configured in `vite.config.js`) processes `resources/css/app.css` and `resources/js/app.js`
- **CSS Framework**: Bootstrap 5 (pagination configured for Bootstrap; see `blog/index.blade.php` for examples)
- **Build Commands**:
  - Development: `npm run dev` (Vite watch mode)
  - Production: `npm run build`

## Custom Helpers

Helper functions in `app/helpers.php` (autoloaded via `composer.json`):
- `active_link()` → Returns CSS class if route matches current page
- `_alert()` → Flash session alerts for notifications
- `validate()` → Wrapper around Laravel's validator
- `test()` → Returns the 'test' container binding (used in `/test` route)

These are globally available in Blade templates and PHP code.

## Testing

- **Framework**: PHPUnit (configured in `phpunit.xml`)
- **Test Structure**: `tests/Feature/` and `tests/Unit/` directories
- **Run Tests**: `php artisan test`
- **Testing Setup**: Use `CreatesApplication` trait (see `tests/TestCase.php`)
- **Environment**: Tests run with `APP_ENV=testing`; SQLite in-memory or configured DB

## Common Development Commands

```bash
# Database
php artisan migrate              # Run all migrations
php artisan migrate:fresh       # Reset and re-run migrations
php artisan seed                # Run seeders
php artisan tinker              # REPL for testing queries

# Code Quality
./vendor/bin/pint               # Laravel code style fixer
php artisan ide-helper:generate # Generate IDE hints for facades

# Server & Assets
php artisan serve               # Start dev server (http://localhost:8000)
npm run dev                     # Vite watch mode (concurrent with artisan serve)
npm run build                   # Production asset build
```

## Validation & Form Patterns

- Use `$request->validate([])` in controllers (returns validated array)
- Custom validation rules in `app/Rules/` (example: `Phone.php` for phone number validation)
- Form requests in `app/Http/Requests/` for complex validation

## Key Patterns to Follow

1. **Post Publication Logic**: Always check `$post->isPublished()` before displaying; never rely on `published` field alone
2. **Pagination Default**: Blog listings paginate by 12 items (see `BlogController::index()`)
3. **Route Names**: Use route names (`->name()`) not hardcoded URLs; reference with `route('name')`
4. **Flash Sessions**: Use `_alert('success', 'Message')` for user feedback, access in views via `session('alert')`
5. **Carbon Dates**: Dates cast to `'datetime'` in models; use `Carbon` for date operations
6. **Case-Insensitive Search**: Use `'ilike'` operator for PostgreSQL case-insensitive search (example in `BlogController`)

## Dependencies & Stack

- **PHP**: 8.1+ (check `composer.json`)
- **Database**: PostgreSQL (inferred from `ilike` operator in queries) or MySQL/SQLite
- **Key Packages**:
  - `laravel/sanctum` → API token authentication
  - `laravel/tinker` → Interactive shell
  - `barryvdh/laravel-ide-helper` → IDE autocomplete
  - `fakerphp/faker` → Seed data generation
  - `phpunit/phpunit` → Testing

## File Locations Reference

- Routes: `routes/{main.php,admin.php,api.php,user.php}`
- Controllers: `app/Http/Controllers/{feature}/` 
- Models: `app/Models/{Model.php}`
- Views: `resources/views/{category}/{view.blade.php}`
- Migrations: `database/migrations/{timestamp}_{description}.php`
- Seeders: `database/seeders/{Seeder.php}`
- Tests: `tests/{Feature,Unit}/{*Test.php}`
- Config: `config/{*.php}` (database, app, auth, etc.)
