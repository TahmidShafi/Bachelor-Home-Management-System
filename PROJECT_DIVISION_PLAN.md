# Project Division Plan & Documentation

This document outlines the division of work between two developers for the Bachelor Mess Management System. The project is split by modules to minimize merge conflicts and ensure clear ownership.

## 👨‍💻 Developer Roles

### Developer 1: Supervisor, Registration, Login
**Responsibilities:**
-   **Authentication**: Login, Registration, Logout.
-   **Supervisor Dashboard**: All features related to the Supervisor role (Expense tracking, Meal management for all, Period management, Billing).
-   **Core Data Entry**: Expenses, Deposits.

### Developer 2: Admin & Resident
**Responsibilities:**
-   **Admin Dashboard**: User management, Role assignment, System-wide notices, Complaint resolution.
-   **Resident Dashboard**: Personal meal management, Personal history, Complaint submission.
-   **Notices**: Posting and managing notices.

---

## 📂 File Ownership Strategy

To avoid conflicts, each developer "owns" specific files. If you need to edit a file owned by the other developer, coordinate first or create a Pull Request.

### ✅ Specific Files for Developer 1
*(Supervisor, Registration, Login)*

**Views (Frontend/Dashboards):**
-   `index.php` (Login/Landing)
-   `register.php`
-   `dashboard_supervisor.php`
-   `archives.php` (Archive Viewer)

**Actions (Backend Logic):**
-   `login.php` (Logic)
-   `logout.php`
-   `register_action.php`
-   `add_expense.php`
-   `update_expense.php`
-   `add_deposit.php`
-   `update_deposit.php`
-   `delete_entry.php` (Expenses/Deposits)
-   `update_meal.php` (Primary owner - logic for updating meals)
-   `close_period.php`
-   `generate_bills.php`
-   `reset_data.php`
-   `undo_reset.php`
-   `setup_periods.php`
-   `period_utils.php`
-   `get_archive_data.php` (AJAX handler for Archive View)
-   `register_script.js` (Frontend validation for Register)
-   `update_schema_v2.php` (Core Schema Updates)

---

### ✅ Specific Files for Developer 2
*(Admin, Resident)*

**Views (Frontend/Dashboards):**
-   `dashboard_admin.php`
-   `dashboard_resident.php`
-   `archived_notices.php`

**Actions (Backend Logic):**
-   `update_role.php`
-   `update_user_details.php`
-   `delete_user.php`
-   `add_notice.php`
-   `delete_notice.php`
-   `add_complaint.php`
-   `delete_complaint.php`
-   `fetch_meal_history.php` (Used by Resident to view own history)
-   `fetch_archived_notices.php`
-   `setup_archive_tables.php`
-   `setup_trash_tables.php`

---

### 🤝 Shared Files (Collaborative)
*Changes to these files affect both. Be careful when merging.*

-   `config.php` (Database connection)
-   `style.css` (Global styles)
-   `script.js` (Global helper functions)
-   `DOCUMENTATION.md` (General docs)

---

## 🚀 GitHub Workflow (Both Developers Have Files)

Since both developers currently have the files locally, follow these **exact** steps to avoid "unrelated history" errors and conflicts.

### 1. Setup Phase (Critical Step)
*One person must establish the "Source of Truth". We choose **Developer 1** for this.*

#### Developer 1 (The Initializer)
1.  Go to GitHub and create a new **empty** repository.
2.  Open your local project folder in terminal.
3.  Run these commands to upload the full project:
    ```bash
    git init
    git add .
    git commit -m "Initial commit: Base project uploaded"
    git branch -M main
    git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git
    git push -u origin main
    ```

#### Developer 2 (The Joiner)
**⚠️ IMPORTANT:** Even though you have the files, your local folder is not connected to GitHub. **DO NOT** run `git init` on your existing folder. logic: It will create a separate history that conflicts with Dev 1.

1.  **Rename** your current existing folder to `bachelor_system_BACKUP` (just in case).
2.  **Download** the fresh repository from Dev 1:
    ```bash
    # Go to your htdocs folder
    cd c:\xampp\htdocs
    
    # Clone the clean repo (Password/Token may be asked)
    git clone https://github.com/YOUR_USERNAME/REPO_NAME.git bachelor_system
    
    # Enter the new folder
    cd bachelor_system
    ```
