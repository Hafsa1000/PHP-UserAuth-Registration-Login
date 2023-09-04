# PHP-UserAuth-Registration-Login

A PHP-based web application for secure user registration and login. Featuring responsive HTML/CSS interfaces, it safeguards user data and offers role management for admins. UserAuth enhances web app security and provides a seamless experience for both users and administrators.

## Features

- User registration form with validation
- Password hashing using PHP's password_hash() 
- User login form 
- Verifying login credentials against database
- Maintaining user session 
- Admin dashboard to manage users
- Ability to change user roles (user, engineer) offering role management for admins
- Logout functionality

## Technologies Used

- PHP 
- HTML
- CSS
- MySQL

## Requirements

- XAMPP (or any other PHP server)
- MySQL database

## Installation

1. Clone the repository
```
git clone https://github.com/Hafsa1000/PHP-UserAuth-Registration-Login.git
```

2. Create a MySQL database named `form`

3. Import the `form.sql` file located inside the repository. This will create the users table.

4. Update the database credentials in the PHP files:
- `config.php` 
- `login.php`  
- `signup.php`
- `admin.php`
- `update_user.php`
- `logout.php`

5. You can now access the registration form at `localhost/project-folder/signup.html`
6. Login form is at `localhost/project-folder/index.html`
7. Admin dashboard is at `localhost/project-folder/admin.php`


