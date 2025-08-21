رائع، الآن بعد أن أرسلت لي **routes/api.php** بالكامل، يمكننا تحديث **ملف README** ليكون **دقيقًا واحترافيًا باللغة الإنجليزية**، يعكس جميع الـ endpoints الفعلية للمشروع.

إليك النسخة المقترحة:

---

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/Alsrory/charity-api/actions"><img src="https://github.com/Alsrory/charity-api/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Charity API

**Charity API** is a Laravel-based RESTful API designed for managing charity projects, initiatives, subscribers, subscriptions, news, roles, and comments. It supports user authentication, admin roles, and contributions tracking.

---

## Features

* **User Authentication:** Register and login using Laravel Sanctum
* **Roles & Permissions:** Admin/User access control
* **CRUD Operations:** Users, Projects, Initiatives, Subscribers, Subscriptions, Roles, News, Comments
* **Comments System:** Attach comments to projects, initiatives, or other entities
* **User Contributions:** Retrieve all donations/contributions by a user
* **Subscriber Subscriptions:** Retrieve all subscriptions of a subscriber
* **Language Middleware:** Multi-language support

---

## Technologies Used

* **Back-End:** Laravel 12, PHP 8.2
* **Database:** MySQL
* **Authentication:** Laravel Sanctum
* **Media Management:** Spatie Laravel MediaLibrary
* **Testing:** PHPUnit, Faker
* **Dev Tools:** Laravel Sail, Laravel Pint, Laravel Pail

---

## Installation

```bash
git clone https://github.com/Alsrory/charity-api.git
cd charity-api
composer install
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charity_db
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

Start the server:

```bash
php artisan serve
```

The API will be accessible at `http://localhost:8000`.

---

## API Endpoints

### Authentication

| Method | Endpoint      | Description         |
| ------ | ------------- | ------------------- |
| POST   | /api/register | Register a new user |
| POST   | /api/login    | Login a user        |

### Users

| Method | Endpoint                        | Description                   |
| ------ | ------------------------------- | ----------------------------- |
| GET    | /api/users                      | List all users                |
| POST   | /api/users                      | Create a new user             |
| GET    | /api/users/{id}                 | Get a single user             |
| PUT    | /api/users/{id}                 | Update a user                 |
| DELETE | /api/users/{id}                 | Delete a user                 |
| GET    | /api/users/{user}/contributions | Get all contributions by user |

### Projects

| Method | Endpoint           | Description         |
| ------ | ------------------ | ------------------- |
| GET    | /api/projects      | List all projects   |
| POST   | /api/projects      | Create a project    |
| GET    | /api/projects/{id} | Get project details |
| PUT    | /api/projects/{id} | Update project      |
| DELETE | /api/projects/{id} | Delete project      |

### Initiatives / Subscribers / Subscriptions / Roles / News / Comments

* Full RESTful routes with index, show, store, update, destroy via `apiResource`.

### Comments

| Method | Endpoint                  | Description                        |
| ------ | ------------------------- | ---------------------------------- |
| POST   | /api/{type}/{id}/comments | Add comment to a specific entity   |
| GET    | /api/{type}/{id}/comments | List comments of a specific entity |

### Custom Routes

| Method | Endpoint                                   | Description                           |
| ------ | ------------------------------------------ | ------------------------------------- |
| GET    | /api/subscription                          | Get all subscriptions                 |
| GET    | /api/subscriber/{subscriber}/subscriptions | Get all subscriptions of a subscriber |

---

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature-name`)
3. Commit your changes (`git commit -m 'Add feature'`)
4. Push to the branch (`git push origin feature-name`)
5. Open a Pull Request

---

## License

This project is licensed under the [MIT License](LICENSE).
