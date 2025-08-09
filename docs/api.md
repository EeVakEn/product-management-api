
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

---

# Products API Documentation

## Overview
This API allows managing products in the system. It provides CRUD operations and filtering with pagination.

Base URL:
```
/api/v1/products
```

Authentication:
- All endpoints require authentication using Laravel Sanctum tokens.

---

## List Products

**Endpoint:**
```
GET /api/v1/products
```

**Description:**
Returns a paginated list of products with optional filtering by category (slug) and in_stock status.

**Query Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| category  | string (slug) | No | Filter by category slug |
| in_stock  | boolean | No | Filter by stock availability (true or false) |
| page      | integer | No | Page number for pagination |

**Response Example:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Sample Product",
            "price": 99.99,
            "category": "electronics",
            "in_stock": true
        }
    ],
    "links": {
        "first": "http://localhost/api/v1/products?page=1",
        "last": "http://localhost/api/v1/products?page=10",
        "prev": null,
        "next": "http://localhost/api/v1/products?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 10,
        "path": "http://localhost/api/v1/products",
        "per_page": 10,
        "to": 10,
        "total": 100
    },
    "total_in_stock_value": 57
}
```

---

## Create Product

**Endpoint:**
```
POST /api/v1/products
```

**Request Body:**
```json
{
    "data": {
        "id": 101,
        "name": "TV",
        "price": "2222.22",
        "category": "electronics",
        "in_stock": "1"
    }
}
```

**Validation Rules:**
- name: required, string, max 255 chars
- price: required, numeric, min 0
- category: required, string (slug), max 255 chars
- in_stock: required, boolean

**Response Example:**
```json
{
    "data": {
        "id": 2,
        "name": "New Product",
        "price": 59.99,
        "category": "books",
        "in_stock": true
    }
}
```

**Status Codes:**
- 201 Created: Product successfully created
- 422 Unprocessable Entity: Validation error

---

## Get Product by ID

**Endpoint:**
```
GET /api/v1/products/{id}
```

**Response Example:**
```json
{
    "data": {
        "id": 1,
        "name": "Sample Product",
        "price": 99.99,
        "category": "electronics",
        "in_stock": true
    }
}
```

**Status Codes:**
- 200 OK
- 404 Not Found: Not Found

---

## Update Product

**Endpoint:**
```
PUT /api/v1/products/{id}
PATCH /api/v1/products/{id}
```

**Request Body Example:**
```json
{
    "data": {
        "id": 2,
        "name": "Sample Product",
        "price": 451.92,
        "category": "electronics",
        "in_stock": 1
    }
}
```

**Validation Rules:**
- name: sometimes, string, max 255 chars
- price: sometimes, numeric, min 0
- category: sometimes, string (slug), max 255 chars
- in_stock: sometimes, boolean

**Response Example:**
```json
{
    "data": {
        "id": 1,
        "name": "Sample Product",
        "price": 79.99,
        "category": "electronics",
        "in_stock": false
    }
}
```

**Status Codes:**
- 200 OK: Product successfully updated
- 404 Not Found: Not Found
- 422 Unprocessable Entity: Validation error

---

## Delete Product

**Endpoint:**
```
DELETE /api/v1/products/{id}
```

**Response:**
No content

**Status Codes:**
- 204 No Content
- 404 Not Found: Not Found
