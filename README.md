
## Ejecución del Proyecto

### **Requisitos Previos:**
- Tener instalado **PHP** y **Composer**.

### **Pasos para Ejecutar el Proyecto:**

1. **Instalar dependencias:**
   Ejecutar el siguiente comando para instalar las dependencias del proyecto:
   ```bash
   composer install
   ```

2. **Configurar el archivo de entorno:**
   Renombrar el archivo `.env.example` a `.env`:
   ```bash
   mv .env.example .env
   ```

3. **Configurar la base de datos SQLite:**
   Reemplazar la línea `/path/to/database/database.sqlite` en el archivo `.env` por la ruta exacta del archivo de la base de datos:
   ```env
   DB_DATABASE=/absolute/path/to/your/project/database/database.sqlite
   ```
   Asegúrate de que el archivo `database.sqlite` exista en la carpeta `database`.

4. **Iniciar el servidor:**
   Ejecutar el siguiente comando para correr el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

5. **Ruta base de la API:**
   La ruta base para los productos es `http://localhost:8000/api/products/`.

   ### Métodos disponibles:

   - **GET**: Listar todos los productos.
     ```bash
     GET http://localhost:8000/api/products/
     ```

   - **GET**: Obtener un producto específico por su `id`.
     ```bash
     GET http://localhost:8000/api/products/:id
     ```

   - **POST**: Crear un nuevo producto.
     ```bash
     POST http://localhost:8000/api/products/
     ```

   - **PUT**: Actualizar un producto existente por su `id`.
     ```bash
     PUT http://localhost:8000/api/products/:id
     ```

   - **DELETE**: Eliminar un producto existente por su `id`.
     ```bash
     DELETE http://localhost:8000/api/products/:id
     ```


## Decisiones

- Se está utilizando **SQLite** como base de datos para facilitar la ejecución y configuración del proyecto. Se ha optado por el enfoque **Database First**, lo que permite generar las migraciones y modelos a partir de una base de datos existente.

- Se mantiene la estructura que proporciona Laravel por defecto, con la adición de una carpeta **Services**. Esta carpeta tiene como propósito separar la lógica de negocio del controlador, permitiendo que los controladores se centren únicamente en gestionar las respuestas HTTP.

- Dado que era necesario validar los datos en múltiples ocasiones dentro del servicio, se creó una función privada llamada `validateRequest`. Esta función encapsula la lógica de validación y, en caso de error, lanza una excepción que será capturada y manejada por el controlador.

- Para el manejo de errores en los servicios, se optó por lanzar **excepciones** simples. De esta manera, el controlador es el responsable de manejar los errores y definir el flujo de respuesta adecuado según el contexto.