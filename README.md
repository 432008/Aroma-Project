# 🌸 Aroma — Fine Fragrances

<p align="center">
  <strong>An elegant Laravel-powered perfume e-commerce experience.</strong>
</p>

<p align="center">
  Discover fragrances, explore perfume collections, and enjoy a seamless online shopping experience with Aroma.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-Web%20Framework-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-Backend-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/JavaScript-Frontend-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/Status-In%20Development-blue?style=for-the-badge" alt="Project status">
</p>

<p align="center">
  <a href="https://github.com/432008/Aroma-Project">View Repository</a>
</p>

---

## 📖 About the Project

**Aroma — Fine Fragrances** is a Laravel-based perfume e-commerce web application designed to provide customers with a convenient way to browse fragrances and shop online.

The application includes customer-facing shopping pages and administrative interfaces for managing products, categories, orders, users, customer messages, and reviews.

This project demonstrates the development of a full-stack web application using Laravel, PHP, Blade templates, CSS, and JavaScript.

## 📸 Screenshots

Add screenshots of your actual application in the `docs/screenshots/` directory.

| Home Page | Perfume Collection |
|---|---|
| ![Aroma Home Page](docs/screenshots/home.png) | ![Perfume Collection](docs/screenshots/about.png) |

| Product Details | Admin Dashboard |
|---|---|
| ![Product Details](docs/screenshots/perfumes.png) | ![Admin Dashboard](docs/screenshots/admin-dashboard.png) |

*Replace these example image paths with your actual screenshot filenames.*

## ✨ Features

### 🛍️ Customer Experience
- Home page showcasing the Aroma brand.
- Perfume catalog and fragrance collections.
- Individual product detail pages.
- Customer registration and login.
- Shopping checkout flow.
- Order history and order details.
- Customer profile page.
- Product reviews.
- Contact page for customer enquiries.

### ⚙️ Admin Dashboard
- Administrative dashboard.
- Create, view, edit, and manage products.
- Organize products using categories.
- View and manage customer orders.
- Manage registered users.
- Review customer messages.
- Manage product reviews.

## 🧰 Technology Stack

| Technology | Purpose |
|---|---|
| PHP | Server-side programming |
| Laravel | Backend framework |
| Blade | Server-rendered templates |
| HTML5 | Page structure |
| CSS3 | Styling and layout |
| JavaScript | Client-side interactions |
| MySQL or another supported database | Data storage |
| Git and GitHub | Version control and source hosting |

*Confirm the database and installed frontend tools against your actual project configuration.*

## 🚀 Getting Started

Follow these steps to run Aroma on your local computer.

### Prerequisites

Install:
- PHP compatible with the project's Laravel version
- Composer
- A supported database
- Git
- Node.js and npm, if required by the frontend build

### 1. Clone the repository

```bash
git clone https://github.com/432008/Aroma-Project.git
cd Aroma-Project
```

### 2. Install dependencies

```bash
composer install
```

If the project includes a `package.json` file, install the frontend dependencies too:

```bash
npm install
```

### 3. Configure the environment

Create a local environment file from the example:

**Windows PowerShell**

```powershell
Copy-Item .env.example .env
```

**macOS / Linux**

```bash
cp .env.example .env
```

### 4. Generate the application key

```bash
php artisan key:generate
```

### 5. Configure the database

Open `.env` and enter your local database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aroma
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Create the `aroma` database using your database management tool. Replace the example credentials with your own.

### 6. Run migrations

```bash
php artisan migrate
```

Run seeders only if they are available and you have reviewed what data they create:

```bash
php artisan db:seed
```

### 7. Build frontend assets

If the project uses Vite or another npm build process, follow its configuration. For a typical Vite setup:

```bash
npm run build
```

### 8. Start the application

```bash
php artisan serve
```

Open the local URL shown in your terminal, typically:

http://127.0.0.1:8000

## 📁 Project Structure

```text
Aroma-Project/
├── app/                  # Application logic
├── bootstrap/            # Framework bootstrap
├── config/               # Configuration files
├── database/             # Migrations and seeders
├── public/               # Public assets
├── resources/
│   ├── js/               # JavaScript resources, if present
│   ├── css/              # CSS resources, if present
│   └── views/            # Blade templates
├── routes/               # Application routes
├── storage/              # Application storage
├── tests/                # Automated tests, if present
├── .env.example          # Environment template
├── artisan               # Laravel CLI
├── composer.json         # PHP dependency definitions
└── README.md             # Project documentation
```

## 🔐 Security

- Never commit `.env` or real credentials.
- Keep API keys and passwords private.
- Use `.env.example` to document required environment variables safely.
- Protect administrative routes with appropriate authentication and authorization.

## 🛣️ Future Improvements

Possible enhancements include:
- Payment gateway integration.
- Product search and filtering.
- Wishlist functionality.
- Inventory management.
- Order confirmation emails.
- Production deployment and automated testing.

## 👨‍💻 Author

**Janki Lodhari**

GitHub: [@432008](https://github.com/432008)

## 🔗 Repository

[github.com/432008/Aroma-Project](https://github.com/432008/Aroma-Project)

---

<p align="center">
  Made with ❤️ using Laravel
</p>
