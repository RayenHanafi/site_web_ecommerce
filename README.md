# BookShop Project

A modern online bookstore built with Symfony, featuring user authentication, shopping cart functionality, and admin dashboard.

## Features

- 📚 Book browsing and searching with DataTables integration
- 🛒 Shopping cart functionality
- 👤 User authentication (Login/Register)
  - Traditional login
  - Password reset functionality
- 📧 Contact form with email notifications
- 🛡️ Admin dashboard
  - Book management (Add/Edit/Delete)
  - Order management
- 📱 Responsive design
- 🖨️ PDF generation for orders

## Requirements

- PHP 8.0 or higher
- Symfony 6.x
- MySQL/MariaDB
- Composer
- XAMPP/Web Server

## Installation

1. Clone the repository:
```bash
git clone [repository-url]
cd BookShop_project_v2
```

2. Install dependencies:
```bash
composer install
```

3. Configure your database in `.env`:
```
DATABASE_URL="mysql://username:password@127.0.0.1:3306/bookshop_db"
```

4. Create database and run migrations:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Configure mailer in `.env`:
```
MAILER_DSN=smtp://your-email-configuration
```

## Usage

1. Start your local server:
```bash
symfony server:start
```

2. Access the application:
- Main site: `http://localhost:8000`
- Admin dashboard: `http://localhost:8000/admin`

## Project Structure

- `src/Controller/` - Application controllers
- `src/Entity/` - Database entities
- `src/Form/` - Form types
- `templates/` - Twig templates
- `public/` - Public assets (CSS, JS, images)

## Security

- CSRF protection enabled
- Secure password hashing
- Role-based access control
- Protected admin routes

## Author

- Sonia Mejri
- Rayen Hanafi
- Nour Nejia Slim
- Zaineb Kchaou
- Mariem Daoud

