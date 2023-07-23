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

# Mensaje de bienvenida
echo -e "\n\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\e[0;36m|\e[0m\t\t\t\033[1;91m\033[5m\033[3mWelcome\033[0m\t\t\t       \e[0;36m|\e[0m"
echo -e "\e[0;36m|\e[0m Escoja la ruta en la cual desea instalar el proyecto \e[0;36m|\e[0m"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"
echo -e "\033[5m[+]\033[0m No finalizar con \033[4;31m'/'\e[0m el directorio deseado"
echo -e "\e[0;36m[x]==================================================[x]\e[0m"

# Leer entrada del usuario para el directorio de destino
read -r -p "$(echo -e "\e[0;36m[x]\033[0m") Directorio actual: ""$(pwd)""/ => " dir
if ! [[ "$dir" =~ ^[a-zA-Z0-9_]+$ ]]; then
    echo -e "\n\e[0;31m[ERROR]\e[0m El nombre de no es válido, solo letras y numeros"
    read -n1 -p "Presione cualquier tecla para [ VOLVER ]..."
    clear
    exit
fi

if [ ! -d "$dir" ]; then
    # Verificar si el directorio no existe
    echo -e "\nEl directorio [ ""$dir"" ] no existe, ¿desea crear uno con el nombre propuesto?"
    read -r -p "[Yy] / [Nn] => " installChoice
    #####
    #Usando el formato ( [Yy]* ) permite escribir:
    #y, Y, yes, Yes, YEs, YES, yES, yeS
    #Lo mismo pasa con la versión contraria de negación
    #####

    if [[ $installChoice =~ [Yy] ]]; then

        # Crear directorio y mover archivos
        echo -e "\n[ El directorio se creará a continuacion... ]"
        if mkdir -p "$dir"; then
            # La carpeta se creó correctamente
            sudo rsync -r "$HOME/VIAUYServer/Container/" "$HOME/VIAUYServer/$dir/Container/"
            sudo chmod +x "$HOME/VIAUYServer/$dir/Container/./main.sh"
            sleep 1s
            echo -e "\n\e[0;36m\033[5m[x]====================================[x]\e[0m"
            echo -e "\033[5m[+] El script se ha instalado con éxito [+]\033[0m"
            echo -e "\e[0;36m\033[5m[x]====================================[x]\e[0m"
            echo -e "\e[0;36m[x]\033[0m Directorio de instalación: \033[4;31m""$HOME/VIAUYServer/$dir/""\e[0m"
            read -n1 -p "Presione cualquier tecla para [ LANZAR ]..."

            # Verificar si la carpeta existe antes de continuar, de ser asi se lanzara ./main
            if [ -d "$dir"/Container/ ]; then
                cd "$dir"/Container/ && ( exec "./main.sh" ) || echo -e "\n\n[ \033[4;91mOcurrió un problema al lanzar el programa...\033[0m ]"
            else
                echo -e "\n[ \033[4;91mOcurrió un problema durante la instalación. El directorio no es válido...\033[0m ]"
            fi
        else
            echo -e "\n[ \033[4;91mOcurrió un problema al crear el directorio...\033[0m ]"
        fi
    else
        # Salir si se niega la instalación
        echo -e "\n[ Se ha \033[4;91mdenegado\033[0m la instalación... ]"
        sleep 0.45s
        exit
    fi
else
    # En caso de que exista un directorio se copiará todo en él
    echo -e "\n[ El directorio [ ""$dir"" ] existe y se moverán los datos a continuación... ]"
    sleep 1.5s

    # Verificar si la copia de archivos fue exitosa o no
    if sudo rsync -r "$HOME/VIAUYServer/Container/" "$HOME/VIAUYServer/$dir/Container/"; then
        # Copia exitosa, asignar permisos
        sudo chmod +x "$HOME/VIAUYServer/$dir/Container/./main.sh"
        sleep 1s
        echo -e "\n\e[0;36m\033[5m[x]====================================[x]\e[0m"
        echo -e "\033[5m[+] El script se ha instalado con éxito [+]\033[0m"
        echo -e "\e[0;36m\033[5m[x]====================================[x]\e[0m"
        echo -e "\e[0;36m[x]\033[0m Directorio de instalación: \033[4;31m""$HOME/VIAUYServer/$dir/""\e[0m"
        read -n1 -p "Presione cualquier tecla para [ LANZAR ]..."
        cd "$dir"/Container/ && ( exec "./main.sh" ) || echo -e "\n\n[ \033[4;91mOcurrió un problema al lanzar el programa...\033[0m ]"
        sleep 1.5s
        clear
    else
        # Copia fallida, mostrar mensaje de error
        echo -e "\n[ \033[4;91mOcurrió un problema durante la copia de archivos...\033[0m ]"
    fi
fi