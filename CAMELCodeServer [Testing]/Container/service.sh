#!/bin/bash
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


function services() {
    while [ "$opServ" == 3 ]; do
        echo -e "\e[0;36m[x]=============================[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 1. Ver servicios actuales   \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 2. Mas opcione de servicios \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]\e[0m 3. Salir                    \e[0;36m[x]\e[0m"
        echo -e "\e[0;36m[x]=============================[x]\e[0m"
        read -r -p "=> " opServ

        case "${opServ}" in
            1)
                clear
                systemctl list-dependencies --after cron
                [ "$opServ" = true ] && clear
            ;;

            2)
                echo -e "\e[0;36m[x]=================================================[x]\e[0m"
                echo -e "\e[0;36m|\e[0m 1. Iniciar                                          \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 2. Reiniciar                                        \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 3. Detener                                          \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 4. Recarga configuracion sin necesidad de reiniciar \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 5. Havilitar un servicio permanente                 \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 6. Deshabilitar un servicio permanente              \e[0;36m|\e[0m"
                echo -e "\e[0;36m|\e[0m 7. \033[0;101m\033[1;97mVolver\033[0m                                           \e[0;36m|\e[0m"
                echo -e "\e[0;36m[x]=================================================[x]\e[0m"
                read -r -ṕ "=> " foo

                case "${foo}" in
                    1)
                        echo "[ ¿Que servicio desea levantar? ]"
                        read -r -p "=> " serviceUp

                        if [ $? == 0 ]; then
                            sudo systemctl start $serviceUp
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m puesto en marcha \e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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
                        echo "[ ¿Que servicio desea reiniciar? ]"
                        read -r -p "=> " serviceRel

                        if [ $? == 0 ]; then
                            sudo systemctl restart $serviceRel
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m reiniciado \e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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
                            sudo systemctl stop $serviceStop
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m detenido \e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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
                        echo "[ ¿Que servicio desea recargar? ]"
                        read -r -p "=> " serviceReload

                        if [ $? == 0 ]; then
                            sudo systemctl reload $serviceReload
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m relogueado \e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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
                        echo "[ ¿Que servicio desea habilitar? ]"
                        read -r -p "=> " serviceEnable

                        if [ $? == 0 ]; then
                            sudo systemctl enable $serviceEnable
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m habilitado\e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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

                    6)
                        echo "[ ¿Que servicio desea deshabilitar? ]"
                        read -r -p "=> " serviceDisable

                        if [ $? == 0 ]; then
                            sudo systemctl disable $serviceDisable
                            echo "Checking.." && sleep 1s
                            echo -e "\e[0;36m[+]\e[0m Ha sido \033[46mexitosamente\033[0m puesto en marcha \e[0;36m[+]\e[0m"
                            read -n1 -p -r "Presione cualquier tecla para [ CONTINUAR ]..."
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

                    7)
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
                esac
            ;;

            *)
                clear
                echo
                echo -e "\033[4;35mNo es una opcion lo que intentas\e[0m"
                echo
                sleep 2s
                clear
            ;;
        esac
    done
}
services