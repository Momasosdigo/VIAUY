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

# Variables
homeDir="$HOME"
scriptDir="Container"
scriptFile="main.sh"

# Mensaje de bienvenida
echo -e "\n\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\e[0;36m|\e[0m \t\t\t\033[1;91m\033[5m\033[3mWelcome\033[0m                        \e[0;36m|\e[0m"
echo -e "\e[0;36m|\e[0m Escoja la ruta en la cual desea instalar el proyecto \e[0;36m|\e[0m"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\033[5m[+]\033[0m Directorio actual: \033[4;31m""$(pwd)""\e[0m"
echo -e "\033[5m[+]\033[0m No finalizar con \033[4;31m'/'\e[0m el directorio deseado"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"

# Leer entrada del usuario para el directorio de destino
read -r -p "$(echo -e "\e[0;36m[x]\033[0m") Directorio destino ""$HOME""/ => " dir

if [ ! -d "$dir" ]; then
    # Verificar si el directorio no existe
    echo "El directorio no existe, ¿desea crear uno con el nombre propuesto?"
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
        cp -r "$scriptDir" "$homeDir/$dir/"
        chmod +x "$homeDir/$dir/$scriptDir/$scriptFile"
        sleep 1s && clear
        echo -e "\n\e[0;36m\033[5m[x]======================================[x]\e[0m"
        echo -e "\033[5m[+] El script se abrira en unos segundos [+]\033[0m"
        echo -e "\e[0;36m\033[5m[x]======================================[x]\e[0m"
        sleep 2s && clear
        ( exec "$homeDir/$dir/$scriptDir/./main.sh" )
    else
        # Salir si se niega la instalación
        echo -e "\n[ Se ha \033[4;91mdenegado\033[0m con éxito la instalacion... ]"
        sleep 0.45s
        exit
    fi
else
    #En caso de que exista un directorio se copiara todo en él
    echo
    cp -r "$scriptDir" "$homeDir/$dir/"
    chmod +x "$homeDir/$dir/$scriptDir/$scriptFile"
    sleep 1s && clear
    echo -e "\n\e[0;36m\033[5m[x]======================================[x]\e[0m"
    echo -e "\033[5m[+] El script se abrira en unos segundos [+]\033[0m"
    echo -e "\e[0;36m\033[5m[x]======================================[x]\e[0m"
    sleep 2s && clear
    ( exec "$homeDir/$dir/$scriptDir/./main.sh" )
fi