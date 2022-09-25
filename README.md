## Installation

Please follow these steps to install the projects:

- Clone the project.
- Navigate to the project directory.
- Run the following commands:
  - ``cp .env.example .env`` and update your database variables inside ``.env`` file.
  - ``composer install``
  - ``php artisan key:generate``.
  - ``php artisan migrate --seed``.

## Testing

Please Run the following commands to run the test cases:
- ``cp .env.example .env.testing`` and update your database variables inside .``env.testing`` file.
- ``php artisan migrate --seed --env=testing``.
- ``php artisan test``.