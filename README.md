# To Do List

- [To Do List](#to-do-list)
  - [Preparing the project](#preparing-the-project)
    - [Install required packages](#install-required-packages)
    - [Database Preparation](#database-preparation)
  - [Available Requests](#available-requests)
    - [User Requests](#user-requests)
    - [Todo Requests](#todo-requests)

---

---

![](https://img.shields.io/badge/Made%20with-PHP-1f425f.svg)

## Preparing the project

### Install required packages

```bash
composer install tymon/jwt-auth
```

### Database Preparation

- Create a new database and set the value of the `DB_DATABASE` in the `.env` file to the new database name.

- Migrate the database using
    ```bash
    php artisan migrate
    ```

- Seed some data for testing via
    ```bash
    php artisan db:seed
    ```
    This will seed three users each with a single todo.

---

---

## Available Requests

### User Requests

|           Operation | HTTP Method |       URI        | Allowed for        |
| ------------------: | ----------: | :--------------: | :----------------- |
| Register a new user |        POST | api/users/signup | Anyone             |
|   Authenticate user |        POST | api/users/login  | Anyone             |
|    Get user profile |         GET |   api/users/me   | Authenticated User |

### Todo Requests

|            Operation | HTTP Method |               URI               | Allowed for        |
| -------------------: | ----------: | :-----------------------------: | :----------------- |
|   Retrieve all todos |         GET |            api/todos            | Authenticated User |
|    Create a new todo |        POST |            api/todos            | Authenticated User |
|          Update todo |         PUT |       api/todos/{todoId}        | Authenticated User |
|          Delete todo |      DELETE |       api/todos/{todoId}        | Authenticated User |
|    Mark todo as done |        POST | api/todos/{todoId}/mark-as-done | Authenticated User |
| mark todo as pending |        POST |    api/todos/{todoId}/reopen    | Authenticated User |

---

---

[Top](#to-do-list)
