Procédure Sauvegarde Server

GUICHARNAUD Léo & TERRIEN William
2020/06/11
--------------------------------------------------------------------------------------
1)
Dans la console, taper la commande : 
=> ls
et s'assurer que le dossier rpi-clone s'affiche.
------------
pi@raspberrypi:~ $ ls
Desktop    MagPi     Public         server            Templates
Documents  Music     Python_server  setup_node.sh     Test_connection_arduino_1
Downloads  Pictures  rpi-clone      tcpServerExample  Videos
------------

2)
Si le dossier rpi-clone n'existe pas, le télecharger en entrant la commande suivante :
=> git clone https://github.com/billw2/rpi-clone.git
Puis recommencer étape 1)

3)
Se déplacer dans le dossier rpi-clone :
=> cd rpi-clone

-------------
pi@raspberrypi:~ $ cd rpi-clone
pi@raspberrypi:~/rpi-clone $
-------------

4)
Copier le contenu du dossier dans /usr/local/sbin :
=> sudo cp rpi-clone rpi-clone-setup /usr/local/sbin

5)
Stopper les services liés au serveur :
=> sudo service mysql stop
=> sudo service cron stop
=> sudo service apache2 stop

6.1)
SI IL S'AGIT DE LA 1ERE SAUVEGARDE :
SD vers USB : => sudo rpi-clone sda -f
(dans le cas d'une copie vers une SD via un adaptateur USB, on copie vers un USB)

6.2)
SI IL S'AGIT D'UNE SYNCHRONISATION :
SD vers USB : => rpi-clone sda (eventuellement sdb)

6.3)
SI IL S'AGIT DE RESTAURER LE SYSTEME :
USB vers SD : => rpi_clone mmcblk0 -f

7)
Redémarrer les services :
=> sudo service mysql start
=> sudo service cron start
=> sudo service apache2 start