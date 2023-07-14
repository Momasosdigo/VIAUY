#!/bin/bash
clear
#############################
## Zona de auto debugging ##
#[+][+][+][+][+][+][+][+][+][+][+][+]#
handleError() {
    echo -e "\033[1;31m[+]\e[0m\e[0;36m================================================\e[0m\033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m [ERROR]=> LINEA ""$1""; Script error ""$0"""
    echo -e "\033[1;31m[+]\e[0m [Codigo error ""$2"" ]"
    echo -e "\033[1;31m[+]\e[0m\e[0;36m================================================\e[0m\033[1;31m[+]\e[0m"
    exit 1
}
trap 'handleError ""$LINENO"" ""$?""' ERR
trap "echo [x] Que forma más arcaica de salir, se implementaron funciones modernas para ello [x]; exit" SIGINT
#[+][+][+][+][+][+][+][+][+][+][+][+]#

while [ "$op_central" != 6 ]; do
    echo -e "\e[0;36m[x]===================================[x]\e[0m"
    echo -e "\e[0;36m|\e[0m\t      \033[1;91m\033[5m\033[3mVIAUY Server\033[0m\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m\t\t\t\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    1. Alta de Usuarios|Grupos\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    2. Baja de Usuarios|Grupos\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    3. Modificacion Usuarios|Grupos \t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    4. Listar Usuarios\t\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    5. Crear Backup del sistema\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    6. \033[0;101m\033[1;97mSalir\033[0m\t\t\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m[=======================================]\e[0m"
    echo -e "\e[0;36m|\e[0m    $(date -u)\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m © 2023 VIAUY | Developed by CamelCode \e[0;36m|\e[0m"
    echo -e "\e[0;36m[x]===================================[x]\e[0m"
    read -r -p "$(echo -e "\e[0;36m[+]\e[0m") => " op_central 
# ssh admin@192.168.1.9
    case $op_central in
        1) #menú principal
            sleep 0.50s
            # shellcheck source=/dev/null
            source scripts/alta
        break;;

        2) #menú principal
            sleep 0.50s
            # shellcheck source=/dev/null
            source  scripts/baja
        break;;

        3) #menú principal
            sleep 0.50s
            # shellcheck source=/dev/null
            source scripts/mod
        break;;

        4) #menú principal
            sleep 0.50s
            # shellcheck source=/dev/null
            source  scripts/list
        break;;

        5) #menú principal
            sleep 0.50s
            # shellcheck source=/dev/null
            source  scripts/backup
        break;;
        
        6) #menú principal
            echo -e "\n\033[4;30m\033[1;35mVuelva pronto\033[0m \033[1;35m^^\033[0m"
            sleep 1.5s && clear
            exit
        ;;

        *)
            clear
            echo
            echo -e "\033[4;35mNo es una opcion lo que intentas\e[0m"
            echo
            sleep 2s
            clear
        ;;
    esac #Final case principal
done #Final while principal