1. Install Wamp 2.5
2. Install Git for Windows from: 
https://git-for-windows.github.io/
3. Install Tortoise Git from:  
https://tortoisegit.org/download/ (choose 32 or 64 bit depending on your windows version).

4. Go into c:\wamp\www\
5. Right click and chose git clone
As repository enter: https://github.com/PatrikBrosell/EITF05/
Log in using your github account

A folder EITF05 should now appear in your www folder.
6. Start up Wampserver and from the menu select phpMyAdmin
7. Create a database webshop12database 
as coding scheme select utf8_bin

8. Mark the newly created database and Go to import.
Select as file to import the file  C:\wamp\www\EITF05\Install\webshop12database.sql

9. In the Wamp manager launch the Mysql->Mysql console
When asked for a password , just press enter <empty password>

type: grant all privileges on webshop12database.* to 'admin'@'localhost' identified by 'admin';

10. in the wamp manager select restart alls services

11. Wait for a while and then try accessing (using chrome) http://localhost:/EITF05/
You should now see the main screen for our project (cur blue). 

11. You're now done running the standard (nonSSL) version of the project


To get SSL working there are a bit more to do...

1. Copy the folder (and all folders below) to c:\ (needed for openssl and contains deep within the openssl.cnf file)

2 Replace the file 

C:\wamp\bin\apache\apache2.4.9\conf\httpd.conf by the one in the Installation\Apache_files
(replaces, make a backup copy of your own first)

3. Copy the files 
C:\wamp\www\EITF05\Install\Apache_files\
server.crt 
server.key 

to your 
C:\wamp\bin\apache\apache2.4.9\conf\ folder

4. Copy the file C:\wamp\www\EITF05\Install\Apache_files\httpd-ssl.conf to your folder 
C:\wamp\bin\apache\apache2.4.9\conf\extra (replaces, make a backup copy of your own first)

5. in the wamp manager select restart alls services

6. Test that you can access the site using https://localhost/EITF05/

At least Chrome will first complain and warn you a lot that the site is possibly dangerous... select advance and proceed... Because we haven't payed anyone for signing the certificate it's not trusted in Chrome (neither in any other browser either). 

If you run into trouble (apache not starting) start a administrative command prompt and go to:

C:\wamp\bin\apache\apache2.4.9\bin
run the httpd.exe command and any possible errors will be shown (possible syntax errors in the files).
