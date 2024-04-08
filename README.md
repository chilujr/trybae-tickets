# Trybae Tickets Online Ticketing Platform

## Overview

Trybae Tickets was an online ticketing platform developed to facilitate ticket purchases for various events in Zambia. The platform focused on creating a
user-friendly interface for event organizers and attendees. The main technologies used in this project included HTML, CSS, Bootstrap for the front-end,
and PHP, MySQL, and JavaScript for the back-end.

### Features

- **Event Listing and Ticket Purchase**: Browse and select from a variety of events and purchase tickets online.
- **Flutterwave Payment Gateway Integration**: Secure and seamless payment processing for all ticket purchases.
- **QR Code Generation and Email Delivery**: Unique QR codes generated for each ticket purchase, containing details of the ticket type, user, and event.
- QR codes were sent to the customer's email for scanning upon arrival at the event.

## Project Status

**Note:** The client has since discontinued the website and switched to a mobile app for their platform.

## Technologies Used

- **Front-end**:
  - HTML
  - CSS
  - Bootstrap

- **Back-end**:
  - PHP
  - MySQL
  - JavaScript

- **Payment Gateway**:
  - Flutterwave

## Features Detail

### Event Listing and Ticket Purchase

The platform provided a comprehensive list of upcoming events with detailed information, including event name, date, venue, and ticket pricing. Users could easily browse through the events, select their preferred event, and purchase tickets online.

### Flutterwave Payment Gateway Integration

To ensure secure and efficient payment processing, the Flutterwave payment gateway was integrated into the platform. Users could make payments using various payment methods, including credit/debit cards, bank transfers, and mobile money.

### QR Code Generation and Email Delivery

Upon successful ticket purchase, a unique QR code was generated for each ticket, containing details such as the ticket type, user information, and event details. The QR code was then sent to the customer's email, which could be scanned upon arrival at the event for quick and hassle-free check-in.

## Getting Started

### Prerequisites

- Web server with PHP and MySQL support
- Flutterwave API credentials for payment gateway integration

### Installation

1. Clone the repository:

```bash
git clone https://github.com/yourusername/trybae-tickets.git
```

2. Import the database:

```bash
mysql -u username -p database_name < database.sql
```

3. Configure the database connection in `config.php`.

### Development

1. Start the web server:

```bash
php -S localhost:8000
```

2. Open [http://localhost:8000](http://localhost:8000) in your web browser to access the platform.

## Contributing

Contributions are welcome! Please read the [CONTRIBUTING.md](CONTRIBUTING.md) file for guidelines.

## License

This project is licensed under the MIT License. See the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgements

Special thanks to Chiyembekezo, Niza and contributors who contributed to the development and successful implementation of the Trybae Tickets online ticketing platform.
