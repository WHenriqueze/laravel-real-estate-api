# Sistema de Gestión Inmobiliaria (Prueba Técnica)

Este es un proyecto de gestión inmobiliaria desarrollado con Laravel 11. La aplicación permite gestionar propiedades, personas y solicitudes de visita, incluyendo funcionalidades CRUD y soporte para filtros y paginación en los listados.

## Requisitos previos

Asegúrate de tener instalados los siguientes requisitos en tu entorno local:

- PHP >= 8.2
- Composer
- MySQL o cualquier base de datos compatible con Laravel
- Laravel >= 11

## Instalación del Proyecto

Sigue los pasos a continuación para configurar el entorno de desarrollo:

1. **Clonar el repositorio**

   Clona este repositorio en tu máquina local.

   ```bash
   git clone https://github.com/WHenriqueze/laravel-real-estate-api.git
   cd laravel-real-estate-api

2. **Ejecutar Migrations**

   ```bash
    php artisan migrate


3. **Ejecutar Seeder**

    Se registró un usuario para authenticación y generación de token

   ```bash
    php artisan db:seed --class=UserSeeder

   Se crea usuario y password para login y generación de token
   
   User: usuario@dominio.cl
   Password: password



    *** Se utiliza implementan las rutas para API REST (php artisan install:api)

    (Esto tambien integra Sanctum que es un sistema de autenticación liviano para API simples basadas en tokens)

    En base a lo anterior se aplica un login básico para la obtención de token


4. **Pruebas en POSTMAN**

    Se realizan pruebas en postman y se expostar los comandos curl para evidenciar los registros:

    ```bash
    Test Extraídos desde POSTMAN

Login básico (retorna token bearer):

curl --location 'http://127.0.0.1:8000/api/login' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--form 'email="usuario@dominio.cl"' \
--form 'password="password"'

Response:
{
    "data": {
        "attributes": {
            "id": 1,
            "name": "Walter Henriquez",
            "email": "usuario@dominio.cl"
        },
        "token": "2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785"
    }
}

Listado propiedades:

curl --location 'http://127.0.0.1:8000/api/propiedades' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785'

Response:
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "direccion": "avenida 123",
            "ciudad": "Concepción",
            "precio": "10000",
            "description": "descripción ejemplo",
            "created_at": "2024-10-03T16:40:26.000000Z",
            "updated_at": "2024-10-03T16:40:26.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/personas?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/personas?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/personas?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/personas",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}

Crear propiedad:

curl --location 'http://127.0.0.1:8000/api/propiedades' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--form 'direccion="avenida 123"' \
--form 'ciudad="Concepción"' \
--form 'precio="10000"' \
--form 'description="descripción ejemplo"'

Obtener detalle de propiedad:

curl --location 'http://127.0.0.1:8000/api/propiedades/1' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785'

Response:
{
    "id": 1,
    "direccion": "avenida 123",
    "ciudad": "Concepción",
    "precio": "10000",
    "description": "descripción ejemplo",
    "created_at": "2024-10-03T16:40:26.000000Z",
    "updated_at": "2024-10-03T16:40:26.000000Z"
}

Actualizamos propiedad:

curl --location --request PUT 'http://127.0.0.1:8000/api/propiedades/1' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--data-urlencode 'direccion="avenida 1234"' \
--data-urlencode 'ciudad="Tomé"' \
--data-urlencode 'precio="9999"' \
--data-urlencode 'description="descripción ejemplo"'

Response:
{
    "id": 1,
    "direccion": "avenida 1234",
    "ciudad": "Tomé",
    "precio": "9999",
    "description": "descripción ejemplo",
    "created_at": "2024-10-03T16:40:26.000000Z",
    "updated_at": "2024-10-03T16:43:45.000000Z"
}

Eliminamos Propiedad:

curl --location --request DELETE 'http://127.0.0.1:8000/api/propiedades/1' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:
{
    "message": "Propiedad eliminada correctamente"
}

Listado personas:

curl --location 'http://127.0.0.1:8000/api/personas' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "nombre": "walter henriquez",
            "email": "walter.henriqueze@gmail.com",
            "telefono": "987654321",
            "created_at": "2024-10-03T16:46:56.000000Z",
            "updated_at": "2024-10-03T16:46:56.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/personas?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/personas?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/personas?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/personas",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}

Crear persona: 

curl --location 'http://127.0.0.1:8000/api/personas' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--form 'nombre="walter henriquez"' \
--form 'email="walter.henriqueze@gmail.com"' \
--form 'telefono="987654321"'

Response:

{
    "nombre": "walter henriquez",
    "email": "walter.henriqueze@gmail.com",
    "telefono": "987654321",
    "updated_at": "2024-10-03T16:46:56.000000Z",
    "created_at": "2024-10-03T16:46:56.000000Z",
    "id": 1
}

Obtener detalle persona:

curl --location 'http://127.0.0.1:8000/api/personas/1' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:

{
    "id": 1,
    "nombre": "walter henriquez",
    "email": "walter.henriqueze@gmail.com",
    "telefono": "987654321",
    "created_at": "2024-10-03T16:46:56.000000Z",
    "updated_at": "2024-10-03T16:46:56.000000Z"
}

Actualizamos persona:

curl --location --request PUT 'http://127.0.0.1:8000/api/personas/1' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--data-urlencode 'nombre=walter' \
--data-urlencode 'email=otro@mail.cl' \
--data-urlencode 'telefono=987654321'

Response:

{
    "id": 1,
    "nombre": "walter",
    "email": "otro@mail.cl",
    "telefono": "987654321",
    "created_at": "2024-10-03T16:46:56.000000Z",
    "updated_at": "2024-10-03T16:50:28.000000Z"
}

Eliminamos persona:

