# Notes

## Laravel

### Key security

```bash
  php artisan key:generate
```

### Cache

```bash
  # Clear Application Cache
  # Run the following command to clear application cache of the Laravel application.
  php artisan cache:clear

  # Clear route cache
  # To clear route cache of your Laravel application execute the following command from the shell.
  php artisan route:cache

  # Clear config cache
  # You can use config:cache to clear the config cache of the Laravel application.
  php artisan config:cache

  # Clear compiled view files
  # Also, you may need to clear compiled view files of your Laravel application. To clear compiled view files run the following command from the terminal.
  php artisan view:clear


  # Alternative
  php artisan cache:clear && php artisan route:cache && php artisan config:cache && php artisan view:clear
```

### Files

```bash
  php artisan storage:link
```

### Composer

```json
  "fix": "php-cs-fixer fix ./app/",
  "clearCache": "rm -rf cache && rm -f ./.php_cs.cache && php artisan cache:clear && php artisan route:cache && php artisan config:cache && php artisan view:clear",
  "lint": "find . -name \"*.php\" -exec php -l {} ; ",
  "serve": "php -S localhost:8080 -t ./public ",
  "start": [
    "@clearCache",
    "@composer update",
    "@composer dumpautoload",
    "@composer install",
    "@lint",
    "@fix",
    "@serve"
  ]
```

## Mailing

[Mailing]([https://link](https://tedgoas.github.io/Cerberus/))
