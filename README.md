PROJECT OVERVIEW

This project is a web-based stock management system designed to help businesses efficiently track and manage their inventory. It provides a user-friendly interface for adding, updating, and monitoring stock levels, ensuring accurate inventory records and streamlining a critical aspect of business operations.

FEATURES

- User authentication (admin and cashier roles)
- Stock management (adding, updating, deleting stock items)
- Category management (organizing stock items into categories)
- Transaction management (tracking sales and purchases)
- Reporting (generating daily and overall reports)
- User profile management
- Password management

TECHNOLOGY STACK

- PHP: Server-side scripting language
- MySQL: Relational database management system
- HTML: Standard markup language for creating web pages
- CSS: Style sheet language used for describing the presentation of a document
- JavaScript: Programming language that enables interactive web pages
- Bootstrap: Front-end framework for developing responsive, mobile-first projects on the web
- jQuery: Fast, small, and feature-rich JavaScript library
- Chart.js: Simple yet flexible JavaScript charting library
- DataTables: Plug-in for the jQuery JavaScript library that adds interaction controls to HTML tables

SETTING UP THE SYSTEM

1.  **Extract the project files:** Unzip the downloaded folder and place it in your web server's document root directory (e.g., `htdocs` for XAMPP, `www` for WampServer, `htdocs` for LAMP).
2.  **Start your web server:** Ensure your Apache and MySQL services are running.
3.  **Database Configuration:**
    *   The system uses a database named `pepsheen` by default. You can verify or change this in `/classes/Dbh.class.php` (look for the `$dbname` variable).
    *   Open `phpMyAdmin` (usually accessible via `http://localhost/phpmyadmin`).
    *   Create a new database with the name identified above (e.g., `pepsheen`).
    *   Import the `pepsheen.sql` file (located in the `/dbfile/` directory of the project) into the newly created database.
4.  **Access the application:** Open your web browser and navigate to the project directory (e.g., `http://localhost/your_project_folder_name/`).
5.  **You're all set!**

USAGE

This system is designed for stock management and can be accessed by two types of users: Administrators and Cashiers. After logging in, users will be directed to their respective dashboards.

**Admin Role**
Administrators have comprehensive access to the system's functionalities. After logging in with an admin account, they can perform the following actions:

*   **Dashboard (`dashboard.php`):** View an overview of the system, including key statistics and summaries.
*   **Stock Management:**
    *   Manage Categories (`categories.php`): Add, edit, and delete stock categories.
    *   Manage Stock Items (`stock.php`, `stockDetails.php`): Add new stock, update existing item details, view stock levels, and remove items.
    *   Stocktaking (`stocktake.php`, `stocktakes.php`): Initiate and manage stocktaking processes to ensure inventory accuracy.
*   **Reporting:**
    *   Daily Reports (`dailyReport.php`): View sales and stock activities for the day.
    *   Stock Reports (`stockReport.php`): Generate detailed reports on stock levels and movements.
    *   Overall Statistics (`overallStats.php`): Access comprehensive statistics and analytics about the system's performance.
*   **Settings & Profile:**
    *   Manage Rates (`rates.php`): Configure system rates (e.g., pricing, tax).
    *   Manage Profile (`profile.php`, `userProfile.php`): Update personal admin profile information.
    *   Change Password (`password.php`, `userPassword.php`): Update admin account password.

**Cashier Role**
Cashiers have access focused on sales processing and managing their own accounts. After logging in with a cashier account, they can perform the following actions:

*   **Dashboard (`dashboard.php`):** View a cashier-specific dashboard, possibly showing daily sales totals or recent transactions.
*   **Sales & Transactions:**
    *   Process Transactions (`transact.php`): Initiate and manage sales transactions with customers.
    *   Payment Processing (`payNow.php`): Handle payments for transactions.
    *   Manual Item Entry (`manualAdd.php`): Add items to a transaction manually if needed.
*   **Profile Management:**
    *   Manage Profile (`profile.php`, `userProfile.php`): Update personal cashier profile information.
    *   Change Password (`password.php`): Update cashier account password.

