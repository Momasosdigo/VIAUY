#!/bin/bash
clear

# CONFIGURACION PREVIA DE SERVICIOS #
chmod -777 ~/VIAUYServer/Container/ && mv ~/VIAUYServer/Container/ ~/VIAUYServer/.Container/

chmod -x Install-Me.sh && mv ~/VIAUYServer/Install-Me.sh ~/VIAUYServer/.Install-Me.sh

#   LICENCIA, README & SOPORTE
mv ~/VIAUYServer/README.md ~/VIAUYServer/.README.md

mv ~/VIAUYServer/LICENSE.md ~/VIAUYServer/.LICENSE.md

mv ~/VIAUYServer/SUPPORTED.md ~/VIAUYServer/.SUPPORTED.md

clear && ls -l