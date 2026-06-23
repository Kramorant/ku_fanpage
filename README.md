# Kaiju Universe Fan Page

A full-stack fan page for the Roblox game **Kaiju Universe**, with a Laravel REST API backend and Angular SPA frontend.

## Tech Stack

- **Backend:** Laravel 11, Laravel Sanctum, Filament v3
- **Frontend:** Angular 17 (standalone components), Angular CDK, html2canvas
- **Database:** MySQL
- **Cache:** Redis (predis driver)

## Repository Structure

```text
ku_fanpage/
├── backend/    # Laravel app
├── frontend/   # Angular app
└── README.md
```

## Local Development Setup

### Backend (`/backend`)

```bash
cd backend
composer install
cp .env.example .env
```

Configure database and Redis values in `.env` (XAMPP MySQL + local Redis), then run:

```bash
php artisan migrate
php artisan storage:link
php artisan serve
```

Admin panel: `http://localhost:8000/admin`

### Frontend (`/frontend`)

```bash
cd frontend
npm install
npx ng serve
```

Frontend app: `http://localhost:4200`
