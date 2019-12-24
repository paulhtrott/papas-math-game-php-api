[![Build Status](https://travis-ci.org/paulhtrott/papas-math-game-php-api.svg?branch=master)](https://travis-ci.org/paulhtrott/papas-math-game-php-api)

# PHP Application for Papas Math Game Api.

### Run local server

```sh
php -S localhost:8080
```

### Tests
#### Install Composer
```sh
brew install composer
```
#### Install Dependencies
```sh
composer i
```

#### Update Composer Autoloader to autoload Classes
```sh
composer dump-autoload -o
```

#### Run Tests
```sh
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```
