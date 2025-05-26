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

## Screenshots

### Login Page
![Login Page](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20065034.png)

### Admin Dashboard
![Admin Dashboard](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20070022.png)

### Column Visibility
![Column Visibility](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20070047.png)

### Add Product
![Add Product](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20065411.png)

### Edit Product
![Edit Product](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20070115.png)

### Delete Product
![Delete Product](https://raw.githubusercontent.com/Logesh2802/Jewellery_products_management/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20070330.png)


### Delete Product
![Delete Product](https://github.com/Logesh2802/Jewellery_products_management/blob/54ca771e62adfe378793f68edcb93816c2ab4f64/Screenshot%202025-05-26%20070330.png?raw=true)


