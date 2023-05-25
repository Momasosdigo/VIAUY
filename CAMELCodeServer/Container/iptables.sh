#!/bin/bash
clear
$(hostname -I | awk '{print $1}')
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


function ipTables() {
    while [ "$opServ" == 3 ]; do
        echo -e "\e[0;36m[x]=============================[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 1. Aseptar nuevas ip   \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 2. Denegar nuevas ip \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 3. Rechazar trafico de un rango de ip                    \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 4. Eliminar reglas ya implicitas                    \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]=============================[x]\e[0m"
        read -r -p "=> " opServ

        case "${opServ}" in
            1)
                echo "[ ¿Que servicio desea detener? ]"
                read -r -p "=> " serviceStop
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -s su_dirección_IP_a_autorizar -j ACCEPT
                    [ "$opServ" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo existe dicho servicio\e[0m"
                    echo
                    sleep 2s
                    [ "${opServ}" = true ] && clear
                fi
            ;;

            2)
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -s su_dirección_IP_a_bloquear -j DROP
                    [ "$opServ" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo existe dicho servicio\e[0m"
                    echo
                    sleep 2s
                    [ "${opServ}" = true ] && clear
                fi
            ;;

            3)
                echo "[ ¿Que servicio desea detener? ]"
                read -r -p "=> " serviceStop
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -m iprange --src-range su_dirección_IP_inicio-su_dirección_IP_fin -j REJECT
                    [ "$opServ" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo existe dicho servicio\e[0m"
                    echo
                    sleep 2s
                    [ "${opServ}" = true ] && clear
                fi
            ;;

            4)
                echo "[ ¿Que servicio desea detener? ]"
                read -r -p "=> " serviceStop
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -m iprange --src-range su_dirección_IP_inicio-su_dirección_IP_fin -j REJECT
                    [ "$opServ" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo existe dicho servicio\e[0m"
                    echo
                    sleep 2s
                    [ "${opServ}" = true ] && clear
                fi
            ;;

            5)
                echo "[ ¿Que servicio desea detener? ]"
                read -r -p "=> " serviceStop
                
                if [ $? == 0 ]; then
                    sudo iptables -A INPUT -m iprange --src-range su_dirección_IP_inicio-su_dirección_IP_fin -j REJECT
                    [ "$opServ" = true ] && clear
                else
                    clear
                    echo
                    echo -e "\033[4;35mNo existe dicho servicio\e[0m"
                    echo
                    sleep 2s
                    [ "${opServ}" = true ] && clear
                fi
            ;;

            9)
                unset "$opServ" #[ unset ] borra la variable en memoria al salir de la funcion. 
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
                [ "${opServ}" = true ]
            ;;

            #*)
            #    clear
            #    echo
            #    echo -e "\033[4;35mNo es una opcion lo que intentas\e[0m"
            #    echo
            #    sleep 2s
            #    clear
            #;;
        esac
    done
}
ipTables