#!/bin/bash

echo "¿Realmente desea hacer un respaldo de los documentos?"
read -r -p "[Yy] / [Nn] => " op

while [ "$op" ]; do
    case "$op" in
        [Yy]*)
            # Crear directorio y mover archivos
            echo -e "\n[ Respaldo del servidor en camino.. ]"
            sleep 2s
            rsync -rav ~/CAMELCodeServer ~/CAMELCodeServer/SaveData
            sleep 1s
            
            echo -e "\n\n[ Respado de Shadow en camino... ]"
            sleep 2s
            rsync -rav /etc/shadow ~/CAMELCodeServer/SaveData
            sleep 1s

            echo -e "\n\n[ Respado de bashrc en camino... ]"
            sleep 2s
            rsync -rav ~/.bashrc ~/CAMELCodeServer/SaveData
            sleep 1s
        break;;

        [Nn]*)
            # Salir si se niega la instalación
            echo
            echo -e "[ Se ha \033[4;91mdenegado\033[0m con eñ backup... ]"
            sleep 0.45s
            exit
        ;;

        *)
            clear
            echo
            echo -e "\033[4;35mNo es una opcion lo que intentas\e[0m"
            echo
            sleep 2s
            clear
        break;;
    esac
done