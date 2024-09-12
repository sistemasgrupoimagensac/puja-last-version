#!/bin/bash

# Definir colores
RED='\e[31m'
GREEN='\e[32m'
YELLOW='\e[33m'
BLUE='\e[34m'
NC='\e[0m' # Sin color (reset)

# Función para la subida inicial del proyecto
deploy_from_scratch() {
    echo -e "${BLUE}Iniciando despliegue desde cero...${NC}"

    # Pedir la URL del repositorio
    read -p "Ingresa la URL del repositorio (HTTPS o SSH): " repo_url

    # Pedir el nombre del branch
    read -p "Ingresa el nombre de la rama (branch): " branch_name

    # Clonar el repositorio
    echo -e "${YELLOW}Clonando el repositorio...${NC}"
    git clone --branch $branch_name $repo_url

    # Extraer el nombre del repositorio de la URL
    repo_name=$(basename -s .git "$repo_url")

    # Verificar si la carpeta public_html existe y crearla si no
    if [ ! -d "$repo_name/public_html" ]; then
        echo -e "${YELLOW}Creando la carpeta public_html...${NC}"
        mkdir "$repo_name/public_html"
    fi

    # Mover el contenido de public a public_html
    echo -e "${YELLOW}Moviendo el contenido de public a public_html...${NC}"
    mv "$repo_name/public/"* "$repo_name/public_html/"

    # Crear el enlace simbólico del storage
    echo -e "${YELLOW}Creando enlace simbólico para storage en public_html...${NC}"
    ln -s ../storage/app/public "$repo_name/public_html/storage"

    # Ejecutar las migraciones y seeders
    echo -e "${YELLOW}Ejecutando migraciones en producción...${NC}"
    cd "$repo_name"
    php artisan migrate --force

    echo -e "${YELLOW}Ejecutando seeders en producción...${NC}"
    php artisan db:seed --force

    # Confirmación
    echo -e "${GREEN}Despliegue desde cero completado.${NC}"
}

# Función para la actualización del proyecto con git pull
update_project() {
    echo -e "${BLUE}Iniciando actualización del proyecto...${NC}"

    # Pedir el nombre del branch
    read -p "Ingresa el nombre de la rama (branch) que quieres actualizar: " branch_name

    # Extraer el nombre del repositorio del directorio actual
    repo_name=$(basename "$PWD")

    # Hacer pull de la rama
    echo -e "${YELLOW}Actualizando el repositorio con git pull...${NC}"
    git pull origin $branch_name

    # Mover el contenido actualizado de public a public_html
    echo -e "${YELLOW}Moviendo el contenido actualizado de public a public_html...${NC}"
    mv "$repo_name/public/"* "$repo_name/public_html/"

    # Confirmación
    echo -e "${GREEN}Actualización completada.${NC}"
}

# Menú de opciones
echo -e "${BLUE}Selecciona una opción:${NC}"
echo -e "${YELLOW}1. Subida del proyecto desde cero${NC}"
echo -e "${YELLOW}2. Actualización del proyecto con git pull${NC}"
read -p "Elige (1 o 2): " option

# Ejecutar la opción seleccionada
if [ "$option" == "1" ]; then
    deploy_from_scratch
elif [ "$option" == "2" ]; then
    update_project
else
    echo -e "${RED}Opción inválida. Por favor elige 1 o 2.${NC}"
fi
