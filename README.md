# Middle-earth REST API (Laravel)

A Laravel REST API that models a Tolkien-inspired Middle-earth dataset: heroes, creatures, realms, regions and magical artifacts, with Eloquent relationships, Sanctum-ready auth scaffolding, seeders and a Postman collection.

## Stack

| Piece | Choice |
| --- | --- |
| Framework | Laravel (see `composer.json`, currently `^12`) |
| Language | PHP 8.2+ |
| Auth | Laravel Sanctum |
| Database | MySQL or SQLite (local) |
| Optional | Laravel Sail (`compose.yaml`) |
| API tests | Postman collection under `JSON POSTMAN/` |

## Domain model

| Resource | Role |
| --- | --- |
| `regions` | Geographic areas |
| `realms` | Governed territories (belong to a region) |
| `heroes` | Characters (belong to a realm; many-to-many with artifacts) |
| `creatures` | World entities with a threat level |
| `artifacts` | Magical items |

Special routes (see `routes/api.php`):

- `GET /api/heroes/alive`
- `GET /api/creatures/dangerous?level=…`
- `GET /api/artifacts/top`
- `POST` / `DELETE /api/artifact-hero` (assign / remove artifact ↔ hero)
- Nested reads: `/api/realms/{id}/heroes`, `/api/heroes/{id}/artifacts`, `/api/artifacts/{id}/heroes`
- Full REST resources for `regions`, `realms`, `heroes`, `creatures`, `artifacts`

## Run locally

```bash
git clone https://github.com/AgustinRH/API-REST-sobre-la-Tierra-Media-del-universo-Tolkien.git
cd API-REST-sobre-la-Tierra-Media-del-universo-Tolkien

composer install
cp .env.example .env
php artisan key:generate

# Configure DB_* in .env, then:
php artisan migrate
php artisan db:seed   # optional Tolkien sample data

php artisan serve
```

API base: `http://localhost:8000/api`

### Sail (optional)

```bash
./vendor/bin/sail up
./vendor/bin/sail artisan migrate:refresh --seed
```

### Frontend assets (only if you touch the default Laravel UI)

```bash
npm install
npm run build   # or npm run dev
```

## Postman

Import `JSON POSTMAN/api-rest-test.json`. Point the collection base URL at your local server (often `http://localhost:8000/api`).

## Tests and style

```bash
php artisan test
./vendor/bin/pint
```

## Author

[Agustín Rubí Hernández](https://github.com/AgustinRH)

License: MIT (stated in project docs; add a `LICENSE` file in the repo root if you want GitHub to detect it).
