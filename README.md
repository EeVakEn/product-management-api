# Product Management System

This is a Laravel application.

## How to Start This Application

1. Build the Docker containers:
   ```
   make build
   ```

2. Start all services (including Laravel) in detached mode:
   ```
   make up
   ```

3. Install Laravel dependencies inside the app container:
   ```
   make shell-app
   composer install
   ```

4. Copy the example environment file and generate the application key:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

5. Run database migrations (optional, if needed):
   ```
   php artisan migrate
   ```

6. Access the application at [http://localhost](http://localhost).

For more commands, run:
```
make help
```
