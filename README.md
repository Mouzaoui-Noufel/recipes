# Recipe Website

This is a Laravel-based web application for managing and sharing recipes. It includes user authentication, recipe creation, editing, and viewing features.

## Features

- User registration and login
- Recipe CRUD (Create, Read, Update, Delete)
- Ratings and comments on recipes
- Responsive design with Tailwind CSS and Vite
- API endpoints for recipes

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or other supported database

## Setup Instructions

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/your-repo.git
   cd your-repo
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Copy the example environment file and configure your environment variables:

   ```bash
   cp .env.example .env
   ```

   Update `.env` with your database and other settings.

4. Generate application key:

   ```bash
   php artisan key:generate
   ```

5. Run database migrations:

   ```bash
   php artisan migrate
   ```

6. Install frontend dependencies:

   ```bash
   npm install
   ```

7. Build frontend assets:

   ```bash
   npm run build
   ```

8. Run the development server:

   ```bash
   php artisan serve
   ```

   Access the site at [http://localhost:8000](http://localhost:8000).

## Deployment

You can deploy this Laravel application on platforms like Render.com, DigitalOcean, or any PHP-capable hosting.

For Render.com, use the following commands:

- Build Command: `composer install && php artisan migrate --force`
- Start Command: `php artisan serve --host 0.0.0.0 --port 10000`

Add your environment variables in the Render dashboard.

## License

This project is open-sourced software licensed under the MIT license.
