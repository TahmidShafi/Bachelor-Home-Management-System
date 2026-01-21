# Bachelor Mess Management System - Documentation

## System Overview
The **Bachelor Mess Management System** is a web-based application designed to streamline the daily operations of a bachelor mess. It manages members (residents), expenses, meals, deposits, and monthly billing. The system provides role-based access control for Admins, Supervisors/Managers, and Residents.

### Key Features
*   **Role-Based Access Control**:
    *   **Admin**: Full control over users, roles, system configuration, and data management.
    *   **Supervisor**: Manages daily expenses, meals, deposits, and notices.
    *   **Resident**: View personal dashboards, meal history, bill status, and notices.
*   **Meal Management**: Track daily meals for each member (Breakfast, Lunch, Dinner).
*   **Expense Management**: Record market/grocery expenses.
*   **Deposit System**: Track member deposits to the mess fund.
*   **Automatic Billing**: Generate monthly bills based on total expenses, meal rate (mill rate), and individual meal consumption.
*   **Notice Board**: Post and view important announcements.
*   **Complaint Box**: Residents can submit complaints anonymously or publicly.
*   **Archives**: View history of past months (expenses, meals, bills).

## Directory Structure

```text
/bachelor_system
├── app/
│   ├── config/             # Database configuration
│   ├── controllers/        # Business logic (e.g., AuthController)
│   ├── models/             # Database interactions (e.g., UserModel)
│   └── views/              # View templates (Auth pages)
├── js/                     # Frontend JavaScript logic (Admin, Supervisor, Resident)
├── public/                 # Publicly accessible assets (CSS, Images)
├── add_*.php               # Scripts to add data (expenses, meals, etc.)
├── update_*.php            # Scripts to update data
├── delete_*.php            # Scripts to delete data
├── dashboard_*.php         # Role-specific dashboards
├── index.php               # Landing page
├── login.php               # Login page
├── register.php            # Registration page
├── style.css               # Main stylesheet
└── config.php              # Global configuration settings
```

## Setup Instructions

1.  **Server Requirements**:
    *   PHP 7.4 or higher
    *   MySQL/MariaDB
    *   Apache Server (XAMPP/WAMP recommended)

2.  **Installation**:
    *   Clone or extract the project folder into your server's root directory (e.g., `C:\xampp\htdocs\bachelor_system`).
    *   Start Apache and MySQL services.

3.  **Database Setup**:
    *   Open phpMyAdmin (`http://localhost/phpmyadmin`).
    *   Create a new database named `bachelor_system`.
    *   Import the provided SQL file (if available) or rely on the application to initialize tables (check `app/config/database.php` for connection details).

4.  **Configuration**:
    *   Edit `app/config/database.php` to match your database credentials:
        ```php
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'bachelor_system');
        ```

5.  **Running the App**:
    *   Open your browser and verify the URL: `http://localhost/bachelor_system`.

## Usage Guide

### Registration & Login
*   New users must register via `register.php`.
*   Approval is required by an Admin before a user can log in.

### Admin Actions
*   Approve new users in the "Pending Requests" section.
*   Assign roles (Supervisor, Resident).
*   Reset system data for a new month via `reset_data.php`.

### Supervisor Actions
*   **Add Daily Meals**: Navigate to the "Manage Meals" section.
*   **Add Expenses**: Record daily market costs.
*   **Add Deposits**: Record payments from members.
*   **Notices**: Post updates for everyone.

### Resident Actions
*   Check the dashboard for current meal count and deposit balance.
*   View the generated bill at the end of the month.

## Development & Collaboration
For details on how the project is divided between developers and the GitHub workflow, please refer to [PROJECT_DIVISION_PLAN.md](PROJECT_DIVISION_PLAN.md).
