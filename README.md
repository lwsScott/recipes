# recipes

####Separates all database/business logic using the MVC pattern.

- fat free for routing and templating
- .htaccess to require routing through index
- Model for database and validation classes
- Views to display individual pages
- Index as the router
   
####Routes all URLs and leverages a templating language using the Fat-Free framework.

####Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.
- Relates the recipe database to the user database
    - userId stored in recipe db
        - used to submit recipe (requiring login)
        - checks class to allow premium users to submit image
        - displays the user submitted in the recipe displays

####Data can be viewed, added, updated, and deleted.
- View recipes, View Users
- Add User
- Add Premium User
- Add recipe

#### Has a history of commits from both team members to a Git repository. Commits are clearly commented.
- Git pull, push with each other (79 commits currently)

####Uses OOP, and defines multiple classes, including at least one inheritance relationship.
- User Class
- Premium User Inherits from User 
-- Additional permissions for uploading image for recipe
- Recipe Class

####Contains full Docblocks for all PHP files and follows PEAR standards.

####Has full validation on the client side through JavaScript and server side through PHP.
- user.js and clientSideValidation.js validate data before form submission
- server side validation using validate class

####All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.

###BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to talk about it in your presentation.
- Uses Ajax to check for username availability