<<<<<<< HEAD
# Smart Food Processing & Quality Management System

A production-ready full-stack web application built with Laravel 12, MySQL, Tailwind CSS, and Alpine.js.

## Overview

This system manages the entire food lifecycle from raw material acquisition through processing, packaging, storage, and distribution. It includes smart AI features to predict shelf life and quality scores.

## Features
- **Authentication & Authorization**: Secure login, role-based access control (Admin, Quality Manager, Processing Staff, Warehouse Staff, Distributor).
- **Dashboard**: Real-time analytics with Chart.js showing inventory, batches, and food loss percentages.
- **Raw Material Management**: Tracking suppliers, freshness scores, and batches.
- **Processing**: Tracks temperature, duration, humidity, and nutrient retention.
- **Quality Control**: Logs freshness, pH, contamination risk, and moisture levels.
- **Packaging & Storage**: Expiry tracking, temperature monitoring, warehouse heatmap data.
- **Smart AI**: Formula-based predictions for shelf life and quality scores.
- **RESTful APIs**: Protected with Laravel Sanctum.
- **Docker Ready**: Fully containerized setup for deployment.

## Tech Stack
- **Backend**: Laravel 12 (PHP 8.3+)
- **Frontend**: Blade, Tailwind CSS, Alpine.js, Chart.js
- **Database**: MySQL 8.0 (configured in Docker)
- **Cache & Queue**: Redis
- **Server**: Nginx

---

## Installation Guide (Local Development)

### Prerequisites
- PHP 8.3+
- Composer
- Node.js 20+
- MySQL (or use Docker)

### Steps
1. **Clone the repository** (if applicable) and navigate to the folder.
2. **Install PHP dependencies**:
   ```bash
   composer install
   ```
3. **Install Node dependencies**:
   ```bash
   npm install
   npm run build
   ```
4. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=smart_food
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```
5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```
6. **Start Local Server**:
   ```bash
   php artisan serve
   ```

---

## Deployment Guide (Production / Docker)

This repository includes a `docker-compose.yml`, `Dockerfile`, and `nginx` configurations, making it ready for production deployment on any VPS (AWS EC2, DigitalOcean, etc.).

### Steps for Deployment
1. Ensure **Docker** and **Docker Compose** are installed on your server.
2. Configure `.env` file for production (set `APP_ENV=production`, `APP_DEBUG=false`).
3. Build and run the containers in detached mode:
   ```bash
   docker-compose up -d --build
   ```
4. Run migrations inside the app container:
   ```bash
   docker exec -it smart-food-app php artisan migrate --force
   ```
5. Install and compile frontend assets:
   ```bash
   docker exec -it smart-food-app npm install
   docker exec -it smart-food-app npm run build
   ```
6. The application is now accessible on port `8080`. For production, place this behind a reverse proxy (e.g., another Nginx instance) with SSL.

---

## REST API Documentation

All API routes require a Bearer Token (Sanctum authentication).
Prefix: `/api`

### Endpoints
- `GET /raw-materials`: List raw materials
- `POST /raw-materials`: Create a raw material
- `GET /processing-batches`: List processing batches
- `POST /processing-batches`: Create a processing batch
- `GET /quality-checks`: List quality checks
- `POST /quality-checks`: Create a quality check
- `GET /warehouse-inventories`: List inventory
- `GET /distributions`: List distributions

### AI Endpoints
- `POST /predict/shelf-life`: Predicts shelf life based on temperature, humidity, and freshness score.
- `POST /predict/quality-score`: Predicts quality score based on pH and moisture levels.

---

## Database Schema Explanation

1. **Users**: Authentication & Roles.
2. **Raw_Materials**: Stores initial batch info, supplier, freshness, and nutrition.
3. **Processing_Batches**: Links to raw_materials. Tracks processing stages, energy usage, temperature.
4. **Quality_Checks**: Links to processing_batches. Stores pH, moisture, contamination risk.
5. **Packagings**: Links to processing_batches. Stores barcode, material, expiry date.
6. **Warehouse_Inventories**: Links to packagings. Tracks location, temperature, humidity.
7. **Distributions**: Links to warehouse_inventories. Tracks shipping destination and vehicle ETA.

---

## Testing
Run PHPUnit tests to verify functionality:
```bash
php artisan test
```

## Security Best Practices Followed
- CSRF protection via middleware.
- Sanctum for API token-based authentication.
- Password hashing using Bcrypt.
- Input validation via Laravel Requests.
- SQL injection prevention via Eloquent ORM.
=======
# Food-processing-system
>>>>>>> 3b53957bde9bc1f1dc413c4ec8005457039d44ca
