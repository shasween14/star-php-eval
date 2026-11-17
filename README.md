# News Portal – Laravel Evaluation

A small news portal built with Laravel, Eloquent, Blade and Bootstrap, using SQLite.
It has a JSON articles endpoint, a list page with live search, and an article detail page.

## Requirements

- PHP (version required by `composer.json`) with the `pdo_sqlite` extension
- Composer 2.x

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create the SQLite database file, then migrate and seed:

```bash
# macOS / Linux
touch database/database.sqlite

# Windows PowerShell
New-Item database/database.sqlite -ItemType File

php artisan migrate --seed
php artisan serve
```

Open http://localhost:8000 (it redirects to the article list).

To reset the data at any time: `php artisan migrate:fresh --seed`.

## Pages and endpoints

| URL | Description |
|---|---|
| `/articles` | Article list with live search |
| `/articles/{permalink}` | Article detail page |
| `/api/articles` | JSON list of published articles |
| `/api/articles?search=term` | Same, filtered by title, author or category name |

## Tests

```bash
php artisan test
```

## What was built

- **Models & migration** – `Category` has many `Article`; `Article` belongs to `Category`.
  `permalink` is unique and is used as the route key, so URLs look like `/articles/some-headline-4821`.
- **Extra fields** – `author` (byline) and `status` (`1` = published, `0` = draft).
  Only published articles are shown, through an Eloquent `published` scope; drafts return 404 on the detail page.
- **Factories & seeder** – `ArticleFactory` / `CategoryFactory` use Faker.
  `php artisan db:seed` creates 6 categories and 20 articles (17 published, 3 drafts).
- **JSON API** – `Api\ArticleController@index` returns an `ArticleResource` collection.
  The category is eager loaded with `with('category')` to avoid N+1 queries.
- **List page** – Blade + Bootstrap. The page calls the JSON endpoint and renders the cards.
  The search box is debounced (300 ms) and updates the list as you type; titles are escaped before rendering.
- **Detail page** – server-rendered Blade view showing title, category, author, published date, summary and body.

## Design notes

- **No pagination.** The data set is small (20 articles). With a larger data set I would use `paginate()`.
- **Search scope.** The task asks for filtering by title; the search also matches author and category name.
  The `OR` conditions are grouped so that draft articles can never appear in results.
- **List via API, detail server-rendered.** The list needs live updates, so it uses `fetch`.
  The detail page does not, so a normal Blade page is simpler and works on direct links and refresh.
