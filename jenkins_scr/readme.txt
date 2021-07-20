The order in which the scripts are called from the Jenkins' Job - Acceptance_test_freestyle is,

sudo /home/app/scripts/cre_copyphar.sh
sudo php /home/app/scripts/cre_phar_copyphar.php
sudo ansible-playbook /root/ansible/copy_phar.yaml



1)cre_copyphar.sh
=================


- removes the directory named, "copyphar", if it already exists (the variabe, BUILD holds the value of the path).
- creates a directory called, "copyphar" on the build server (source).
- copies the source code (located in the workspace under the path - "src") to "copyphar".
- Also, copies index.php  from the workspace root directory.


2) cre_phar_copyphar.php
========================

- It packages (in .phar format) the files in the path - "/var/www/html/phar/copyphar".
- creates the phar file named "myapp.phar"  in the path, /var/www/html/phar.
- sets index.php as a stub file, so that it can execute when the phar file is called/used.



3)copy_phar.yaml (ansible play book)
===================================

- this is executed on the target server where the acceptance testing will take place
- creates "phar" directory under /var/www/html/
- removes directory - "app" from "/var/www/html/phar" 
- copies the myapp.phar file created by the 2nd script onto the target server
- copies "app.php",".htaccess", "extract_phar1.php", "create_phar.php" located at "/home/app/scripts" on the build server to the target server in the path - "/var/www/html".
- executes extract_phar1.php which extracts from the myapp.phar file and deletes the phar file.
- updates certain required variables in "index.php" and "config.php"
- creates a phar from the updated scripts located @/var/www/html/phar/app; the myapp.phar file will be created in /var/www/html/phar
- moves myapp.phar from the path to DOCUMENTROOT of apache (that is, /var/www/html). 


