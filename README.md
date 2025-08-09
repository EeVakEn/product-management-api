# Product Management System

This is a Laravel application.

## How to Start This Application

1. Copy the example environment file and Build the Docker containers:
```
cp .env.example .env
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

4. Generate the application key:
```
php artisan key:generate
```

5. Run database migrations:
```
php artisan migrate
```

6. Seed products (Optional)
```
php artisan db:seed
```
For more commands, run:
```
make help
```

[Go to API Documentation](docs/api.md)
