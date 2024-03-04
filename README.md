# An image posting site
A kind of minimalist social media site with no registration.

Made because I wanted to learn PHP and I had to create something as a school project.

My first ever project made using PHP. 🎉

## Recommended environment
A basic LAMP stack environment is the recommended environment to run this in as it was developed with one.

## Connecting to the DB
In `inc/db.php` you can change the values with which the site will access the database.

## Issues
The SQL queries are **NOT** filtered and such are **VULNERABLE** to SQL injections.

You need to manually create the folder in which the images from posts are saved to. Create the folder inside the `img` folder.

No proper way of moderation other than deleting posts manually through SQL queries and deleting the pics from `img/posts`.
