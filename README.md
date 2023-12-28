# 4Base

Connection to MySQL/MariaDB Users [WordPress, PHPkit, Drupal, Typo3... and many more!] 

 ----------------------------------------------------------------------------------------------------------------------
- other Content Management Systems are tested like phpBB2 or Bulletin Boards. (may have to set md5_passwords = true)
- connecting to User Databases via JBDC/OBDC.
- the Java Chat system runs out of the Box from Command Line after setting up the config.php

- use IPADRESS:1976 if LOCALHOST:PORT does not work!
- combined Setup with FreeCS [sourceforge](https://freecs.sourceforge.net/).
  
.. if you need help for correct installation of the Chat hit me up ;)



NEW FEATURES ADDED!!!

Tip: upload a profile picture on registration, or u have to pay 5k gold/points ;)

Old Picture will be DELETET when UPLOADING A NEW ONE to save Space.
Price and Shop System. Earn Money by chatting, sending messages etc.
Go for Missions in 10Minutes, 20Minutes, 30Minutes .. up to 120min.
Add your selfmade WebRadio and you are good to go ;)

Extras:
Userpoints, Shop, Chattime, Highscore, Weapons drop after Missions
(diablo2 style prefixes and suffixes), Guestbook, Private Message System
.. and many more Features coming soon(TM)




FreeCS INSTALLATION:

// create a start.sh or add it to startup:
sudo java -cp ./lib/freecs.jar:./lib/xmlrpc-1.2-b1.jar:./lib/ext/mysql.jar freecs.Server

(use nohup and u can close terminal/logout if you are on a VM, the Chat keeps running)



Changes* (28.12.2023 18:18)
- .. save disk space by deleting/overriting the profile.jpg with the upload function


SYSTEM REQUIREMENTS: 256mb RAM, linux server
Works with apache2, mariadb/mysql and java! .bat for Windows.

https://freecs.sourceforge.net/


__________________________________
(c) 2023 powered by CouNTiNG aka.
bazercount || all rights are saved

//////////////////////////////////

         new project:
 https://www.explicitrecords.at/
 
        old projects:       __  
                          /    \
     https://www.d2dragz.net    \  Diablo 2 Drag-Z Mod v1.3 is still avaible: https://www.moddb.com/games/diablo-2-lod/addons/d2dragznet-v11-sfx
     https://www.4base.at/  __   \ offline* Music Label and WebRadio
     https://kampfbox.at  /____\  offline* BrowserGame)
     https://chat-area.at/<<:::>>\  offline* Chat/WebRadio Community)
                     /__/    :    \_/
//////////////////////////////////
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
