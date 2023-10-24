#!/bin/bash
clear

# INSTALACION DE DEPENDENCIAS #
echo -e "\n\e[0;36m[x] Instalando utilidades necesarias.. [x]\e[0m"
sudo dnf install python3-pip -y && echo -e "[ \033[1;32mSe instalo & configuro con exito la dependencia\033[0m ]" || echo -e "\n[ \033[4;91mOcurrio un problema con la instalacion de la dependecia...\033[0m ]" && sleep 3s && clear

echo -e "\n\e[0;36m[x] Instalando utilidades necesarias.. [x]\e[0m"
pip install frogmouth && echo -e "[ \033[1;32mSe instalo & configuro con exito la dependencia\033[0m ]" || echo -e "\n[ \033[4;91mOcurrio un problema con la instalacion de la dependecia...\033[0m ]" && sleep 3s && clear

echo -e "\n\e[0;36m[x] Instalando utilidades necesarias.. [x]\e[0m"
sudo dnf install rsync -y && echo -e "[ \033[1;32mSe instalo & configuro con exito la dependencia\033[0m ]" || echo -e "\n[ \033[4;91mOcurrio un problema con la instalacion de la dependecia...\033[0m ]" && sleep 3s && clear

# CONFIGURACION PREVIA DE SERVICIOS #
echo -e "\n\e[0;36m[x] Configurando archivos... [x]\e[0m"
mv ~/VIAUYServer/.Container/ ~/VIAUYServer/Container/ && chmod +771 ~/VIAUYServer/Container/&& echo -e "[ \033[1;32m¡[1] Configuracion con exito!\033[0m ]\n" || echo -e "\n[ \033[4;91mOcurrio un problema en la configuracion...\033[0m ]\n" && sleep 2s

mv ~/VIAUYServer/.Install-Me.sh ~/VIAUYServer/Install-Me.sh && echo -e "[ \033[1;32m¡[2] Configuracion con exito!\033[0m ]\n" || echo -e "\n[ \033[4;91mOcurrio un problema en la configuracion...\033[0m ]\n" && sleep 2.6s && clear

# README, LICENCIA & SOPORTE
echo -e "\n\e[0;36m[x] Configuracion de documentos... [x]\e[0m"
mv ~/VIAUYServer/.README.md ~/VIAUYServer/README.md && echo -e "[ \033[1;32m¡[README] Configuracion con exito!\033[0m ]\n" || echo -e "\n[ \033[4;91mOcurrio un problema en la configuracion...\033[0m ]\n" && sleep 2.5s

mv ~/VIAUYServer/.LICENSE.md ~/VIAUYServer/LICENSE.md && echo -e "[ \033[1;32m¡[LICENSE] Configuracion con exito!\033[0m ]\n" || echo -e "\n[ \033[4;91mOcurrio un problema en la configuracion...\033[0m ]\n" && sleep 2.5s 

mv ~/VIAUYServer/.SUPPORTED.md ~/VIAUYServer/SUPPORTED.md && echo -e "[ \033[1;32m¡[SUPPORTED] Configuracion con exito!\033[0m ]\n" || echo -e "\n[ \033[4;91mOcurrio un problema en la configuracion...\033[0m ]\n" && sleep 2.5s && clear

#00 12 * * * admin /home/admin/VIAUYServer/Container/scripts/backup >> crontab - e 

# PERMISOS DE SISTEMA #
chmod +x Install-Me.sh
echo -e "\n[ \033[1;32mLas dependencias se han creado con exito\033[0m ]" 

read -n1 -p "Presione cualquier tecla para [ LANZAR SERVIDOR ]..."
( exec "./Install-Me.sh" )