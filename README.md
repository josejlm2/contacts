# Contacts Demo

This is an iterative demo application prepared for php[tek] 2018. It's divided into multiple _modules_, each of which is intended to be a standalone lesson in PHP security.

Each module subdirectory contains:

- `app.php`    A basic http router to power a built-in PHP server
- `util.php`   Various utility functions provided to make life easier during the lesson at hand
- `lesson.php` The actual code for that given lesson - most with placeholders

## Installation

Composer dependencies are bundled in the repository to make it easier to clone and get started with this project. If for any reason you want to _update_ your dependencies, merely do so with `composer update`.

The first step is to install Composer dependencies in the project root:

The modules themselves are self-contained and share their dependencies.

## Running

Each module is a self-contained application and is meant to be worked on one at a time. Merely `cd` into the target directory, then run the following to start the PHP webserver:

```sh
php -S localhost:8888 app.php
```

The application itself can now be [viewed in a web browser](http://localhost:8888).

**Note:** You can only run one application at a time as they share the same port.

## Understanding the Lessons

Each lesson is built to cover a specific topic regarding PHP security. As such, there are several placeholder `@TODO`s throughout the code that are meant for you to complete. Each is documented explaining what's expected from you to complete the task.

The lessons are structured into the following modules:

**1. Authentication**

- Password management (`/module-1.1`)
- Password hashing (`/module-1.2`)
- Account reset tokens (`/module-1.3`)

**2. Credential Management**

- Amazon KMS (`/module-2.1`)
- `.env` files (`/module-2.2`)

**3. Encryption**

- File encryption (`/module-3.1`)
- Database encryption (`/module-3.2`)

**4. Session Management**

- Server-side data management (`/module-4.1`)

**5. Long-term Trust**

- Authenticated encryption and decryption (`/module-5.1`)
- Document signing (`/module-5.2`)