To use the system, navigate to the login page (usually the root of the project folder in your web server) and enter your credentials. Based on your role, you will be redirected to the appropriate dashboard with access to the features listed above.

LOGGING IN

The system comes with the following default login credentials:

*   **Admin Account:**
    *   LoginID: `admin`
    *   Password: `12345678`
*   **Cashier Account:**
    *   LoginID: `cashier`
    *   Password: `12345678`

IMPORTANT NOTES

*   The passwords for the default accounts might have been changed after the initial setup.
*   If you are unable to log in with the default credentials, you may need to reset the password (see below) or contact the system administrator.

RESETTING PASSWORDS
If you forget your password or need to reset it for an account:

1.  Open `phpMyAdmin` (usually at `http://localhost/phpmyadmin`).
2.  Select your project's database (e.g., `pepsheen`).
3.  Open the `users` table.
4.  Locate the user account (e.g., `admin` or `cashier`) for which you want to reset the password.
5.  Edit the row for that user and clear the existing value in the `password` column (make it empty).
6.  Save the changes to the `users` table.
7.  Take note of the `LoginID` for that user.
8.  Navigate to the application's login page in your browser.
9.  Enter the `LoginID` (for which you cleared the password) and click the "Login" button (leave the password field empty if the system allows, or enter any placeholder if it requires one – the system should then prompt for a new password).
10. The system should redirect you to a page to set a new password for the account.
11. Enter and confirm your new password.
12. You should now be able to log in with the new password. Well done!

CONTRIBUTING

We welcome contributions to enhance this Stock Management System. If you're interested in contributing, please follow these guidelines:

**Reporting Bugs**
*   If you encounter a bug, please check if it has already been reported by searching the issue tracker (if available, or consider creating one for the project).
*   If the bug is unreported, please provide a detailed description, including:
    *   Steps to reproduce the bug.
    *   Expected behavior.
    *   Actual behavior.
    *   Your system environment (e.g., PHP version, browser, operating system).
    *   Any relevant error messages or screenshots.

**Suggesting Enhancements or New Features**
*   If you have an idea for an enhancement or a new feature, please outline your suggestion with as much detail as possible.
*   Explain the potential benefits and use cases for the proposed change.
*   You can submit this as a feature request in the issue tracker or through the contact details provided.

**Submitting Changes (Pull Requests)**
1.  **Fork the Repository:** Start by forking the main project repository to your own account.
2.  **Create a New Branch:** For each set of changes (e.g., a bug fix, a new feature), create a new branch from the `main` or `develop` branch (if applicable). Use a descriptive branch name (e.g., `fix/login-bug`, `feature/add-reporting-module`).
3.  **Make Your Changes:** Implement your changes in your branch. Ensure your code is clear, well-commented, and follows the existing coding style where possible.
4.  **Test Your Changes:** Thoroughly test your modifications to ensure they work as expected and do not introduce new issues.
5.  **Commit Your Changes:** Write clear and concise commit messages that explain the purpose of your changes.
6.  **Submit a Pull Request (PR):** Push your changes to your forked repository and then submit a pull request to the original project repository. Provide a clear description of the changes in your PR.

**Coding Conventions**
*   **Style:** Try to maintain a consistent coding style with the existing codebase. (If specific style guides like PSR are adopted later, they would be mentioned here).
*   **Comments:** Add comments to your code where necessary to explain complex logic or non-obvious parts.
*   **Readability:** Write code that is easy to read and understand. Use meaningful variable and function names.
*   **Testing:** While not explicitly enforced with automated tests in this project version, ensure your changes are manually tested. Contributions that include tests for new functionality are highly appreciated.

Your contributions are valuable, and we appreciate your effort in helping to improve this project!

CONTACT

Developer: Tanaka Kadzunge
Email: tkadzzz@gmail.com
LinkedIn: https://linkedin.com/in/tanaka-kadzunge

Don't hesitate to contact me for further assistance or help, I will get back to you within a day.

Good luck!!!
