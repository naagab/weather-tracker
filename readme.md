
# Installation
- Built with composer, php 7, mysql, and laravel.
- Ensure that composer, php7, and mysql are installed
- Create a database table called weatherapp.
- Clone the repository to your computer
    - Copy and rename .env.example to .env 
    - Update .env and add in the Database username and password and add in your openweathermap api key to OWM_KEY
    - In your console navigate to the project directory and run php artisan key:generate 
- To install the schema run php artisan:migrate 

#Usage
- Navigate to the project directory in your console
- Execute the cron job by running php artisan schedule:run
- Process the job by running  php artisan queue:work

# Notes
- Though I considered writing this using Symfony ultimately Laravel was chosen instead because of its built in cron and queue functionality
- Unit test was added for WeatherApi
- Additional integration tests should be added to test the Models(i.e. query scopes)
- Built using Laravel's cron and queue functionality
- Though it has it's downsides, the decision was made to use shell to prevent overlapping and make scheduling much easier
- Currently there is no way to delete old requests that have backed up in the queue
- A way to only run the job as often as the api data is updated should be put in place as there is no need to pull in stale/outdated data
- Currently An error msg is logged to the log file if there is an error, but could be changed to do anything.
- No way to remove useless entries in the queue if it is backed up
- Query scopes are used for cleaner code and to follow the DRY method in case the queries needed to be reused.
- Some leftover(commented out) code exists but left in case the user decided to pull the zip codes from the database instead of from the config file.

# Features
- Ability to fetch weather info for specified zipcodes
- Save fetched data to database