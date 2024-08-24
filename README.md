Movie Library

Movie Library is a Laravel-based application that allows users to browse and manage a collection of movies. The project demonstrates the use of Laravel's powerful features to create a user-friendly movie management system.

Purpose of the Project
The purpose of the Movie Library project is to provide a simple and efficient way to manage a collection of movies. It serves as a practice project for learning and demonstrating Laravel's capabilities in building web applications.

Key Features
Browse Movies: Users can view a list of all movies in the library.
Search Functionality: Easily search for movies .
Movie Details: View detailed information about each movie.
Add Movies: Add new movies to the library.
Edit Movies: Update the details of existing movies.
Delete Movies: Remove movies from the library.
Responsive Design: The application is responsive and works on both desktop and mobile devices.

Installation Instructions
Follow these steps to set up the project locally:

Clone the Repository:
git clone https://github.com/hamzaIssa254/Movie-Library.git
Navigate to the Project Directory:
cd Movie-Library


Install Dependencies:
Install the PHP dependencies using Composer:
composer install

Environment Setup:

Copy the .env.example file to .env and configure your environment variables (e.g., database connection):
cp .env.example .env

Generate the application key:
php artisan key:generate

Database Migration:
Run the migrations to set up the database tables:
php artisan migrate

Serve the Application:

Start the development server:
php artisan serve

The application will be accessible at http://localhost:8000.


Prerequisites
Before you begin, ensure you have the following installed:

PHP >= 8.0
Composer
A web server (e.g., Apache, Nginx)
A database (e.g., MySQL, PostgreSQL)

Usage Instructions
Once the application is running, you can use it as follows:

Home Page:list of movies.
Add a Movie:  add a new movie to the library.
Edit a Movie: use the "Edit"  to modify the information.
Delete a Movie:you can delete a movie
