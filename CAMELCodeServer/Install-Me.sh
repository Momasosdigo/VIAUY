#!/bin/bash
clear
#############################
## Zona de auto debugging ##
#[+][+][+][+][+][+][+][+][+][+][+][+]#
handleError() {
    echo -e "\033[1;31m[+]\e[0m\e[0;36m============================================\e[0m\033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m [ERROR]=> LINEA $1; Script error $0 \033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m [Codigo error $2 ]                        \033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m\e[0;36m============================================\e[0m\033[1;31m[+]\e[0m"
    exit 1
}
trap 'handleError $LINENO $?' ERR
trap "echo [x] Que forma mas arcaica de salir, se implementaron funciones modernas para ello [x]; exit" SIGINT
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
echo -e "\033[5m[+]\033[0m Directorio actual: \033[4;31m""$(pwd)""\e[0m    "
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

    while [ "$op" ]; do
        case "$op" in
            [Yy]*)
                # Crear directorio y mover archivos
                echo
                echo "[ El directorio se creará a continuacion... ]"
                mkdir "$dir"
                sleep 0.45s
                mv "$scriptDir" "$homeDir/$dir/"
                sudo chmod +x "$homeDir/$dir/$scriptDir/$scriptFile"
                sleep 1s && clear
                echo -e "\n\e[0;36m\033[5m[x]======================================[x]\e[0m"
                echo -e "\033[5m[+] El script se abrira en unos segundos [+]\033[0m"
                echo -e "\e[0;36m\033[5m[x]======================================[x]\e[0m"
                sleep 2s && clear
                ( exec "$homeDir/$dir/$scriptDir/./main.sh" )
            break;;

            [Nn]*)
                # Salir si se niega la instalación
                echo
                echo -e "[ Se ha \033[4;91mdenegado\033[0m con exito la instalacion... ]"
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
else
    echo
    mv "$scriptDir" "$homeDir/$dir/"
    sudo chmod +x "$homeDir/$dir/$scriptDir/$scriptFile"
    sleep 1s && clear
    echo -e "\n\e[0;36m\033[5m[x]======================================[x]\e[0m"
    echo -e "\033[5m[+] El script se abrira en unos segundos [+]\033[0m"
    echo -e "\e[0;36m\033[5m[x]======================================[x]\e[0m"
    sleep 2s && clear
    ( exec "$homeDir/$dir/$scriptDir/./main.sh" )
fi