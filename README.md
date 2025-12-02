# Support Ticket System

A web-based support ticket management system built with Laravel that allows users to log, track, and manage support tickets across multiple departments.

## Features

### Authentication
- User authentication system with username and password
- Role-based access control for different user types
- Three pre-configured support users for different departments

### Ticket Management
- **Log Support Tickets** across three categories:
  - Sales
  - Accounts
  - IT

### Personal Information Capture
The system captures comprehensive personal details:
- First Name
- Last Name
- Email Address
- Category/Department
- Issue Description
- GPS Coordinates (Latitude & Longitude) - capturing the location where the support agent logs the ticket

### Email Notifications
- Automatic email sent to the ticket requester upon ticket creation
- Email includes ticket reference number and status
- Tracks which support agent logged the ticket
- Email contains link for anonymous ticket status viewing

### Ticket Status Management
Users can update ticket status through three states:
- **New** - Newly logged ticket
- **In Progress** - Ticket being worked on
- **Resolved** - Ticket has been resolved

### Reporting & Filtering
Comprehensive reporting features include:
- **Date Range Filtering**: View tickets between specific start and end dates
- **Sorting Options**:
  - First Name
  - Last Name
  - Date Logged (default sort order)
  - Status (New, In Progress, Resolved)
- **Pagination**: Results displayed 10 tickets per page

### Anonymous Ticket Viewing
- View ticket status without authentication using ticket number
- Accessible via link sent in email notification
- Allows customers to check their ticket progress independently

## Installation

### Prerequisites
- PHP >= 7.3
- Composer
- MySQL/MariaDB
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/kirstenN1996/support_system.git
   cd support_system
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   ```
   
   Update the `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
   This will create the database tables and automatically set up 3 support users.

6. **Set proper permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

7. **Configure email settings (optional)**
   
   For development/testing, emails are logged to `storage/logs/laravel.log`
   
   For production, update `.env` with SMTP settings:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=your-smtp-host
   MAIL_PORT=587
   MAIL_USERNAME=your-username
   MAIL_PASSWORD=your-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=noreply@yourdomain.com
   MAIL_FROM_NAME="Support System"
   ```

## Default Login Credentials

Three support users are automatically created during database seeding:

| Department | Email | Password |
|------------|-------|----------|
| Sales | sales@kirstensupport.com | password |
| Accounts | accounts@kirstensupport.com | password |
| IT | it@kirstensupport.com | password |

**Note:** Change these passwords in production!

## Usage

### Logging a Ticket
1. Log in with one of the support user accounts
2. Click "Log New Ticket"
3. Fill in the required information:
   - Select category (Sales/Accounts/IT)
   - Enter customer's first name and last name
   - Enter customer's email address
   - Describe the issue
   - GPS coordinates are automatically captured (or can be entered manually)
4. Submit the ticket

### Viewing Tickets
- Navigate to the tickets index page
- Use filters to search by date range
- Sort by first name, last name, date logged, or status
- Navigate through pages (10 tickets per page)

### Updating Ticket Status
1. Click on a ticket to view details
2. Update the status from the dropdown (New/In Progress/Resolved)
3. Save changes

### Anonymous Ticket Viewing
- Access the ticket status page using the ticket number
- No login required
- Available via link in the email notification sent to the customer

## Project Structure

```
support_system/
├── app/
│   ├── Http/Controllers/
│   │   └── TicketController.php    # Main ticket management logic
│   ├── Mail/
│   │   └── TicketCreated.php       # Email notification class
│   ├── Ticket.php                  # Ticket model
│   └── User.php                    # User model
├── database/
│   ├── migrations/                 # Database schema
│   └── seeds/
│       └── UsersTableSeeder.php    # Creates 3 support users
├── resources/
│   └── views/
│       ├── tickets/
│       │   ├── index.blade.php     # Ticket listing with filters
│       │   ├── create.blade.php    # Create ticket form
│       │   └── show.blade.php      # View ticket details
│       └── emails/
│           └── ticket_created.blade.php  # Email template
└── routes/
    └── web.php                     # Application routes
```

## Database Schema

### Users Table
- id
- name
- email
- password
- created_at, updated_at

### Tickets Table
- id
- user_id (support agent who logged the ticket)
- category (sales/accounts/it)
- first_name
- last_name
- email
- issue
- latitude
- longitude
- status (new/in progress/resolved)
- created_at, updated_at

## Technical Stack

- **Framework**: Laravel 7.x
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL
- **Authentication**: Laravel built-in authentication
- **Email**: Laravel Mail with Mailable classes

## Security Features

- CSRF protection on all forms
- Password hashing using bcrypt
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
## License

This project is open-sourced software for educational purposes.

## Author

Developed as a demonstration of full-stack web development capabilities including:
- User authentication and authorization
- CRUD operations
- Database design and relationships
- Email integration
- Filtering and pagination
- GPS coordinate capture
- Anonymous access features

