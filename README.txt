
# BudgetManager

## Introduction
BudgetManager is a Laravel-based application designed to manage and track budgets and expenses efficiently. The system provides a user-friendly interface that displays a logo at the top left, alongside a menu offering options for "Budget Categories" and "Expenses". Users can navigate through the site using this intuitive layout to manage their financials effectively.

## Installation Commands

### Set Up PHP and Composer
```
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php8.3 composer php8.3-xml php8.3-curl php8.3-dom php8.3-intl php8.3-mbstring php8.3-zip -y
```

### Create New Project and Install Sail
```
composer create-project laravel/laravel BudgetManager "10.*"
cd BudgetManager
composer require laravel/sail --dev
php artisan sail:install --with=mysql,redis,meilisearch,selenium
```

### Configure Bash Alias for Sail
```
nano ~/.bashrc
# Add the following line at the bottom of the file:
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### Sail Commands
```
# Start the container in detached mode
sail up -d

# Stop containers running in detached mode
sail stop

# Stop and remove containers
sail down
```

## Modules

### Budget Categories
- **Overview**: Provides a table displaying registered categories.
- **Functionalities**: 
  - "ADD CATEGORY" button for new entries.
  - Each entry includes "Title", "Budget", and "edit" options.
  - A message "No Categories" is displayed if no entries exist.

### Expenses
- **Overview**: Shows "Expenses - [Current Month] [Current Year]" and includes month navigation.
- **Functionalities**: 
  - Displays budget categories with expenses listed for the current month.
  - Progress bars indicate budget utilization (Green, Yellow, Red).
  - Options to add, edit, and delete expenses, with server-side validation.

## Development and Operation
This section includes all necessary commands to set up and manage the application environment, specifically tailored for development purposes using Laravel Sail. The selected services during the `sail:install` (MySQL, Redis, Meilisearch, Selenium) are crucial for the application's full functionality.

## Conclusion
BudgetManager is tailored to provide a detailed yet straightforward interface for managing monthly and yearly budgets. It integrates advanced tools and technologies to ensure a secure, reliable, and user-friendly experience for managing personal or organizational finances.
