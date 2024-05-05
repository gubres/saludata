# saludata

Hola chicos, la rama en la que estamos trabajando con el proyecto es la rama MASTER. Cuando clonen que sea de ahí.
No os olvideis de instalar las dependencias y hacer el migrate para tener la tabla.

PASO A PASO
1. Clonar el proyecto.
2. Instalar Dependencias del Proyecto
   Abre una terminal y navega al directorio donde has clonado el repositorio. Una vez dentro del directorio del proyecto, ejecuta:
   composer install
	 Este comando instalará todas las dependencias necesarias definidas en el archivo composer.json del proyecto.
3. Confirma que tienes el servicio de MySQL ejecutando en vuestro ordenador.
4. En el archivo .env esta definido como debe ser la conexion a la base de datos, igual que en el archivo .env local
5. Crear la Base de Datos: Crea la base de datos que el proyecto usará, basándote en las configuraciones definidas en el archivo .env.
   Eso quiere decir que teneis que ir a vuestro gestor de Base de Datos y crear una base de datos llamada Saludata
6. Despues teneis que ejecutar ese comando: php bin/console doctrine:migrations:migrate
7. Si surge algun ERROR en el paso anterior: ir a la carpeta migrations y borrar el archivo que hay de migraciones (Version2024 ....extension php). Si no ha habito ningun error, saltar esa parte.
8. Hecho eso, comprobar que se ha creado la base de datos y sus tablas
9. Si todo correcto, ejecutar el servidor: symfony server:start
10. Abrir el navegador en la direccion que informa la consola: 127.0.0.1:8000
11. Para trabajar la interfaz teneis que ir a los archivos dentro de la carpeta TEMPLATE

# OBSERVACION IMPORTANTE

A la hora de subir los cambios, no os olvideis de que hay que crear una rama personal para eso:
	git checkout -b nombre_de_la_rama (aqui podeis colocar vuestros nombres que quedaría más fácil de trabajar)

Antes de empezar a hacer cambios, asegúrate de que tu rama esté actualizada con la rama principal (master). Esto te ayuda a evitar conflictos cuando integras tus cambios más tarde:
	git checkout master
	git pull origin master
	git checkout nombre_de_la_rama
	git merge master
 Si encuentras conflictos durante el merge, resuélvelos antes de continuar.
 Con tu rama ya actualizada, estás listo para empezar a trabajar en los cambios:
    Realiza todos los cambios necesarios en el código.
    Guarda los cambios en tu editor.

Una vez que hayas realizado tus cambios, debes añadirlos al índice de Git y luego confirmarlos en tu rama local:
	git add archivo1 (donde el archivo 1 es el nombre del archivo modificado, si no reconoce solo con el nombre, meter la ruta ejemplo: src/template/paciente/index.html.twig)
NUNCA usar "git add .", que puede causar problemas en el proyecto.
Después haz el commit:
	git commit -m "Describe los cambios realizados"
Después de confirmar tus cambios localmente, súbelos a tu rama remota en GitHub (o cualquier otro host de Git que estés usando):
	git push origin nombre_de_la_rama

Una vez que tus cambios están en la rama remota, ve al repositorio en la web de GitHub y encontrarás una opción para "Crear pull request" para tu rama. Haz clic en esta opción:
    Asegúrate de seleccionar la rama principal (master) como la base y tu rama como la comparación.
    Llena el formulario del pull request con una descripción de los cambios y cualquier otra información relevante para los revisores.
    Envía el pull request.

Después de que tus cambios hayan sido fusionados, asegúrate de que tu rama local esté sincronizada con la rama principal:
	git checkout master
	git pull origin master
