#!/bin/bash

echo "¿Desea que el usuario tenga un subgrupo ya creado?"
read -r -p "[Yy] / [Nn] => " op

if [[ $op =~ [Yy] ]]; then
    echo "Callo en el yes pa"
    
elif [[ $op =~ [Nn] ]]; then
    echo "Le diste a no pa"
    
else
    echo -e "\033[4;35mEl usuario especificado ya existe\e[0m"
fi