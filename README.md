
# CRUD de Productos – CodeIgniter 4

Aplicación simple para gestionar productos con imagen, construida con **PHP 8.1+**, **CodeIgniter 4**, **MySQL** y **Bootstrap 5**.

## 🔄 Características

- CRUD completo de productos.
- Carga de imagen por producto (se guarda en `public/uploads/`) y reemplazo/borrado seguro al actualizar/eliminar.
- Listado en tarjetas con precio original, precio con descuento y porcentaje.
- Interfaz responsiva con Bootstrap 5.

## 📅 Requisitos previos

- 🐘 PHP **8.1 o superior** (con extensiones **intl** y **mbstring** habilitadas).
- 🛠️ Composer 2.x
- 🐬 MySQL 5.7+ / MariaDB
-  📦 Servidor local (Laragon/XAMPP) o vhost apuntando a `public/`.

## 📚 Instalación
1. Clona el repositorio: En caso de estar usando Laragon, debe clonar el repositorio dentro del `C:\laragon\www\`

```bash
git clone https://github.com/DanteLuque/crud-productos-codeigniter.git
cd danteluque-crud-productos-codeigniter
```
2. Instala dependencias:
```bash
composer install
```
3. Copiar el archivo .env.example y pegar el contenido en un archivo nuevo llamado `.env` en la ruta raíz.

4. Edita en `.env` los valores de conexión:
```bash
database.default.hostname = localhost
database.default.database = productos
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

5.  Crea la base de datos y la tabla:
-   Crea la base `productos` en tu motor (si no existe).
-   Importa el script:
```
app/Database/scripts/base.sql
```
6. Asegúrate de que el directorio de imágenes exista y sea escribible:
```
public/uploads/
```
## 🚀 Ejecución
En caso de estar usando Laragon, ya viene preconfigurado un vhost que apunta a nuestro proyecto, solo debe abrir el navegador y usar esta URL local:
```
http://crud-productos-codeigniter.test
```
> Si cambiaste el nombre de la carpeta después de clonar el repositorio, debe modificar la variable baseURL en `app/Config/App.php` para que coincida con tu URL local

## 🧭 Rutas principales
| Método | Ruta                           | Descripción                       |
|--------|--------------------------------|-----------------------------------|
| GET    | `/`                            | Listar productos                  |
| GET    | `/productos/crear`             | Formulario de creación            |
| GET    | `/productos/editar/{id}`       | Formulario de edición             |
| POST   | `/productos/save_db`           | Guardar nuevo producto            |
| POST   | `/productos/update_db/{id}`    | Actualizar producto               |
| GET    | `/productos/eliminar_db/{id}`  | Eliminar producto (estado actual) |

## 📁 Estructura del proyecto
danteluque-crud-productos-codeigniter/  
``` 
├── .env.example                             # Plantilla de variables de entorno
├── app/
│   ├── Controllers/
│   │   └── ProductoController.php           # Controlador de acciones CRUD
│   ├── Models/
│   │   └── Producto.php                     # Modelo CI4: tabla, primaryKey y allowedFields
│   ├── Views/
│   │   ├── Layouts/                         # Layouts base (header.php, footer.php) 
│   │   └── productos/                       # Vistas de módulo producto
│   └── Database/
│       └── scripts/
│           └── base.sql                     # Script SQL para crear db y estructura inicial
├── public/
│   ├── index.php                            # Front controller de CodeIgniter (punto de entrada de la app)
│   ├── styles/common.css                    # Estilos globales
│   └── uploads/                             # Carpeta destino de imágenes subidas
└── composer.json                            # Dependencias PHP
```
## 📝 Contribución

Si deseas contribuir a este proyecto, por favor:

1.  Haz un fork del repositorio
2.  Crea una rama (`git checkout -b feature/nueva-funcionalidad`)
3.  Realiza tus cambios
4.  Haz commit de tus cambios (`git commit -m 'Añadir nueva funcionalidad'`)
5.  Sube tus cambios (`git push origin feature/amazing-feature`)
6.  Abre un Pull Request