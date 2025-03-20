<h1 align="center" id="title">LARAVEL-EMS</h1>

<p align="center"><img src="https://socialify.git.ci/Dale-Guantia/LARAVEL-EMS/image?font=Source+Code+Pro&amp;forks=1&amp;language=1&amp;name=1&amp;owner=1&amp;pattern=Plus&amp;pulls=1&amp;stargazers=1&amp;theme=Auto" alt="project-image"></p>

<p id="description">Employee Management System with multiple user roles (**Admin, Employee, and Guest**) using middleware and Laravel Breeze for authentication login and registration.</p>

  
  
<h2>🧐 Features</h2>

Here're some of the project's best features:

*   Register and Login Users
*   CRUD operations
*   Multiple User Roles (Admin Employee and Guest)
*   User approval for new registered account
*   Send an email notification to the admin and employee accounts upon user approval
*   Restrict access to specific routes by using middleware.

<h2>🛠️ Installation Steps:</h2>

<p>1. In your terminal navigate to the directory where you want to clone the project then run:</p>

```
git clone https://github.com/Dale-Guantia/LARAVEL-EMS.git
```

<p>2. After cloning run this to navigate into the project folder:</p>

```
composer install
```

<p>3. Run this to install Node.js frontend dependencies:</p>

```
npm install
```

<p>4. Copy the .env.example file to create a new .env file:</p>

```
cp .env.example .env
```

<p>5. Then generate the application key:</p>

```
php artisan key:generate
```

<p>6. Open the .env file and update the database settings:</p>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

<p>7. Run the migrations (Note: the "--seed" in the command below will automatically add "Admin User" credentials to your database; It is necessary to make your first login to the application):</p>

```
php artisan migrate --seed
```

<p>8. Start the Laravel server:</p>

```
php artisan serve
```

<p>9. By default your app will be available at:</p>

```
http://127.0.0.1:8000
```

<p>10. User this credentials to login "Admin User":</p>

```
E-mail: admin@example.com    Password: 12341234
```

<p>11. To enable email notifications for user approvals you must configure the ".env" file and update the "MAILER" settings like the example below; You can watch this simple video tutorial on how to get email_password and to configure using Gmail SMTP:</p>

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=email_password_from_gmail
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your@email"
MAIL_FROM_NAME="Employee Management System"
```

```
https://www.youtube.com/watch?v=JesSP3pRB_I
```

  
  
<h2>💻 Built with</h2>

Technologies used in the project:

*   PHP
*   Laravel
*   Laravel Breeze
*   Bootstrap
*   Tailwind
*   JavaScript
