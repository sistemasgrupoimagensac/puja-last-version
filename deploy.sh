#!/bin/bash

# Definir colores
RED='\e[31m'
GREEN='\e[32m'
YELLOW='\e[33m'
BLUE='\e[34m'
NC='\e[0m' # Sin color (reset)

# Función para validar la clonación del repositorio y el branch
validate_repo_and_branch() {
    while true; do
        # Pedir la URL del repositorio
        read -p "Ingresa la URL del repositorio (HTTPS o SSH): " repo_url

        # Pedir el nombre del branch
        read -p "Ingresa el nombre de la rama (branch): " branch_name

        # Intentar clonar el repositorio en una carpeta temporal para verificar
        echo -e "${YELLOW}Verificando el acceso al repositorio y rama...${NC}"
        git clone --branch $branch_name $repo_url temp_repo 2> error.log

        # Verificar si hubo un error
        if [ $? -ne 0 ]; then
            echo -e "${RED}Error al clonar el repositorio o la rama. Detalles del error:${NC}"
            cat error.log

            # Preguntar al usuario si quiere volver a intentar ingresar los datos
            read -p "¿Deseas intentar de nuevo? (s/n): " retry
            if [ "$retry" != "s" ]; then
                echo -e "${RED}Abortando despliegue.${NC}"
                exit 1
            fi
        else
            echo -e "${GREEN}Repositorio y rama verificados correctamente.${NC}"
            break
        fi
    done
}

# Función para la subida inicial del proyecto
deploy_from_scratch() {
    echo -e "${BLUE}Iniciando despliegue desde cero...${NC}"

    # Paso 0: Descargar Composer localmente en ~/composer.phar
    echo -e "${YELLOW}Descargando Composer localmente...${NC}"
    curl -sS https://getcomposer.org/installer | php -- --install-dir=$HOME --filename=composer.phar

    # Actualizar Composer a la versión 2 (si es necesario)
    echo -e "${YELLOW}Actualizando Composer a la versión 2...${NC}"
    php ~/composer.phar self-update --2

    # Verificación de la versión de Composer después de la actualización
    echo -e "${YELLOW}Verificando la versión de Composer...${NC}"
    php ~/composer.phar --version

    # Paso 1: Validar el acceso al repositorio y rama
    validate_repo_and_branch

    # Paso 2: Mover el contenido de la carpeta temporal a la raíz, excluyendo deploy.sh
    echo -e "${YELLOW}Moviendo el contenido de la carpeta temporal a la raíz, excluyendo deploy.sh...${NC}"
    rsync -av --exclude='deploy.sh' temp_repo/ ./

    # Eliminar la carpeta temporal
    echo -e "${YELLOW}Eliminando la carpeta temporal...${NC}"
    rm -rf temp_repo error.log

    # Paso 3: Instalar dependencias con Composer
    echo -e "${YELLOW}Instalando dependencias con Composer...${NC}"
    php ~/composer.phar install --no-dev --optimize-autoloader

    # Paso 4: Verificar si la carpeta public_html existe y crearla si no
    if [ ! -d "public_html" ]; then
        echo -e "${YELLOW}Creando la carpeta public_html...${NC}"
        mkdir public_html
    fi

    # Paso 5: Copiar el contenido de public a public_html, incluyendo archivos ocultos
    echo -e "${YELLOW}Copiando el contenido de public a public_html, incluyendo archivos ocultos...${NC}"
    shopt -s dotglob # Permitir copiar archivos ocultos
    cp -r public/* public_html/
    shopt -u dotglob # Deshabilitar el modo dotglob

    # Paso 6: Crear el enlace simbólico para storage
    echo -e "${YELLOW}Creando enlace simbólico para storage en public_html...${NC}"
    ln -s ../storage/app/public public_html/storage

    # Paso 7: Verificar que el archivo .env existe antes de continuar
    while [ ! -f ".env" ]; do
        echo -e "${RED}El archivo .env no se encuentra en la raíz del proyecto.${NC}"
        read -p "¿Ya has agregado el archivo .env en la raíz? (s/n): " response
        if [ "$response" == "s" ]; then
            if [ ! -f ".env" ]; then
                echo -e "${RED}El archivo .env aún no se encuentra en la raíz. Por favor, agrégalo y vuelve a intentarlo.${NC}"
            fi
        else
            echo -e "${YELLOW}Por favor, sube el archivo .env a la raíz del proyecto.${NC}"
        fi
    done

    # Paso 8: Limpiar la caché de configuración
    echo -e "${YELLOW}Limpiando la caché de configuración...${NC}"
    php artisan config:clear

    # Paso 9: Ejecutar las migraciones
    echo -e "${YELLOW}Ejecutando migraciones en producción...${NC}"
    php artisan migrate --force

    # Paso 10: Ejecutar seeders
    echo -e "${YELLOW}Ejecutando seeders en producción...${NC}"
    php artisan db:seed --force

    # Paso 11: Optimizar la aplicación para producción
    echo -e "${YELLOW}Optimizando la aplicación para producción...${NC}"
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    # Confirmación
    echo -e "${GREEN}Despliegue desde cero completado.${NC}"
}

# Función para la actualización del proyecto con git pull
update_project() {
    echo -e "${BLUE}Iniciando actualización del proyecto...${NC}"

    # Pedir el nombre del branch
    read -p "Ingresa el nombre de la rama (branch) que quieres actualizar: " branch_name

    # Hacer pull de la rama
    echo -e "${YELLOW}Actualizando el repositorio con git pull...${NC}"
    git pull origin $branch_name

    # Copiar el contenido actualizado de public a public_html, incluyendo archivos ocultos
    echo -e "${YELLOW}Copiando el contenido actualizado de public a public_html, incluyendo archivos ocultos...${NC}"
    shopt -s dotglob
    cp -r public/* public_html/
    shopt -u dotglob

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
