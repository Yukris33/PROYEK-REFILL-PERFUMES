# SCENTC — Perfume Refill E-Commerce Platform

A Laravel-based perfume refill e-commerce project featuring customer ordering workflows and an administrative dashboard.

## Project Overview

SCENTC is a web application for browsing perfume products, managing a shopping cart, checking out, viewing order history, and interacting with a voucher and rewards system. Administrators can review business statistics, monitor orders and payments, and manage vouchers and reward-related records.

This portfolio project focuses on **PHP/Laravel backend development**, including MVC architecture, Eloquent ORM, form validation, authentication, database transactions, and reporting queries.

## Tech Stack

| Area | Technologies |
| --- | --- |
| Backend | PHP 8.2+, Laravel 12 |
| Views & Styling | Laravel Blade, Tailwind CSS |
| Frontend tooling | JavaScript, Vite |
| Data access | Eloquent ORM, relational database queries |
| Architecture | Laravel MVC |

## Key Features

- **Authentication and admin access:** Customer login and registration, session-based authentication, and protected admin routes.
- **Cart management:** Add items, update quantities, remove products, and calculate order totals.
- **Checkout and payment records:** Create orders and associated payment records, calculate voucher discounts, and process checkout inside a database transaction.
- **Order history and reviews:** View previous purchases, review information, and reward-point activity.
- **Admin reporting:** Track orders, paid revenue, ratings, and trends through summaries and charts.
- **Voucher and points management:** Monitor voucher claims and usage, reward-point transactions, and available voucher stock.

## Application Screenshots

### 1. User Login

The login page provides account access for customers and administrators, with administrative routes protected by role-based middleware.

<img src="https://github.com/user-attachments/assets/35e0b90d-f351-42d0-ac2a-30ba3d183484" alt="SCENTC login page" width="800" />

### 2. Shopping Cart Management

Customers can update item quantities or remove products before checkout, with cart changes processed through Laravel controllers.

<img src="https://github.com/user-attachments/assets/c75d492a-a65f-43ad-8122-5360384a5b27" alt="SCENTC shopping cart" width="800" />

### 3. Checkout & Payment Flow

The checkout workflow calculates order totals and applicable voucher discounts, then creates order and payment records using a Laravel database transaction.

<img src="https://github.com/user-attachments/assets/a349420d-bdf3-4ade-ab53-77d08ed14e03" alt="SCENTC payment workflow screenshot one" width="800" />

<img src="https://github.com/user-attachments/assets/a8e3c7dd-b859-4765-afaf-a08956b4b05f" alt="SCENTC payment workflow screenshot two" width="800" />

### 4. Order History, Reviews & Reward Points

Customers can view past orders and purchase details alongside product reviews and reward-point activity.

<img src="https://github.com/user-attachments/assets/6a4f2aaa-6284-4a50-b135-0239c4480ab4" alt="SCENTC customer order history" width="800" />

### 5. Admin Dashboard & Analytics

The admin dashboard summarizes revenue, orders, customer ratings, and other business metrics, with charts generated from database queries.

<img src="https://github.com/user-attachments/assets/9fda3468-abbe-4811-8a30-dbdd67458976" alt="SCENTC admin dashboard overview" width="800" />

<img src="https://github.com/user-attachments/assets/107543bd-4c3f-4627-bf16-36f3cc8a092c" alt="SCENTC admin analytics charts" width="800" />

### 6. Voucher & Reward Management

Administrators can review voucher availability, claims, redemption activity, and customer reward-point transactions, with support for creating vouchers and tracking voucher stock.

<img src="https://github.com/user-attachments/assets/73272edd-ba8c-4c05-8e73-d9c7048afc2e" alt="SCENTC voucher management view one" width="800" />

<img src="https://github.com/user-attachments/assets/9a854b0f-12b6-4421-a4fa-93e10501b92a" alt="SCENTC voucher management view two" width="800" />

<details>
<summary>View additional voucher management screenshots</summary>

<img src="https://github.com/user-attachments/assets/5f56ef95-c1ac-4418-84f2-3e974e2d3374" alt="SCENTC voucher management view three" width="800" />

<img src="https://github.com/user-attachments/assets/1de60392-8e31-4571-a846-fe1bf92415f0" alt="SCENTC voucher management view four" width="800" />

</details>

## Laravel Implementation Highlights

- **MVC pattern:** HTTP routes map to controllers, Eloquent models manage data, and Blade templates render pages.
- **Eloquent ORM:** Models represent carts, orders, payments, users, reviews, vouchers, and related records.
- **Checkout transactions:** Checkout creates order items and payment records within a database transaction and validates voucher eligibility.
- **Authorization:** Laravel authentication and admin middleware protect administrative endpoints.
- **Data reporting:** Dashboard queries aggregate revenue, order statuses, product sales, and customer ratings for visual reporting.

## Local Development

**Requirements:** PHP 8.2+, Composer, Node.js/npm, and a correctly configured relational database.

1. Clone the repository and open the project folder.
2. Install dependencies and create a local environment file:

   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   ```

   On Windows Command Prompt, use `copy .env.example .env` instead of `cp`.

3. Configure your database connection and credentials in `.env`. Do not commit this file.
4. Ensure the application's required database tables exist. **The current source archive does not contain migrations for every commerce-related table**, so a fresh installation needs the missing schema/migrations before the complete application can run. Some dashboard queries use MySQL-specific `DATE_FORMAT()` syntax; verify database compatibility.
5. Start the Laravel server and Vite development server in separate terminals:

   ```bash
   php artisan serve
   ```

   ```bash
   npm run dev
   ```

## Project Structure

```text
app/
  Http/Controllers/     # Customer and admin request handlers
  Models/               # Eloquent models
resources/views/        # Blade views
routes/web.php           # Web routes and middleware
resources/css/          # Styles
resources/js/           # Frontend assets
database/migrations/    # Available schema migrations
```

## Notes

- Screenshots demonstrate application interfaces; payment record handling should not be interpreted as a verified third-party payment gateway integration.
- The application is presented as a development/portfolio project, not as a publicly deployed production service.
