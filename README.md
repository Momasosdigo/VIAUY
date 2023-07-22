# Información de ayuda

Muy buenas, este documento le será de ayuda para comprender todo lo que vendrá a continuación dentro del servidor.
Cabe aclarar que la ejecución del código debe ser utilizado *[ ./(Nombre_Script).sh ]* evitando la necesidad de una ejecución con altos privilegios como *[ bash ./(Nombre_Script).sh ]* o forzando la ejecución con *[ sudo ./(Nombre_Script).sh ]*.

## Archivo Install-Me

Todo empieza en este documento, la idea del mismo es hacer la instalación de los archivos necesarios para el funcionamiento correcto del servidor.

Esto se hace mediante una comprobación de ruta de instalación `if [ ! -d "$dir" ]; then`, en la cual se comprueba si dicha carpeta propuesta por el usuario existe; de ser así, la instalación se llevará a cabo de manera directa. En caso contrario, se le solicitara al usuario la posibilidad de crear dicho documento de manera automática `mkdir "$dir"` y una vez creado, todo se moverán al directorio ya creado, se le dan los permisos pertinentes automáticamente y se lanzara el archivo **./main.sh** una vez finalizado el proceso.

>`cd "$dir"/Container/ && ( exec "./main.sh" )`  **=> Muestra a "./main.sh" sin necesidad de ir a la ruta en donde se encuentra.**

## ./main.sh

Siendo desde aquí, que se conectara a los demás scripts los cuales por seguridad son archivos de texto plano, los cuales no cuentan con extensión de ningún tipo, ni permisos más que solo ***lectura y escritura***. Siendo así que no se podrán ejecutar de manera individual sin el archivo raíz (main) el cual funcionaria como llave, como, por ejemplo, lanzar alta de usuarios y grupos: `source scripts/alta` al hacerse desde la raíz, no es necesario contar con una extensión ni permisos extra.

## Carpeta *scripts*

Aquí dentro es donde se encuentran todos los scripts necesarios, en los cuales se maneja el ABML (Alta, Baja, Modificación y Listado) del servidor, incluyendo un backup automático de los datos importantes, para en caso de suceder un problema se pueda solucionar de manera rápida.

### ABML

- **Alta *usuario*:** Se encarga de dar de alta a un usuario creado directamente su directorio automáticamente, al igual que darle una terminal (bash predefinida por el servidor) y permitirle o no tener un grupo primario ya existente de así quererse.

>`sudo useradd -g "$primGroup" -m -d /home/"$nameUserChoice"/ -p "$passUser" -s /bin/bash "$nameUserChoice"`  **=> Crea el usuario con un nombre y un directorio personal. al igual que define su contraseña y se le asigna una terminal, incluyendo la posibilidad de tener un grupo primario.**

- **Alta *grupos*:** A diferencia de alta de usuario es que aquí puedes dar de alta a un grupo y a su vez poder agregar un usuario existente a dicho grupo. La creación del mismo consiste en que se le dará un nombre, sin antes comprobar que dicho nombre no existe `if grep -q -E "^$nameGrup:" /etc/group; then` en caso de ser un nombre de grupo ya existente; se negará la creación del mismo. En caso contrario, se creará `sudo groupadd "$nameGrup"` y de esta manera el usuario podrá escoger entre agregar a algún usuario o no al mismo, sin antes comprobar que dicho usuario ya es existente en el servidor `if id "$nameUser" >/dev/null 2>&1; then` en caso de ser asi, se podrá agregar sin problemas `sudo groupadd "$nameGrup"`.

>`if id "$nameUser" >/dev/null 2>&1; then`  **=> Se le pide al servidor el id del usuario y se pasa por `>/dev/null 2>&1` para comprobar su existencia y esto redirigir los mensajes de error en caso de no existir hacia un dispositivo especial en el sistema (dev/null) que descarta la información. Y así de esta manera, se suprime la salida y los mensajes de error del comando en cuestión y podremos personalizar los nuestros propios en caso de así quererlo.**

- **Baja *usuario*:** De ser necesario dar de bajá a un usuario por algún motivo, se podrá hacer sin problemas. En caso de ser un usuario existente se podrá quitar al usuario como su directorio personal. Para esto se valida su existencia `if id "$removedUsers" >/dev/null 2>&1; then`.

>`sudo userdel -r "$removedUsers"`  **=> Utilizando `-r (--remove, --remove-home)` se eliminará por completo tanto el usuario en sí; como su directorio completo.**

- **Baja *grupos*:** Si bien podemos dar de baja a usuarios, lo mismo sucede con los grupos. Lo diferente aquí, es que si bien se puede eliminar por completo el grupo, se decidió que primero se quitaran a los usuarios dentro de dicho grupo, para luego si eliminarlo definitivamente.

