<p align="center">
School Software
</p>

## Framework used

- Laravel v8.22.1
- Bootstrap v4.5

## Server Requirements

- PHP >= ^7.3|^8.0,
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation
Here are some basic steps to start using this application

- Copy the contents of the `.env.example` file to create `.env` in the same directory

- Run `composer install` for `developer` environment and run `composer install --optimize-autoloader --no-dev` for `production` environment to install Laravel packages (Remove **Laravel Debugbar**, **Laravel Log viewer** packages from **composer.json** and

from `config/app.php` before running **`composer install`** in **Production Environment**)

- Generate `APP_KEY` using `php artisan key:generate`

- Edit the database connection configuration in .env file e.g.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hiring_talent
DB_USERNAME=root
DB_PASSWORD=
```

> Note that this is just an example, and the values may vary depending on your database environment.

- Set the `APP_ENV` variable in your `.env` file according to your application environment (e.g. local, production) in `.env` file

- Migrate your Database with `php artisan migrate`

- Seed your Database with `php artisan db:seed`

- On localhost, serve your application with `php artisan serve`
--------------------------------------------------------------------
## Multiple Developer on same git repo. working procedure.
##### Step-1: Fork the project from `devxhubcom/hiring-talent.git`
- On GitHub, navigate to the `devxhubcom/hiring-talent.git` repository.
- In the top-right corner of the page, click Fork.
##### Step-2: Clone the project from `[your_git_username]/hiring-talent.git`
- On GitHub, navigate to the `[your_git_username]/hiring-talent.git` repository.
- Clone the repository in your local machine.
##### Step-3: Configure Git to sync your fork with the original `devxhubcom/hiring-talent.git` repository
- Open terminal then browse the project throw terminal
- Type `git remote add upstream`, and then type the project URL and press <b>Enter</b>. It will look like this: <br>
```
SSH: $ git remote add upstream git@github.com:devxhubcom/hiring-talent.git
HTTPS: $ git remote add upstream https://github.com/devxhubcom/hiring-talent.git
```
- Then run `git pull upstream master`
##### Step-4: After make any changes in your project file
- Run the command below one by one
```
$ git add .
$ git commit -m "- your commit"
$ git pull upstream master
$ git push origin master
```
##### Step-5: Pull Request (PR)
- After push your work file in `your_git_username/hiring-talent.gitg` master branch please don't forget to To create a pull request that is ready for review, <b>Create Pull Request</b>.

#### Always remember, before coding please run `git pull upstream master` and again before push `git pull upstream master`