3.  Now you are perfectly synced with Dev 1.

---

### 2. Conflict Avoidance Strategy (Who Owns What?)

To prevent "clashes" (Merge Conflicts), we assign strict ownership for the **Shared Files**.

#### 🛡️ Shared Files Ownership: **Developer 1**
*Files: `style.css`, `script.js`, `config.php`, `DOCUMENTATION.md`*

*   **Rule**: **Developer 1** is the primary owner of these files.
*   **Developer 2**: Try **NOT** to edit `style.css` or `config.php` for now.
    *   *If you must change styles*: Add your own CSS file (e.g., `resident.css`) and include it in your PHP files. Do not touch the main `style.css` if possible.
    *   *If you must edit `script.js`*: Notify Dev 1 before pushing.

---

### 3. Immediate Action Plan: Synchronizing to GitHub

**Do this RIGHT NOW to get the project online.**

#### Developer 1 (The "Source of Truth")
*   **Action**: Pushes the entire codebase to GitHub first.
1.  Open Terminal in your project folder (`c:\xampp\htdocs\bachelor_system`).
2.  Run these commands:
    ```bash
    git init
    git add .
    git commit -m "Initial Full Project Upload"
    git branch -M main
    git remote add origin https://github.com/YOUR_USERNAME/REPO_NAME.git
    git push -u origin main
    ```
3.  **Status**: The code is now live on GitHub.

#### Developer 2 (The "Syncer")
*   **Action**: Joins the repository.
*   **⚠️ CRITICAL WARNING**: Do **NOT** push from your current folder. It will cause conflicts.
1.  **Backup**: Rename your current folder to `bachelor_system_BACKUP`.
2.  **Clone**: Download the fresh code from Dev 1.
    ```bash
    cd c:\xampp\htdocs
    git clone https://github.com/YOUR_USERNAME/REPO_NAME.git bachelor_system
    ```
3.  **Restore Your Work (If any)**:
    *   If you had specific changes in your BACKUP folder that are *not* in Dev 1's code, copy those specific files into the new `bachelor_system` folder now.
4.  **Push (Only if you added new work)**:
    ```bash
    cd bachelor_system
    git add .
    git commit -m "Added my local changes"
    git push origin main
    ```

*(After this one-time setup, you can follow normal git pull/push routines).*
---

## � Folder-Level Ownership
*For directories containing multiple files.*

### 1. `js/` (JavaScript Assets)
*Include these in your specific file commitments.*
-   **Developer 1**: `js/supervisor.js`
-   **Developer 2**: `js/admin.js`, `js/resident.js`
-   *Shared*: `script.js` (Owned by Dev 1, Dev 2 requests changes).

### 2. `app/` (Backend Architecture)
*This seems to be a new MVC structure being implemented.*
-   **Primary Owner**: **Developer 1** (Architecture & Auth).
-   **Current Contents**:
    -   `app/controllers/auth_controller.php` -> **Developer 1**
    -   `app/views/auth/` -> **Developer 1**
-   *Future Rule*: If Dev 2 adds `admin_controller.php`, they own that specific file, but Dev 1 manages the directory structure.

### 3. `public/` (Public Assets & Entry)
-   **Primary Owner**: **Developer 1**.
    -   `public/index.php`: The main entry point (Router).
    -   `public/css/`: Stylesheets.
-   **Developer 2**: Can add files here (e.g., `public/images/resident_guide.pdf`) but should not alter the core structure or `index.php` without coordination.

---

## �📝 Documentation for specific Features

### Supervisor Module (Dev 1)
-   **Meal Management**: Uses `update_meal.php`. This script handles both "My Meal" updates and "Resident Meal" updates.
-   **Billing**: `generate_bills.php` calculates costs based on total expenses / total meals. Ensure `close_period.php` is tested before generating bills.

### Admin Module (Dev 2)
-   **Notices**: `add_notice.php` inserts into the `notices` table. `dashboard_admin.php` displays active notices (last 24h).
-   **User Management**: `update_role.php` allows promoting Residents to Supervisors. Be careful not to lock out the last Admin.
