### Requirements
- **PHP >= 8.2**
- **Composer** 
- **MySQL** 
- **Git** 

### Installation

_Follow these steps to install and run the Laravel project:_

1. Clone the repository
    ```sh
    git clone https://github.com/widiart/oms-discovery.git
    cd oms-discovery
    ```
2. Install PHP dependencies using Composer
    ```sh
    composer install
    ```
3. Copy the example environment file and configure your environment variables
    ```sh
    cp .env.example .env
    ```
4. Generate the application key
    ```sh
    php artisan key:generate
    ```
5. Set up your database credentials in the `.env` file.

6. Run database migrations and seeders
    ```sh
    php artisan migrate:fresh --seed
    ```
7. Serve the application
    ```sh
    php artisan serve
    ```
8. Access the app at [http://localhost:8000](http://localhost:8000)
