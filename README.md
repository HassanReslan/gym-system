# 🏋️‍♂️ Gym Management System

A web-based system for managing gym members, subscriptions, attendance, and reports.  
Built with **Laravel** and **MySQL**.

---

## ✅ Project Status
🚧 Work in progress  
📅 Started: April 15, 2025

---

## 📌 Features (Planned)

- [x] Laravel project setup
- [x] GitHub repo integration
- [x] Database migrations for users and members
- [ ] Member CRUD
- [ ] Subscription tracking
- [ ] Attendance records
- [ ] Admin dashboard
- [ ] Reports

---

## 🛠️ Technologies Used

- PHP 8.x
- Laravel 10
- MySQL
- Laravel Breeze (for authentication)
- GitHub (version control)

---

## 🧰 Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/HassanReslan/gym-system.git
   cd gym-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configure database**

   - Create a new MySQL database (e.g., `gym_system`)
   - Update `.env` file:
     ```env
     DB_DATABASE=gym
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Serve the app**
   ```bash
   php artisan serve
   ```

---

## 🗃️ Database Schema (So far)

### `users`
- Provided by Laravel Breeze
- Used for admins or staff

### `members`
```php
Schema::create('members', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->date('date_of_birth')->nullable();
    $table->timestamps();
});
```

---

## 📂 Folder Structure (Early phase)
```
gym-system/
├── app/
├── database/
│   └── migrations/
├── public/
├── resources/
├── routes/
│   └── web.php
├── .env
├── composer.json
└── README.md
```

---

## 📋 License
This project is open source and under development by [Hassan Reslan](https://github.com/HassanReslan)