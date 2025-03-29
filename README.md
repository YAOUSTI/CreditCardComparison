# 🚀 Credit Card Comparison App

A Laravel-based application for comparing credit cards. It fetches data from an external XML API, stores it in a relational database, and provides a user-friendly interface for comparison. Admin users can manage and edit card information seamlessly.

---

## ✨ Features

- **API Integration**: Import credit card data from an external XML API.
- **Comparison Tool**: Highlight and compare features of different credit cards.
- **Dynamic Sorting**: Sort cards by price or alphabetically.
- **Admin Panel**: Manage and edit card information manually.
- **Seeders**: Preload additional card details and features.

---

## 🛠️ Tech Stack

- **Framework**: Laravel (PHP)
- **Database**: MySQL
- **Frontend**: Bootstrap 5
- **ORM**: Laravel Eloquent

---

## 📦 Installation

### 1. Clone the Repository
```bash
git clone your_repository_link_here
cd your_project_folder
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate --seed
```

### 6. Import Data from XML API
```bash
php artisan creditcards:import
```

### 7. Serve the Application
```bash
php artisan serve
```
Access the application:
- **Frontend**: [http://localhost:8000](http://localhost:8000)
- **Admin Panel**: [http://localhost:8000/admin/cards](http://localhost:8000/admin/cards)

---

## 🚩 Usage

### Frontend
- Compare credit cards.
- Sort results by price or alphabetically.
- View detailed card features.

### Admin Panel
- Edit and manage card data.
- Remove manual edits if needed.

---

## 🎯 Commands

| Command                          | Description                          |
|----------------------------------|--------------------------------------|
| `php artisan creditcards:import` | Import or update cards from XML API. |
| `php artisan migrate --seed`     | Setup database with migrations and seeders. |

---

## ✅ Testing

Run automated tests:
```bash
php artisan test