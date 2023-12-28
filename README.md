# 4Base
Connection to MySQL/MariaDB Users [WordPress, PHPkit, Drupal, Typo3... and many more!] 
- other Content Management Systems are tested like phpBB2 or Bulletin Boards. (may have to set md5_passwords = true)
- connecting to User Databases via JBDC/OBDC.
- the Java Chat system runs out of the Box from Command Line after setting up the config.php
- 
- use IPADRESS:1976 if LOCALHOST:PORT does not work!
- combined Setup with FreeCS [sourceforge](https://freecs.sourceforge.net/).

.. if you need help for correct installation of the Chat hit me up ;)



NEW FEATURES ADDED:

Upload User Pic for 5000 Gold.
Earn Money by chatting, sending messages
or playing the Browsergame while listening
your selfmade WebRadio ...

Userpoints, Shop, Chattime, Highscore, Weapons drop after Missions
(diablo2 style prefixes and suffixes), Guestbook, Private Message System



// create a start.sh or add it to startup:
sudo java -cp ./lib/freecs.jar:./lib/xmlrpc-1.2-b1.jar:./lib/ext/mysql.jar freecs.Server

(use nohup and u can close terminal/logout if you are on a VM, the Chat keeps running)


Changes* (28.12.2023 18:18)

- Upload Profile Picture now costs 5000 Gold. (to block annoying Bots)
- saved Space by DELETING the old Picture when UPLOADING one



SYSTEM REQUIREMENTS: 256mb RAM, linux server

Works with apache2, mariadb/mysql and java! .bat for Windows.

https://freecs.sourceforge.net/

https://www.4base.at/
https://www.explicitrecords.at/


