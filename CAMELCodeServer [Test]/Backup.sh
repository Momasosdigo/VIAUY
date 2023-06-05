#!/bin/bash

echo "¿Realmente desea hacer un respaldo de los documentos?"
read -r -p "[Yy] / [Nn] => " op

if [[ $op =~ [Yy] ]]; then
    # Crear directorio y mover archivos
    echo -e "\n\n[ Respaldo del servidor en camino.. ]"
    sleep 2s
    rsync -rav ~/CAMELCodeServer ~/CAMELCodeServer/SaveData
    sleep 1s
    
    echo -e "\n\n[ Respado de Shadow en camino... ]"
    sleep 2s
    rsync -rav /etc/shadow ~/CAMELCodeServer/SaveData
    sleep 1s
    
    echo -e "\n\n[ Respado de passwd en camino... ]"
    sleep 2s
    rsync -rav ~/passwd ~/CAMELCodeServer/SaveData
    sleep 1s

    #! revisar
    echo -e "\n\n[ Respado de passwd en camino... ]"
    sleep 2s
    rsync -rav ~/passwd ~/CAMELCodeServer/SaveData
    sleep 1s
else
    # Salir si se niega la instalación
    echo -e "\n[ Se ha \033[4;91mdenegado\033[0m con eñ backup... ]"
    sleep 0.45s
    exit
fi