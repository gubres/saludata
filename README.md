# saludata

Hola chicos, la rama en la que estamos trabajando con el proyecto es la rama MASTER. Cuando clonen que sea de ahí.
No os olvideis de instalar las dependencias y hacer el migrate para tener la tabla.

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
11. 
