# Task Management REST API

A clean and scalable Task Management REST API built with Laravel using:

The API provides:
- User Authentication using Laravel Sanctum
- Task CRUD Operations
- Filtering and Pagination
- Repository Pattern Architecture
- Form Request Validation
- API Resources
- Rate Limiting
- Proper Exception Handling
- Secure API Development Practices

--------------------------------------------------

# Tech Stack
----------
- Laravel 13
- PHP 8.2+
- Laravel Sanctum
- MySQL / PostgreSQL
- REST API Architecture

--------------------------------------------------


# Features

## Authentication
- Register
- Login
- Logout
- Sanctum Token Authentication

## Task Management
- Create Task
- List Tasks
- Filter Tasks by Status
- Pagination
- Update Task
- Delete Task

---

# Architecture

This project follows clean architecture principles:


Controller
   ↓
Service Layer
   ↓
Repository Interface
   ↓
Repository Implementation
   ↓
Eloquent ORM
   ↓
Database


---

# Project Structure


app/
├── Http/
│   ├── Controllers/Api
│   ├── Requests
│   └── Resources
│
├── Models
│
├── Repositories/
│   ├── Interfaces
│   
│
├── Services
│
└── Providers


---

# Setup Instructions

## 1. Clone Repository

```bash
git clone https://github.com/your-username/task-manager-api.git
```


```

---

## 2. Install Dependencies

```bash
composer install
```

---

## 3. Create Environment File

```bash
cp .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Configure Database

Update `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_api
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Run Migrations

```bash
php artisan migrate
```

---

## 7. Install Sanctum

```bash
composer require laravel/sanctum
```

Publish Sanctum files:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

Run migrations again:

```bash
php artisan migrate
```

---

## 8. Start Development Server

```bash
php artisan serve
```

API URL:

```text
http://127.0.0.1:8000
```

---

# Authentication

This API uses Laravel Sanctum Token Authentication.

After login/register, use the returned token:

```http
Authorization: Bearer YOUR_TOKEN
```

---

# API Endpoints

---

## Authentication APIs

### Register

```http
POST /api/register
```

### Request Body

```json
{
  "name": "Amit",
  "email": "amit@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

---

### Login

```http
POST /api/login
```

### Request Body

```json
{
  "email": "amit@example.com",
  "password": "password"
}
```

---

### Logout

```http
POST /api/logout
```

Headers:

```http
Authorization: Bearer TOKEN
```

---

# Task APIs

Headers:

```http
Authorization: Bearer TOKEN

---

## Create Task

```http
POST /api/tasks
```

### Request Body

```json
{
  "title": "Finish Assignment",
  "description": "Complete Laravel task API",
  "status": "Pending",
  "priority": "High",
  "due_date": "2026-05-20"
}
```

---

## List Tasks

```http
GET /api/tasks
```

---

## Filter Tasks by Status

```http
GET /api/tasks?status=Completed
```

---

## Pagination

```http
GET /api/tasks?page=1
```

Default pagination size: `10`

---

## Get Single Task

```http
GET /api/tasks/{id}
```

---

## Update Task

```http
PUT /api/tasks/{id}
```

---

## Delete Task

```http
DELETE /api/tasks/{id}
```

---

# Database Schema Explanation

---

## users Table

Laravel default users table.

| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| name | string | User name |
| email | string | Unique email |
| password | string | Hashed password |
| created_at | timestamp | Created timestamp |
| updated_at | timestamp | Updated timestamp |

---

## tasks Table

Stores all user tasks.

| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint | Foreign key to users table |
| title | string | Task title |
| description | text | Task description |
| status | enum | Pending / In Progress / Completed |
| priority | enum | Low / Medium / High |
| due_date | date | Task deadline |
| created_at | timestamp | Created timestamp |
| updated_at | timestamp | Updated timestamp |

---

# Database Relationships

## One-to-Many Relationship

A user can have many tasks.

```text
User → HasMany → Tasks
Task → BelongsTo → User
```

---

--------------------------------------------------

DATABASE DESIGN DECISIONS
-------------------------
1. Foreign Key Constraint
   - tasks.user_id references users.id
   - Cascade delete enabled

2. Soft Deletes
   - Tasks use soft deletes for safer data recovery

3. Indexing
   - Index added on status
   - Index added on priority

4. Normalization
   - Tasks stored separately from users
   - Maintains scalable relational structure


# Validation Rules

## Task Validation

| Field | Validation |
|---|---|
| title | required |
| status | enum validation |
| priority | enum validation |
| due_date | valid date |

---

# HTTP Status Codes

| Status Code | Meaning |
|---|---|
| 200 | Success |
| 201 | Resource Created |
| 401 | Unauthorized |
| 403 | Forbidden |
| 422 | Validation Error |

---

# Security

- Passwords are hashed
- Sanctum token authentication
- Protected routes
- User-specific task authorization

---

# Best Practices Implemented

- Repository Pattern
- Service Layer
- Form Request Validation
- API Resources
- Dependency Injection
- Clean Controllers
- RESTful API Design
- Pagination
- Filtering
- Eloquent Relationships


