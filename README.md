# 💍 Jewellery Product Management System

A web-based product management system for jewellery businesses, built using **CodeIgniter 4**, featuring CRUD operations, secure authentication, image resizing, and responsive DataTables integration.

## 🚀 Features

- 🧑‍💼 Admin login system with session-based authentication
- 📦 Product CRUD (Create, Read, Update, Delete)
- 🖼 Image upload with resizing to 500x500 pixels
- 📊 DataTables with server-side pagination, search, sorting
- 🎨 Bootstrap 5 responsive UI with sidebar & navbar
- 📁 Image storage in `public/uploads/`
- 🔐 Secure route protection (only logged-in users can manage products)

---

## 🧑‍💻 Tech Stack

- **Backend**: PHP 8.1, CodeIgniter 4
- **Frontend**: HTML5, CSS3, Bootstrap 5, jQuery
- **Database**: MySQL
- **Image Library**: CodeIgniter Image Manipulation
- **Plugins**: DataTables with ColVis extension

---

## 📁 Project Structure

```text
jewellery_product_management/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   └── Config/
├── public/
│   ├── assets/            # CSS, JS
│   └── uploads/           # Product images
├── writable/
│   └── logs/
├── .env
├── .gitignore
├── composer.json
└── README.md
## 📁 Installation & Setup

# Clone the repository
git clone https://github.com/Logesh2802/Jewellery_products_management.git
cd Jewellery_products_management

# Install PHP dependencies
composer install

# Copy environment file and configure
cp env .env

# (Edit .env to setup your database credentials)
# Example .env database config:
# database.default.hostname = localhost
# database.default.database = jewellery_db
# database.default.username = root
# database.default.password =
# database.default.DBDriver = MySQLi

# Run database migrations
php spark migrate
php spark db:seed AdminSeeder

# Start development server
php spark serve

# Visit http://localhost:8080 in your browser
# Type http://localhost:8080/index.php/login
Username:admin@example.com
Password:admin123
