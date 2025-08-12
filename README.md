# Laravel CRUD Blog Application 📝

A simple Laravel application with user authentication and full CRUD functionality for managing posts.

## 🚀 Features

- 🔐 User Registration & Login
- ✅ Authentication using Laravel UI
- 🧠 Create, Read, Update, Delete (CRUD) operations on posts
- 📦 MySQL database integration
- 👤 Each user can:
  - Create a new post
  - Edit and delete **only their own** posts
  - View their own posts
  - View posts by **all users** on a feed page
  - Upload and view pdf
  - Change Profile Picture

## 🛠️ Tech Stack

- **Backend:** Laravel 8
- **Frontend:** Blade + Bootstrap
- **Database:** MySQL
- **Authentication:** Laravel Auth Scaffolding

## 📂 Project Structure (Major Files)

```
/app
/resources/views
/routes/web.php
/database/migrations
```

## ⚙️ Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel-crud-app.git
cd laravel-crud-app
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment File

```bash
cp .env.example .env
php artisan key:generate
```

Update the `.env` file with your MySQL credentials:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Serve the Application

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

---

## 🙋‍♂️ Author

**Aditya Mohan Gupta**

- Email: developer.aditya24@gmail.com  
- LinkedIn: [linkedin.com/in/aditya-mohan-gupta-a116b6256](https://linkedin.com/in/aditya-mohan-gupta-a116b6256)

---

## 📄 License

This project is open-source and available to everyone
