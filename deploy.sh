#!/bin/bash

# Función para la subida inicial del proyecto
deploy_from_scratch() {
    echo "Iniciando despliegue desde cero..."

    # Pedir la URL del repositorio
    read -p "Ingresa la URL del repositorio (HTTPS o SSH): " repo_url

    # Pedir el nombre del branch
    read -p "Ingresa el nombre de la rama (branch): " branch_name

    # Clonar el repositorio
    echo "Clonando el repositorio..."
    git clone --branch $branch_name $repo_url

    # Extraer el nombre del repositorio de la URL
    repo_name=$(basename -s .git "$repo_url")

    # Verificar si la carpeta public_html existe y crearla si no
    if [ ! -d "$repo_name/public_html" ]; then
        echo "Creando la carpeta public_html..."
        mkdir "$repo_name/public_html"
    fi

    # Mover el contenido de public a public_html
    echo "Moviendo el contenido de public a public_html..."
    mv "$repo_name/public/"* "$repo_name/public_html/"

    # Crear el enlace simbólico del storage
    echo "Creando enlace simbólico para storage en public_html..."
    ln -s ../storage/app/public "$repo_name/public_html/storage"

    # Confirmación
    echo "Despliegue desde cero completado."
}

# Función para la actualización del proyecto con git pull
update_project() {
    echo "Iniciando actualización del proyecto..."

    # Pedir el nombre del branch
    read -p "Ingresa el nombre de la rama (branch) que quieres actualizar: " branch_name

    # Extraer el nombre del repositorio del directorio actual
    repo_name=$(basename "$PWD")

    # Hacer pull de la rama
    echo "Actualizando el repositorio con git pull..."
    git pull origin $branch_name

    # Mover el contenido actualizado de public a public_html
    echo "Moviendo el contenido actualizado de public a public_html..."
    mv "$repo_name/public/"* "$repo_name/public_html/"

    # Confirmación
    echo "Actualización completada."
}

# Menú de opciones
echo "Selecciona una opción:"
echo "1. Subida del proyecto desde cero"
echo "2. Actualización del proyecto con git pull"
read -p "Elige (1 o 2): " option

# Ejecutar la opción seleccionada
if [ "$option" == "1" ]; then
    deploy_from_scratch
elif [ "$option" == "2" ]; then
    update_project
else
    echo "Opción inválida. Por favor elige 1 o 2."
fi
