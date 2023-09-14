#!/bin/bash
clear
#############################
## Zona de auto debugging ##
#[+][+][+][+][+][+][+][+][+][+][+][+]#
handleError() {
    echo -e "\033[1;31m[+]\e[0m\e[0;36m================================================\e[0m\033[1;31m[+]\e[0m"
    echo -e "\033[1;31m[+]\e[0m [ERROR]=> LINEA ""$1""; Script error ""$0""" 
    #                           \__________________________________________/
    #                                               /
    #                                              /
    #       Esta línea muestra el mensaje de error principal. El número de línea 
    #       del error [ $1 ] y el nombre del script [ $0 ] se muestran en el mensaje de error.
    
    echo -e "\033[1;31m[+]\e[0m [Codigo error ""$2"" ]"
    #                           \____________________/
    #                                     /
    #    Se muestra el código de error con el argumento [ $2 ] que causó el problema.
    
    echo -e "\033[1;31m[+]\e[0m\e[0;36m================================================\e[0m\033[1;31m[+]\e[0m"
    exit  1 # Sale del script penas se detecta el error.
}
trap 'handleError ""$LINENO"" ""$?""' ERR
#                 \_________________/
#                          /  
# Cuando el error cae en [ trap ], [ $LINENO ] representa el número de línea donde se produjo
# el error y [ $? ] representa el código de salida del último comando ejecutado. 
# Cuando un comando termina con éxito, [ $? ] es 0, de lo contrario, tendrá un valor 
# diferente y se mostrara el código de error.

trap "echo [x] Que forma más arcaica de salir, se implementaron funciones modernas para ello [x]; exit" SIGINT
# [ SIGINT ]: Proporciona un mensaje de advertencia cuando el usuario intenta
# salir del script usando [ Ctrl+C ] luego finaliza el script con [ exit ].
#[+][+][+][+][+][+][+][+][+][+][+][+]#

while [ "$op_central" != 6 ]; do
    echo -e "\e[0;36m[x]===================================[x]\e[0m"
    echo -e "\e[0;36m|\e[0m\t      \033[1;91m\033[5m\033[3mVIAUY Server\033[0m\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m\t\t\t\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    1. Alta de Usuarios|Grupos\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    2. Baja de Usuarios|Grupos\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    3. Modificacion Usuarios|Grupos \t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    4. Listar Usuarios|Grupos\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    5. Crear Backup del sistema\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m    6. \033[0;101m\033[1;97mSalir\033[0m\t\t\t\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m[=======================================]\e[0m"
    echo -e "\e[0;36m|\e[0m    $(date)\t\e[0;36m|\e[0m"
    echo -e "\e[0;36m|\e[0m © 2023 VIAUY | Developed by CamelCode \e[0;36m|\e[0m"
    echo -e "\e[0;36m[x]===================================[x]\e[0m"
    read -r -p "$(echo -e "\e[0;36m[+]\e[0m") => " op_central 

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
            echo -e "\n\033[4;35mNo es una opcion valida lo que intentas\e[0m\n"
            sleep 2s
            clear
        ;;
    esac
done 
