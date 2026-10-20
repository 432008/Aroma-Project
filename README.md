# Aroma — Luxury Perfume E-Commerce

A full-stack **Laravel 12** e-commerce web application for a luxury perfume brand, featuring a dark gold-on-black editorial storefront and a complete admin dashboard.

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-7-646CFF?logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📖 About

**Aroma** is a portfolio-grade perfume store built from scratch with Laravel. It covers the entire shopping journey — browsing collections, searching fragrances, product reviews, cart, checkout, order history — plus a role-protected admin area for managing products, categories, orders, users, messages and reviews.

The UI follows a luxury editorial direction (charcoal + gold, serif display type) with an accessible, responsive layout.

---

## ✨ Features

### Storefront
- **Home page** — hero, featured perfumes, collections, testimonials, newsletter
- **Perfume catalogue** — listing, keyword search and collection filtering
- **Product detail** — gallery, notes, price, stock, star ratings and reviews
- **Collections** — browse by fragrance family (Floral, Woody, Fresh, Oriental, …)
- **Shopping cart** — add / update quantity / remove
- **Checkout** — shipping details and order placement
- **Order history** — order list and full order detail
- **Customer profile** — update personal details and password
- **Authentication** — register, login, logout, forgot/reset password
- **Contact form** and **newsletter subscription**
- **Informational pages** — Shipping, Returns, Privacy, Terms, FAQs (config-driven)

### Admin dashboard (`/admin`)
- **Dashboard** with store statistics
- **Products** — full CRUD with image upload
- **Categories** — full CRUD
- **Orders** — list, view and update order status
- **Users** — list, view, change role, delete
- **Contact messages** — list, view, mark read/unread, delete
- **Reviews** — approve, reject and delete

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12, PHP 8.2+ |
| Database | MySQL |
| Frontend | Blade, Bootstrap 5 (CDN), Bootstrap Icons |
| Styling | Custom design-token CSS built with Vite 7 |
| Interactivity | Vanilla JavaScript (`resources/js/app.js`) |
| Fonts | Google Fonts — Cormorant Garamond & Montserrat |

---

## ✅ Requirements

- PHP **8.2+** with the usual Laravel extensions (`mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) 18+ and npm
- MySQL 8 (or MariaDB)

---

## 🚀 Installation

```bash
# 1. Clone the repository
git clone https://github.com/<your-username>/aroma.git
cd aroma

# 2. Install PHP dependencies
composer install

# 3. Create your environment file and app key
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aroma
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 4. Create the database tables and demo data
php artisan migrate --seed

# 5. Expose uploaded images (creates public/storage -> storage/app/public)
php artisan storage:link

# 6. Install front-end dependencies and build assets
npm install
npm run build

# 7. Serve the application
php artisan serve
```

The site is now available at **http://localhost:8000**.

> Prefer one command? `composer setup` will install dependencies, copy `.env`, generate the key, migrate, install npm packages and build assets. You still need to run `php artisan storage:link` and `php artisan migrate --seed` manually.

### Development with hot reload

```bash
composer dev
```

Runs the PHP server, queue listener, log viewer (`pail`) and Vite dev server together.


## 📁 Project Structure

```
app/
├── Http/Controllers/        # Storefront + Admin controllers
├── Http/Middleware/         # Admin access middleware
└── Models/                  # User, Product, Category, Cart, Order, OrderItem, Review, ContactMessage
config/
└── pages.php                # Content for the static info pages
database/
├── migrations/              # Schema
└── seeders/                 # Demo categories, products and admin user
public/
├── images/                  # Logo + favicons
└── storage/                 # Symlink to storage/app/public
resources/
├── css/app.css              # Design-token stylesheet
├── js/app.js                # Cart, filters, toasts, reveal animations
└── views/
    ├── layouts/             # Master layout
    ├── components/          # Navbar, footer, product card, etc.
    └── admin/               # Admin dashboard screens
routes/
└── web.php                  # All application routes
```

---

## 🛠️ Useful Commands

```bash
php artisan migrate:fresh --seed    # Reset the database and re-seed
php artisan storage:link            # Re-create the storage symlink
npm run dev                         # Vite dev server (hot reload)
npm run build                       # Production asset build
php artisan test                    # Run the test suite
./vendor/bin/pint                   # Code style (Laravel Pint)
```

---

## 🔒 Security Notes

- Never commit your `.env` file — it is already listed in `.gitignore`.
- Set `APP_DEBUG=false` and `APP_ENV=production` in production.
- Mail uses the `log` driver by default, so password-reset links are written to `storage/logs/laravel.log`. Configure a real mailer to send emails.

---
## Author

**Janki Lodhari**

GitHub: 432008

## Repository

View Aroma – Fine Fragrances on GitHub

Built with Laravel to deliver a refined online fragrance shopping experience.

## 📄 License

Released under the [MIT License](https://opensource.org/licenses/MIT).
