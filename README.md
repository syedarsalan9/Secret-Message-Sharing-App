# Secret Message Sharing App

This is a Laravel-based application that allows users to share encrypted messages with a colleague. The messages can only be read once before they expire or are deleted after a certain period. The application supports message encryption, expiry handling, and secure message decryption.

## Features
- Encrypt messages before storing them.
- Messages can only be read once.
- Messages are deleted after being read or after a set expiry period.
- API to read, store, and delete messages.

## Requirements
- PHP ^8.1
- MySQL ^8.0
- Node.js ^17
- Composer (for PHP dependencies)

## Installation and Setup

To run this application, follow these steps:

### 1. Clone the repository

```
git clone https://github.com/syedarsalan9/Secret-Message-Sharing-App.git
```

### 2. Install dependencies

Navigate to the project directory and install the required dependencies using Composer:

```
cd encrypted-message-app
composer install
```
### 3. Set up the environment

Create a .env file by copying the .env.example:
```
cp .env.example .env
```
Now, configure the following variables in the .env file:

Database configuration (e.g., DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
Encryption key for message decryption (e.g., ENCRYPTION_KEY)
App key by running:

```
php artisan key:generate
```

### 4. Run the migrations
Set up the database and run the migrations to create necessary tables:
```
php artisan migrate
```
### 5. (Optional) Run Docker containers
If using Docker, ensure Docker is running, and then start your containers:
```
docker-compose up -d
```
### 6. Start the development server
```
php artisan serve
```
The application will be accessible at http://localhost:8000.

Usage
### Store a Message
To store an encrypted message:
```
POST /api/messages
Request body:
json
{
    "message": "Your secret message",
    "recipient": "John Doe",
    "expires_at": "2024-09-30 12:00:00"
}
```
### Read a Message
To read and decrypt a message:
```
POST /api/messages/{id}/read
```
### Delete a Message
To delete a message:
```
DELETE /api/messages/{id}
```
### Running Tests
To run the feature and unit tests, use the following command:
```
php artisan test
```
### Available Tests
Message Encryption and Decryption: Ensures that messages are encrypted and decrypted correctly.
Message Expiry Handling: Ensures expired messages are handled properly.
Message Read Once: Tests that a message can only be read once.
Environment Encryption Key: Ensures that the encryption key is loaded correctly from the environment file.

### Folder Structure
```
├── app
│   ├── Contracts              # Interfaces for services and repositories
│   ├── Http
│   │   ├── Controllers         # API Controllers
│   │   └── Requests            # Form request validation
│   ├── Models                  # Eloquent models
│   └── Services                # Business logic layer
├── database
│   ├── migrations              # Database migrations
├── tests
│   └── Unit                 # Application test cases
```
### Additional Notes
Messages that have been read or have expired cannot be read again.
The application includes basic validation for message creation.
For security, the decryption key is fetched from the environment configuration.

### Dependencies
Laravel Framework: Used as the core framework for the application.
Illuminate Encryption: For message encryption and decryption.
PHPUnit: For testing the application.