# Product Management System

This is a Laravel application.

## How to Start This Application

1. Build the Docker containers:
```
make build
```

2. Start all services (including Laravel) in detached mode:
```
make up-d
```

3. Install Laravel dependencies inside the app container:
```
make php
composer install
```

4. Copy the example environment file and generate the application key:
```
cp .env.example .env
php artisan key:generate
```

5. Run database migrations:
```
php artisan migrate
```

6. Access the application at [http://localhost](http://localhost).

7. Seed products
```
php artisan db:seed
```
For more commands, run:
```
make help
```


# API Documentation `v1`

## Base URL

```
/api/v1/
```

---

## Authentication

Uses Laravel Sanctum. Access to protected routes requires authentication via Bearer token:

```
Authorization: Bearer {token}
```

---

## Register

**POST** `/register`

Create a new user.

### Parameters:

| Field     | Type     | Required | Description              |
|-----------|----------|----------|--------------------------|
| name      | string   | ✅       | User name                |
| email     | string   | ✅       | Email address            |
| password  | string   | ✅       | Password (min 6 chars)   |
| password_confirmation | string | ✅ | Password confirmation |

### Sample Request:

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "secret123",
  "password_confirmation": "secret123"
}
```

### Response `201 Created`:

```json
{
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  },
  "token": "your-token-string"
}
```

---

## Login

**POST** `/login`

User authentication.

### Parameters:

| Field     | Type     | Required |
|-----------|----------|----------|
| email     | string   | ✅       |
| password  | string   | ✅       |

### Sample Request:

```json
{
  "email": "john@example.com",
  "password": "secret123"
}
```

### Response `200 OK`:

```json
{
  "token": "your-token-string",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}
```

---

## Logout

**POST** `/logout`  
Requires authentication

### Response `204 No Content`:

```json
{
  "message": "Logged out successfully"
}
```

---

## Products

### List Products

**GET** `/products`  
Requires authentication

#### Query Parameters:

| Parameter  | Type     | Description                   |
|------------|----------|-------------------------------|
| category   | string   | Filter by category            |
| in_stock   | boolean  | Filter by stock status        |
| page       | int      | Page number (default: 1)      |

### Response `200 OK`:

```json
{
  "data": [
    {
      "id": 1,
      "name": "Product A",
      "price": 100,
      "category": "electronics",
      "in_stock": true
    }
  ],
  "links": {
    "first": "...",
    "last": "...",
    "prev": null,
    "next": "..."
  },
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 10,
    "total": 45
  },
  "total_in_stock_value": 1234
}
```

---

### Create Product

**POST** `/products`  
Requires authentication

Fields: `name`, `price`, `category`, `in_stock`

### Response `201 Created`

---

### Get Product

**GET** `/products/{id}`  
Requires authentication

### Response `200 OK`

---

### Update Product

**PUT/PATCH** `/products/{id}`  
Requires authentication

### Response `200 OK`

---

### Delete Product

**DELETE** `/products/{id}`  
Requires authentication

### Response `204 No Content`
