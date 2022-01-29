# Earl of March Clubs Website

ICS4U term project by Ambika and Yuki.

1. Prerequite softwares required: 
    a) XAMPP - Version 8.0.13
    Download Link: https://www.apachefriends.org/download.html 

    Installation : After downloading the link you will be brought to the set-up page where you can decide what you want to set up. For now you can just set up Apache Web Server. 
    
    Run: Then after setting it up you can run the XAMPP to see how it works. Start your browser and type http://127.0.0.1 or http://localhost in the location bar. You should see our pre-made start page with certain examples and test screens.


    b) MySQL - Version 8.0
    Download and Installation Link for Windows: https://dev.mysql.com/downloads/installer/   
    Configure: You can configure and update your settings in the "db.inc.php" file. 
    User should change the following input variables in file "db.inc.php" as per the Sql Server config on their device.
        $serverName = "localhost:3306";
        $dBUsername = "root";
        $dBPassword = "";
      
    Run: After setting it up, you can run the MySQL application.

2. Pull EOM Club website code from GIT to the "htdocs" folder of XAMPP
    GIT URL: https://github.com/yki1312/eom-clubs-website 

3. SQL Database Creation for Website
    Run databaseFile.txt in MySQl Workbench application to load the database tables - This step is a one time setup.

4. Setting up the first account on the website. 
    We would already add a line of insert query in the databaseFile.txt file under the invitation codes table, so that when the file runs, the code is added in the database itself. Then the user can use this code to create an account on the website. 

5. Access the EOM Club website main page
   URL: http://localhost:8080/EOM_WEBSITE/eom-clubs-2/main_page.php 
