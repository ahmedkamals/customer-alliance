Prerequisites
==============
* **php7.1 + (dom, mbstring) extensions**
* **MySQL**
* [**Composer**][1]

Installation
--------------

Please follow below steps for installation:

  * **Dependencies installation**

        composer install

  * **Launching the server**

        php bin/console server:run


### Deployment

  * Configure `app\cofig\parameters.yml` with a database configurations.
  * Run the following command:

        bin/console doctrine:datase:create

### Tests

    bin/phpunit --debug -c .

Enjoy!

[1]:  https://getcomposer.org/download/

