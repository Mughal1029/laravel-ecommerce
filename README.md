# Laravel Ecommerce Website

A beginner-level Ecommerce web application built using Laravel (PHP) for learning and portfolio purposes.

---

## Project Overview

This project is a simple ecommerce website where users can register, login, browse products, add items to cart, and place orders.  
The application includes user and admin roles, order management, and online payment integration.

This project is created mainly for:
- Learning Laravel
- Practicing real-world ecommerce flow
- Showcasing skills on GitHub portfolio

---

## User Roles

### Default User
- Every new registered user is a normal user by default
- Users cannot become admin automatically
- Admin role is assigned manually by the developer via database

### Admin
- Admin is controlled from database
- Admin has access to dashboard and management features

---

## Frontend Structure

### Home Page
- Static Header:
  - Home
  - Shop
  - Buy
  - Contact Us
- Dynamic Buttons:
  - Login
  - Register
  - Dashboard
  - Cart
  - Search

### Slider
- Static image slider on home page

### Products Section
- Latest products shown on home page
- View All Products option
- Single product detail page
- Back to products option

### Contact Section
- Static contact form

### Footer
- Static footer

---

## Authentication Flow

- User can login or register from header
- If a guest user clicks "Add to Cart":
  - Redirected to Login / Register page
- After login:
  - User can add products to cart
  - Place orders

---

## Cart & Order Features (User Side)

- Add products to cart
- Update or remove cart items
- View total price
- Place order using:
  - Cash on Delivery
  - Online Payment (Stripe)
- User can:
  - Update order
  - Cancel order
  - Withdraw order before delivery

---

## User Dashboard

From dashboard, user can:
- View added products
- View My Orders
- Download invoice (PDF)
- View order details
- Navigate back to products
- Logout

---

## Admin Dashboard

Admin can manage the following:

### Category Management
- Add category
- View categories
- Update category
- Delete category

### Product Management
- Add products with images and description
- View products
- Update products
- Delete products

### Order Management
- View all orders
- Change order status:
  - Pending
  - Delivered
  - Cancelled
- View invoices
- Cancel or withdraw orders

---

## Payment Methods

- Cash on Delivery
- Stripe Payment Gateway (online payment)

---

## Technologies Used

- PHP (Laravel Framework)
- Blade Templates
- MySQL Database
- Bootstrap (basic usage)
- Stripe Payment Integration
- PDF Invoice Generation

---

## Project Purpose

- Learn Laravel fundamentals
- Practice CRUD operations
- Understand authentication and authorization
- Build a portfolio-ready project

---

## License

This project is open-source and available under the MIT License.

---

## Author

Your Name  
Beginner Laravel Developer  
GitHub: https://github.com/Mughal1029/laravel-ecommerce