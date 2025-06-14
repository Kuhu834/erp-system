# ERP System

A Laravel-based ERP system for inventory and sales order management.

## Setup Instructions

1. Clone the repo  
   `git clone https://github.com/kuhu834/erp-system.git`

2. Go into project folder  
   `cd erp-system`

3. Install dependencies  
   `composer install`

4. Copy `.env.example` to `.env`  
   `cp .env.example .env`

5. Generate key  
   `php artisan key:generate`

6. Setup DB in `.env`, then run migrations:  
   `php artisan migrate`

7. Start development server:  
   `php artisan serve`
