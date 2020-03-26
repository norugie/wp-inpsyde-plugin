# WORDPRESS PLUGIN SAMPLE #

### PLUGIN SUMMARY ###

This WordPress plugin lets the user access a list of users and user information with data fetched from the API `https://jsonplaceholder.typicode.com/users`. Once the plugin is installed and activated through the WordPress admin panel, the user can navigate to `domain.com/userlist`, where they can see a table list of users and click on each user to see more information.

* **Version:** 1.0.0
* **Author:** Rugie Ann Barrameda

### TECHNOLOGIES USED ###
* PHP 7.3.16
* HTML5 & CSS3
* JQuery 3.4.1
* WordPress 5.3.2 (for the WordPress installation and testing)
* PHPUnit 9.0 (for unit testing)

### INSTALLATION GUIDE ###
* Navigate to your WordPress installation's plugins folder.
* From the plugins folder, clone the plugin repository using `git clone https://norugie@bitbucket.org/norugie/wp-plugin-inpsyde.git`.
* Use `composer install` or `composer update` to install dependencies

### NOTES ON UNIT TESTING ###
* When using PHPUnit to do a unit test, make sure that the PHP version you're using is PHP 7.2 and above.