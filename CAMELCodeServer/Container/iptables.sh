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
ipActual=$(hostname -I | awk '{print $1}')
#[+][+][+][+][+][+][+][+][+][+][+][+]#


function ipTables() {
    while [ "$ipTables" == 6 ]; do
        echo -e "\e[0;36m[x]=======================================[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 1. Aseptar nuevas ip                  \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 2. Denegar nuevas ip                  \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 3. Rechazar trafico de un rango de ip \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 4. Eliminar reglas ya implicitas      \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 5. Guardar cambios                    \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 6. \033[0;101m\033[1;97mVolver\033[0m                             \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]=======================================[x]\e[0m"
        read -r -p "=> " ipTables

        case "${ipTables}" in
            1)
                echo "[ ¿Que nueva regla desea aceptar? ]"
                echo "[ Su ip actual es: $ipActual   ]"
                read -r -p "=> " ipUp
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -s $ipUp -j ACCEPT
                    echo "Checking.." && sleep 1s
                    echo -e "\e[0;36m[+]\e[0m Se ha aceptado \033[46mexitosamente\033[0m la nueva ip \e[0;36m[+]\e[0m"
                    read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
                    [ "$ipTables" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo es una ip valida\e[0m"
                    echo
                    sleep 2s
                    [ "${ipTables}" = true ] && clear
                fi
            ;;

            2)
                echo "[ ¿Que nueva regla desea denegar? ]"
                echo "[ Su ip actual es: $ipActual   ]"
                read -r -p "=> " ipDown

                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -s $ipDown -j DROP
                    echo "Checking.." && sleep 1s
                    echo -e "\e[0;36m[+]\e[0m Se ha denegado \033[46mexitosamente\033[0m la nueva ip \e[0;36m[+]\e[0m"
                    read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
                    [ "$ipTables" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo es una ip valida\e[0m"
                    echo
                    sleep 2s
                    [ "${ipTables}" = true ] && clear
                fi
            ;;

            3)
                echo "[ ¿Que regla desea rechazar? ]"
                echo "[ Su ip actual es: $ipActual   ]"
                read -r -p "=> " ipDown
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -m iprange --src-range $ipActual-$ipDown -j REJECT
                    echo "Checking.." && sleep 1s
                    echo -e "\e[0;36m[+]\e[0m Se ha rechazado \033[46mexitosamente\033[0m la nueva ip \e[0;36m[+]\e[0m"
                    read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
                    [ "$ipTables" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo es una ip valida\e[0m"
                    echo
                    sleep 2s
                    [ "${ipTables}" = true ] && clear
                fi
            ;;

            4)
                echo "[ ¿Que regla desea rechazar? ]"
                echo "[ Su ip actual es: $ipActual   ]"
                read -r -p "=> " ipDel
                
                if [ $? == 0 ]; then
                    sudo iptables -D INPUT $ipDel
                    echo "Checking.." && sleep 1s
                    echo -e "\e[0;36m[+]\e[0m Se ha eliminado \033[46mexitosamente\033[0m la nueva ip \e[0;36m[+]\e[0m"
                    read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
                    [ "$ipTables" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo es una ip valida\e[0m"
                    echo
                    sleep 2s
                    [ "${ipTables}" = true ] && clear
                fi
            ;;

            5)
                    sudo -s iptables-save -c
                    echo "Checking.." && sleep 1s
                    echo -e "\e[0;36m[+]\e[0m Se ha guardado \033[46mexitosamente\033[0m las nuevas reglas \e[0;36m[+]\e[0m"
                    read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
                    [ "$ipTables" = true ] && clear
            ;;

            9)
                unset "$ipTables" #[ unset ] borra la variable en memoria al salir de la funcion. 
                ( exec "./main.sh" )
                #Con el comando [ exec ] reemplaza al Shell sin crear un nuevo proceso. 
                #Sin embargo, podemos ponerlo en una SubShell, la cual usara 
                #un porcentaje de procesador y ram, para usar esto es 
                #quitando el comando [ exec ] y dejando solo los paréntesis y el path del main:
                #[ ( "./main.sh" ) ].
                #(La segunda opción es buena idea usarla en caso que se dese ejecutar tareas pesadas)
            ;;

            *)
                clear
                echo
                echo -e "\033[4;35mNo es una opcion lo que intentas\e[0m"
                echo
                sleep 2s
                clear
                [ "${ipTables}" = true ]
            ;;
        esac
    done
}

ipTables