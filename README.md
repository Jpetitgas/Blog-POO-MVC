# Blog-POO-MVC
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/626f7f7fa34c4344967a1d2d6eacd11d)](https://www.codacy.com/gh/Jpetitgas/Blog-POO-MVC/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Jpetitgas/Blog-POO-MVC&amp;utm_campaign=Badge_Grade)

the website is online : www.blogpeje0416.odns.fr

This project respect :
PHP Standards Recommendations
object-oriented, respect for the principle of encapsulation ( entities, hydration of objects coming from the database, one class per table)
custom pages for errors
inherited templates
security: XSS, CRSF, SQL injection, php script upload

To use the project:
create a database on your server
import the sql file located /sql/blog.sql in your server
clone the directory on your server
adapt the /config/config.php file to your configuration :
<?php
const MAIL="yourmail@mail.com";
const BASE_PATH = "pathtoyourdirectory"; // exemple : http:/blog/
const DB_DSN = 'mysql:dbname=yourdatabasename;host=pathtoyourdatabase';
const DB_USERNAME = 'yourusername';
const DB_PASSWORD = 'yourpassword';