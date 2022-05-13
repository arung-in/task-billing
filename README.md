# LARAVEL 6 - BILLING
Simple Billing Task

> Development Environment:
    *OS: WIN *7 (64bit)
    XAMPP: V3.2.4
    PHP : V7.3.9**

------------
Note: 
1. Check the .env file and update the DB credential (DB Name, DB Username, DB Password)
2. Also setup the email id and password in .env file to send emails (If you are going to use gmail then make sure you are enabled less secure app in google account)
3. Make sure you entered the following commants before starting 
`php artisan migrate`
`php artisan db:seed`
4. After site is up run this command on system command window (project folder)
`php artisan queue:work` 
or setup new task on wondows task scheduler with trigger at system startup and every minute for background run.
And create a action to start a program `c:\xampp\php\php.exe` and arguments `c:\xampp\htdocs\task-billing\artisan queue:work --once` 
