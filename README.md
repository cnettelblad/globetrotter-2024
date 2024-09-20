# Globetrotter 2024

A web app that helps keeping track of- and registering submissions for Globetrotter 2024.

## Prerequisites

-   PHP >= 8.2
-   [Composer](https://getcomposer.org)
-   [Docker](https://docker.com)
-   [Discord Bot Token](https://discord.com/developers/applications) (recommended)

## Installation

1. **Clone the repository:**

    ```sh
    git clone git@github.com:cnettelblad/globetrotter-2024.git
    ```

2. **Install composer dependencies:**

    ```sh
    composer install
    ```

3. **Setup environment variables:**

    ```sh
    cp .env.example .env
    ```

    Update the `.env` file with your configuration settings.

4. **Start Laravel Sail:**

    ```sh
    ./vendor/bin/sail up -d
    ```

    **Tip:** Set up a sail alias:

    ```sh
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
    ```

5. **Run migrations & Seeders:**

    ```sh
    sail artisan migrate --seed
    ```

6. **Generate an application key:**

    ```sh
    sail artisan key:generate
    ```

7. **Install Node dependencies:**

    ```sh
    sail npm install
    ```

8. **Build assets:**
    ```sh
    sail npm run build
    ```

## Development

HMR is available through [Vite](https://laravel.com/docs/11.x/vite)

```sh
sail npm run dev
```
