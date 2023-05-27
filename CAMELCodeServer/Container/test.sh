#!/bin/bash
clear
#currentDir=$(pwd)
homeDir="$HOME"
scriptDir="Container"
scriptFile="main.sh"

sleep 1s && clear
echo -e "\n\e[0;36m\033[5m[x]======================================[x]\e[0m"
echo -e "\033[5m[+] El script se abrira en unos segundos [+]\033[0m"
echo -e "\e[0;36m\033[5m[x]======================================[x]\e[0m"
sleep 2s && clear
read -r -p "$(echo -e "\e[0;36m[x]\033[0m") Directorio destino ""$HOME""/ => "
    #echo -e "\e[0;36m[+]===================================[+]\e[0m"

