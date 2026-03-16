# 📚 Book Search Service

Proyecto realizado como **prueba técnica** que implementa un
**webservice en PHP** capaz de buscar libros y autores a partir de un
fichero `dataset.json`.

El servicio devuelve los resultados en formato **JSON**, separando los
resultados en dos arrays:

-   libros encontrados
-   autores encontrados

Además, para cada autor se incluyen **sus dos últimos libros**,
ordenados por fecha de publicación.

------------------------------------------------------------------------

# 🧱 Arquitectura del proyecto

El proyecto se ha desarrollado utilizando **Laravel**, lo que permite
estructurar correctamente el backend y añadir fácilmente rutas,
controladores y tests.

BookSearch │ ├── app/ │ └── Http/ │ └── Controllers/ │ └──
SearchController.php │ ├── routes/ │ ├── api.php │ └── web.php │ ├──
resources/ │ └── views/ │ └── search.blade.php │ ├── tests/ │ └──
Feature/ │ ├── dataset.json │ └── README.md

------------------------------------------------------------------------

# 🚀 Instalación del proyecto

## Requisitos

-   PHP \>= 8.1
-   Composer
-   Git

## Clonar el repositorio

git clone https://github.com/InakiGalanDev/BookSearch.git cd BookSearch

## Instalar dependencias

composer install

## Iniciar el servidor

php artisan serve

Abrir en el navegador:

http://127.0.0.1:8000

------------------------------------------------------------------------

# 🔌 API Endpoint

### GET /api/search?texto={texto}

Permite buscar coincidencias por:

-   título del libro
-   nombre del autor

Ejemplo:

http://127.0.0.1:8000/api/search?texto=jorge

------------------------------------------------------------------------

# 📚 Últimos libros del autor

Para cada autor encontrado se incluyen **sus dos últimos libros**,
ordenados por el campo `fecha_nov` de forma descendente.

Ejemplo de respuesta:

{ "books": \[\], "authors": \[ { "nombre": "Jorge Franco", "last_books":
\[ { "titulo": "Libro 1", "fecha_nov": "20200101" }, { "titulo": "Libro
2", "fecha_nov": "20190101" } \] } \] }

------------------------------------------------------------------------

# 🖥️ Interfaz de prueba

Se ha añadido una **vista sencilla utilizando Blade y TailwindCSS** para
facilitar la prueba del servicio desde el navegador.

Disponible en:

http://127.0.0.1:8000

Esta interfaz permite:

-   buscar libros
-   ver autores encontrados
-   visualizar los últimos libros de cada autor

------------------------------------------------------------------------

# 🧪 Tests

Se han incluido **tests automatizados** para verificar el funcionamiento
del endpoint.

Ejecutar:

php artisan test

------------------------------------------------------------------------

# 🛠️ Tecnologías utilizadas

-   PHP
-   Laravel
-   Blade
-   TailwindCSS
-   JavaScript
-   PHPUnit
-   Git / GitHub

------------------------------------------------------------------------

# ⚙️ Decisiones técnicas

Se ha decidido utilizar **Laravel** para estructurar el proyecto por
varias razones:

-   Permite organizar el código mediante **controladores y rutas**
-   Facilita la creación de **endpoints API**
-   Permite añadir **tests automatizados**
-   Proporciona una estructura profesional para el proyecto

Además, al utilizar Laravel se puede mantener **backend y frontend
dentro del mismo proyecto**, evitando realizar peticiones a otros
servicios externos.\
Esto simplifica el despliegue y mejora la seguridad al no depender de
aplicaciones externas.

La vista frontend se ha añadido como una **interfaz sencilla de
demostración** para poder probar el funcionamiento del servicio de forma
visual.