curl --location --request DELETE 'http://127.0.0.1:8000/api/personas/1' \
--header 'Authorization: Bearer 2|PMrMhruz2CB49dWxAmldjn2UtRUVfGkyJ3nxldRw835d4785' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:
{
    "message": "Persona eliminada correctamente"
}

Listado Solicitudes de Visita:

curl --location 'http://127.0.0.1:8000/api/solicitudes' \
--header 'Authorization: Bearer 2|qAH1ufVlu5vKKoGhHvA9CVja41h5otmwyChgfHl61eafcc36' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:

{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "fecha_visita": "2024-10-03",
            "comentarios": "solicitar llaves en conserjería",
            "created_at": "2024-10-03T17:39:24.000000Z",
            "updated_at": "2024-10-03T17:39:24.000000Z",
            "persona_id": 1,
            "propiedad_id": 1,
            "persona": {
                "id": 1,
                "nombre": "walter henriquez",
                "email": "walter.henriqueze@gmail.com",
                "telefono": "987654321",
                "created_at": "2024-10-03T16:46:56.000000Z",
                "updated_at": "2024-10-03T16:50:28.000000Z"
            },
            "propiedad": {
                "id": 1,
                "direccion": "avenida central",
                "ciudad": "Tomé",
                "precio": 1000,
                "description": "descripcion",
                "created_at": "2024-10-03T16:40:26.000000Z",
                "updated_at": "2024-10-03T16:43:45.000000Z"
            }
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/solicitudes?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/solicitudes?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/solicitudes?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/solicitudes",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}

Creamos Solicitud de Visita:

curl --location 'http://127.0.0.1:8000/api/solicitudes' \
--header 'Authorization: Bearer 2|qAH1ufVlu5vKKoGhHvA9CVja41h5otmwyChgfHl61eafcc36' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--form 'persona_id="1"' \
--form 'propiedad_id="1"' \
--form 'fecha_visita="2024-10-03"' \
--form 'comentarios="solicitar llaves en conserjería"'

Response:
{
    "persona_id": "1",
    "propiedad_id": "1",
    "fecha_visita": "2024-10-03",
    "comentarios": "solicitar llaves en conserjería",
    "updated_at": "2024-10-03T17:39:24.000000Z",
    "created_at": "2024-10-03T17:39:24.000000Z",
    "id": 1
}

Obtener detalle persona:

curl --location 'http://127.0.0.1:8000/api/solicitudes/1' \
--header 'Authorization: Bearer 2|qAH1ufVlu5vKKoGhHvA9CVja41h5otmwyChgfHl61eafcc36' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:

{
    "id": 1,
    "persona_id": "1",
    "propiedad_id": "1",
    "fecha_visita": "2024-10-03",
    "comentarios": "solicitar llaves en conserjería",
    "updated_at": "2024-10-03T17:39:24.000000Z",
    "created_at": "2024-10-03T17:39:24.000000Z"
}

Actualizamos visita:

curl --location --request PUT 'http://127.0.0.1:8000/api/solicitudes/1' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer 2|qAH1ufVlu5vKKoGhHvA9CVja41h5otmwyChgfHl61eafcc36' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D' \
--data-urlencode 'persona_id="1"' \
--data-urlencode 'propiedad_id="1"' \
--data-urlencode 'fecha_visita="2024-10-05"' \
--data-urlencode 'comentarios="se actualiza fecha"'

Response:

{
    "id": 1,
    "persona_id": "1",
    "propiedad_id": "1",
    "fecha_visita": "2024-10-05",
    "comentarios": "se actualiza fecha",
    "updated_at": "2024-10-03T17:39:24.000000Z",
    "created_at": "2024-10-03T17:45:51.000000Z"
}

Eliminamos solicitud:

curl --location --request DELETE 'http://127.0.0.1:8000/api/solicitudes/1' \
--header 'Authorization: Bearer 2|qAH1ufVlu5vKKoGhHvA9CVja41h5otmwyChgfHl61eafcc36' \
--header 'Cookie: XSRF-TOKEN=eyJpdiI6IktnM1RjVDhOUzllbFhRNU9PME5LUkE9PSIsInZhbHVlIjoiNzQ1VWxDVm5HWDdJQjdISGRRSXd6aEFUMlE4UGpSb294ZVQrZElzQ0hpNGp5c0VtRG9hSjBMUlBqR2hiNkxpZHpIc1Z4d3JybVUrK1FoeVdNZHNUeTMrWEZBQk9IdzJwZzBTM25ZRFdON0VzV3BXa2QycERjd0xyUHdSY0FyZVUiLCJtYWMiOiIzN2VjY2M5ODI1NWIyNTEyOTVhNWVjZTk3YjM2Yzk5ZjYzNTRlNTgzOWQ3M2RjODA5NzZjMjljZjQyYmU2OTJkIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlJURVJYYTR5c3lLeTNjUUlSRktpR0E9PSIsInZhbHVlIjoieHRWT3daM3EzQ1IzZ1dYZWhxSGlXc1J2TUE1WVRGWERkU2dBSE54Q3lNZHA2YTE0bm13cEdHb0Q5d2d2dnFsZlBWS003b0dPVFhmWkh1d3NzaldOSXBBNGkxWXFyTDAyaXNHSTQ0STBVZjhyc054eHdUWHRoZnRnZVlyWHV5YUwiLCJtYWMiOiI5YzJmZDU3NDY2NWE4NTcwMGE3MzhiOGI1ZDE0Y2JkNWQ0OTBmYzIyZDM3N2I2Y2EyYTQ4NWMyOTM3NzYxNzk2IiwidGFnIjoiIn0%3D'

Response:
{
    "message": "Solicitud de visita eliminada correctamente"
}
    
