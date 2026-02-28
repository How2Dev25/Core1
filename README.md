<div align="center">
  <img src="https://hotel.soliera-hotel-restaurant.com/images/logo/sonly.png" alt="Soliera Hotel and Restaurant Logo" width="200">
  
  # Soliera Hotel and Restaurant Management System
  
  <p align="center">
    Savor The Stay, Dine With Elegance
  </p>
  
  <p align="center">
    <a href="#about">About</a> •
    <a href="#features">Features</a> •
    <a href="#technology-stack">Technology Stack</a> •
    <a href="#installation">Installation</a> •
    <a href="#contact">Contact</a>
  </p>
</div>

## About

Soliera Hotel and Restaurant is a premier hospitality establishment dedicated to providing exceptional experiences for our guests. Our web application serves as a digital gateway to our world-class services, allowing visitors to explore accommodations, dining options, and make reservations seamlessly.

## Features

<div style="background: white; padding: 20px; border-radius: 8px;">

| Feature | Description |
|---------|-------------|
| **RFID Door Lock Integration** | Secure keyless entry system with RFID technology for enhanced guest convenience and security |
| **Gemini Room Reservation** | AI-powered room booking system with intelligent recommendations and personalized experiences |
| **Hotel Operations Management** | Comprehensive dashboard for managing housekeeping, maintenance, staff scheduling, and inventory |
| **Billing and Payments** | Integrated payment gateway with automated invoicing, multiple payment options, and digital receipts |
| **Restaurant Menu** | Explore our culinary offerings with detailed descriptions and pricing |
| **Online Reservations** | Secure your table or room with our easy-to-use booking interface |
| **Gallery** | Virtual tour of our facilities and accommodations |
| **Special Offers** | Discover exclusive packages and seasonal promotions |
| **Contact Management** | Direct communication with our hospitality team |

### Detailed Feature Breakdown

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px;">

<div style="border: 1px solid #e5e7eb; padding: 15px; border-radius: 8px;">
<h4 style="color: #0a1929;">RFID Door Lock Integration</h4>
<p>Contactless room access using RFID keycards or mobile devices. Real-time access logs, temporary access permissions for staff, and integration with check-in/check-out workflows.</p>
</div>

<div style="border: 1px solid #e5e7eb; padding: 15px; border-radius: 8px;">
<h4 style="color: #0a1929;">Gemini Room Reservation</h4>
<p>Intelligent booking engine that learns guest preferences, suggests room upgrades, and optimizes room assignments based on guest history and special requests.</p>
</div>

<div style="border: 1px solid #e5e7eb; padding: 15px; border-radius: 8px;">
<h4 style="color: #0a1929;">Hotel Operations Management</h4>
<p>Streamlined operations including housekeeping task assignment, maintenance request tracking, staff shift scheduling, and inventory management for supplies and amenities.</p>
</div>

<div style="border: 1px solid #e5e7eb; padding: 15px; border-radius: 8px;">
<h4 style="color: #0a1929;">Billing and Payments</h4>
<p>Secure payment processing supporting credit cards, digital wallets, and bank transfers. Automated invoice generation, split billing options, and digital receipt delivery via email or SMS.</p>
</div>

</div>
</div>

## Technology Stack

<div style="background: #0a1929; color: white; padding: 20px; border-radius: 8px;">

**Framework**
- Laravel - PHP web application framework with expressive syntax

**Additional Technologies**
- PHP for robust backend development
- MySQL for reliable database management
- RFID integration for door lock systems
- Google Gemini AI for intelligent room recommendations
- Payment gateway integration for secure billing
- Responsive design for all devices
- Modern frontend technologies for enhanced user experience

</div>

## Installation

```bash
# Clone the repository
git clone https://github.com/How2Dev25/Core1.git

# Navigate to project directory
cd Core1

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Start the development server
php artisan serve