#!/bin/bash
clear
#############################
## Zona de auto debugging ##
#[+][+][+][+][+][+][+][+][+][+][+][+]#
handleError() {
    echo -e "\033[1;31m[+]\e[0m\e[0;36m============================================\e[0m\033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m [ERROR]=> LINEA $1; Script error $0"
    echo -e "\033[1;31m[+]\e[0m [Codigo error $2 ]"
    echo -e "\033[1;31m[+]\e[0m\e[0;36m============================================\e[0m\033[1;31m[+]\e[0m"
    exit 1
}
trap 'handleError $LINENO $?' ERR
trap "echo [x] Que forma más arcaica de salir, se implementaron funciones modernas para ello [x]; exit" SIGINT
#[+][+][+][+][+][+][+][+][+][+][+][+]#

# Mensaje de bienvenida
echo -e "\n\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\e[0;36m|\e[0m \t\t\t\033[1;91m\033[5m\033[3mWelcome\033[0m                        \e[0;36m|\e[0m"
echo -e "\e[0;36m|\e[0m Escoja la ruta en la cual desea instalar el proyecto \e[0;36m|\e[0m"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\033[5m[+]\033[0m Directorio actual: \033[4;31m""$(pwd)""\e[0m"
echo -e "\033[5m[+]\033[0m No finalizar con \033[4;31m'/'\e[0m el directorio deseado"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"

# Leer entrada del usuario para el directorio de destino
read -r -p "$(echo -e "\e[0;36m[x]\033[0m") Directorio destino ""$(pwd)""/ => " dir

if [ ! -d "$dir" ]; then
    # Verificar si el directorio no existe
    echo -e "\nEl directorio [ ""$dir"" ] no existe, ¿desea crear uno con el nombre propuesto?"
    read -r -p "[Yy] / [Nn] => " op
    #####
    #Usando el formato ( [Yy]* ) permite escribir:
    #y, Y, yes, Yes, YEs, YES, yES, yeS
    #Lo mismo pasa con la versión contraria de negación
    #####

    if [[ $op =~ [Yy] ]]; then
        # Crear directorio y mover archivos
        echo -e "\n[ El directorio se creará a continuacion... ]"
        mkdir "$dir"
        sleep 0.45s
        sudo rsync "$HOME/VIAUYServer/Container/" "$HOME/VIAUYServer/$dir/Container/"
        sudo chmod +x "$HOME/VIAUYServer/$dir/Container/./main.sh"
        sleep 1s
        echo -e "\n\e[0;36m\033[5m[x]=================================[x]\e[0m"
        echo -e "\033[5m[+] El script se a instalado con exito [+]\033[0m"
        echo -e "\e[0;36m\033[5m[x]=================================[x]\e[0m"
        echo -e "\e[0;36m[x]\033[0m Directorio de instalacion: \033[4;31m""$HOME/VIAUYServer/$dir/""\e[0m"
        read -n1 -p "Presione cualquier tecla para [ CONTINUAR ]..."
        clear
    else
        # Salir si se niega la instalación
        echo -e "\n[ Se ha \033[4;91mdenegado\033[0m con éxito la instalacion... ]"
        sleep 0.45s
        exit
    fi
else
    #En caso de que exista un directorio se copiara todo en él
    echo -e "\n[ El directorio [ ""$dir"" ] existe y se moveran los datos a continuacion... ]"
    sudo rsync "$HOME/VIAUYServer/Container/" "$HOME/VIAUYServer/$dir/Container/"
    sudo chmod +x "$HOME/VIAUYServer/$dir/Container/./main.sh"
    sleep 1s
    echo -e "\n\e[0;36m\033[5m[x]=================================[x]\e[0m"
    echo -e "\033[5m[+] El script se a instalado con exito [+]\033[0m"
    echo -e "\e[0;36m\033[5m[x]=================================[x]\e[0m"
    echo -e "\e[0;36m[x]\033[0m Directorio de instalacion: \033[4;31m""$HOME/VIAUYServer/$dir/""\e[0m"
    read -n1 -p "Presione cualquier tecla para [ CONTINUAR ]..."
    clear
fi