Para evitar problemas primero comprobamos la existencia del grupo `userList=$(grep -E "^$removedGroup:" /etc/group | cut -d ":" -f4)` al igual que en *alta de grupo*, ahora comprobamos cuantos usuarios están dentro `if [ -n "$userList" ]; then` esto nos devolverá la cantidad de usuarios dentro del grupo, una vez que ya sepamos que el grupo existe y así mismo que contiene usuarios, podremos eliminarlo si lo deseamos con el comando `sudo gpasswd -d "$userList" "$removedGroup" >/dev/null 2>&1` el cual quitara a todos los usuarios dentro del grupo de una pasada, siendo así, que se eliminara el grupo por completo una vez este vaciado `sudo groupdel -f "$removedGroup"`. De caso contrario que no haya nadie dentro, se pasara por alto la remoción de usuarios y se ira directo a la eliminación.

- **Modificación *usuario*:** Para la modificación del usuario se podrá tanto cambiar su nombre `sudo usermod -l "$newUserName" "$userName"`, como una nueva contraseña `echo "$newUserName:$new_password" | sudo chpasswd` y se podrá tanto ingresar al usuario a un grupo primario y secundario; como el quitarlo de dichos grupos.

>`sudo usermod -a -g "$primary_group" "$userName"`  **=> Añade al usuario a un grupo primario, como uno secundario, simplemente cambiando la `-g` minúscula por una mayúscula `-G`**

>`sudo deluser "$userName" "$delete_primary_group"`  **=> Es posible eliminar o dar de baja dicho usuario de un grupo primario, tanto como uno secundario**

- **Modificación *grupos*:** La diferencia aquí, es el hecho de que se podrá agregar como eliminar más de un solo usuario, la forma más practica de conseguir esto es utilizar una estructura `for()` acompañado de un `if` el cual comprueba si la cadena `$addUsersPrimaryGroup` está vacía, siendo asi un valor menor a 0, siendo que de esta forma se detendrá el bucle el cual agrega uno a uno a los usuarios a un grupo o darlos de baja del mismo:

``` Shell Script
 # Agregar usuarios al grupo primario si se proporcionan
 if [ -n "$addUsersPrimaryGroup" ]; then
     for user in $addUsersPrimaryGroup; do
         sudo usermod -a -g "$groupName" "$user"
     done
 fi

  # Agregar usuarios al grupo secundario si se proporcionan
 if [ -n "$addUsersSecondGroup" ]; then
     for user in $addUsersSecondGroup; do
         sudo usermod -a -G "$groupName" "$user"
     done
 fi

 # Eliminar usuarios del grupo primario si se proporcionan
 if [ -n "$removeUsersPrimaryGroup" ]; then
     for user in $removeUsersPrimaryGroup; do
         sudo deluser "$user" "$groupName"
     done
 fi

 # Eliminar usuarios del grupo secundario si se proporcionan
 if [ -n "$removeUsersSecondGroup" ]; then
     for user in $removeUsersSecondGroup; do
         sudo deluser "$user" "$groupName" 
     done
 fi

```

- **Listado:** El listado del sistema mostrara tanto los usuarios, como los grupos incluyendo en poder ver en qué grupo puede estar un usuario en específico.

>`cut -d: -f1,3 /etc/passwd | grep -E ':[0-9]{4}$' | cut -d: -f1 ` **=> Muestra todos los usuarios con un [ id ] mayor a 1000, siendo estos aquellas cuentas reales del sistema.**

>`getent group | awk -F: '$1 != "nobody" && $3 > 1000 {print $1}'` **=> De igual forma que los usuarios, a qui se mostraran lo grupos reales del sistema, excluyendo al grupo `nobody` el cual es tanto el usuario como el grupo que está destinado a representar al usuario y grupo con menos permisos en el sistema.**

>`groups "$watchUsers"` **=> De esta forma podremos ver los usuarios dentro de cualquier grupo**

## Respaldo del servidor

La seguridad del servidor radica en crear un backup del mismo y de los datos importantes por igual, siendo asi que en caso de una emergencia se podrá solucionar el problema rápidamente. El backup se hará de manera automática mediante **crontab**, pudiendo visualizarlo mediante *crontab -l*. 

```
Output

00 12 * * * admin /home/admin/VIAUYServer/Container/scripts/backup
```

### Respaldos

```
sudo rsync -rav /etc/shadow "$HOME"/SaveData_"$(date +%d-%m-%Y)"/
sudo rsync -rav /etc/passwd "$HOME"/SaveData_"$(date +%d-%m-%Y)"/
sudo rsync -rav /etc/group "$HOME"/SaveData_"$(date +%d-%m-%Y)"/
```

Como se aprecia, se hace una copia de shadow, passwd y group, todas terminan en una carpeta con la fecha del backup, para llevar un control de los respaldos mas fácil. Sin embargo, la base de datos de VIAUY, es respaldada con una de las herramientas que ya vienen con la instalación de MySQL, siendo [ mysqldump ].

>`mysqldump -u root -p Viauy > "$HOME"/Backup_BD_"$(date +%d-%m-%Y)".sql`
