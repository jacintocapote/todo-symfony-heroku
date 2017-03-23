TO-DO APP example (Implemented with symfony 2.8)
========================


What's inside?
--------------

This a very basic APP TO-DO. Is to show as create a basic application with symfony 2.8 and integration with mysql.


How use on local?
----------------

The steps to use on local is:
  * Clone repository.
  * Execute composer install.
  * Alter file /app/config/paramaters.yml with your database connection.
  * Execute `php app/console doctrine:database:create`
  * Execute `php app/console doctrine:schema:update --force`
  * Execute `php bin/console server:run` and you can see the app.

How deploy to heroku?
---------------------

To use this example into heroku you need to do:
  * Clone repo yo your local.
  * `heroku login`
  * `heroku create`
  * `git push heroku master`
  * `heroku addons:add cleardb:ignite` to allow mysql database into heroku.
  * `heroku config:set SECRET=your_token` use a token id for heroku.
  * `git push heroku master` you probably get some errors because you need to create database.
  * `heroku run php app/console doctrine:database:create`
  * `heroku run php app/console doctrine:schema:update --force`
  * `heroku open` and you have your app into heroku.


You can check a example https://jacinto-todo.herokuapp.com/

Enjoy!

[1]: https://symfony.com/doc/2.8/setup.html
[2]: https://symfony.com/doc/2.8/doctrine.html
[3]: https://symfony.com/doc/2.8/security.html
[4]: https://symfony.com/doc/2.8/email.html
[5]: https://symfony.com/doc/2.8/logging.html
[6]: https://symfony.com/doc/2.8/assetic/asset_management.html
[7]: https://devcenter.heroku.com/articles/getting-started-with-symfony
[8]: http://getbootstrap.com
[9]: https://coderwall.com/p/qpitzq/deploing-symfony-project-using-mysql-to-heroku
