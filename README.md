# resuelvefc-chewrafa

## Descripción
Resultados de la prueba de Backend para Resuelve Ingeniería

Puedes consultar la siguiente url para ver el proyecto corriendo: [https://resuelvefc-chewrafa.herokuapp.com/](https://resuelvefc-chewrafa.herokuapp.com/). 

Para un correcto funcionamiento, es necesario usar un cliente http como [Postman](https://www.postman.com/downloads) o [Curl](https://curl.se/)

Puedes copiar la carpeta a un servidor web como apache o nginx, y posteriormente visitar la ruta [http://localhost/resuelvefc-chewrafa/](http://localhost/resuelvefc-chewrafa/)

## Estructura del proyecto
    [root]
    |──assets  # carpeta con las imágenes de abajo
    |── docker-compose.yml #configuracion para docker-compose
    |── Dockerfile   #configuracion de docker
    |── helpers.php #libreria con funciones útiles  
    |── index.php  #la magia pasa AQUI ;) 
    |── README.md  #El archivo que estas leyendo


## Requerimientos
1. PHP >= 7
2. Un servidor web (apache, nginx)
3. Un cliente http (Postman, CURL)

## Instalar un servidor web
- [Apache](https://httpd.apache.org/) o [nginx](https://www.nginx.com/) (Linux) 
- [XAMPP](https://www.apachefriends.org/es/index.html) (Windows)
- [MAMP](https://www.mamp.info/en/mac/) (MacOS)
- [docker (opcional)](https://www.docker.com/)

## Instalar/descargar un cliente http

- [Postman](https://www.postman.com/downloads)
- [Curl](https://curl.se/)
## Usando Docker

Para construir la imagen ejecutamos el comando dentro de la carpeta del proyecto: 

`docker build -t resuelvefc-web:latest .`

Una vez terminado el proceso podemos ejecutar el proyecto con el comando: 

`docker run --name resuelvefc-web -p 8000:80 -d resuelvefc-web`

o también

`docker-compose up -d` si queremos configurar un entorno.



## Consultar el servicio

### Usando Postman

1. Añadimos la URL del proyecto.

![1](https://github.com/ChewRafa/backend-resuelvefc/blob/main/assets/01.png?raw=true )

2. Seleccionamos la pestaña body y damos clic en `raw`. Seleccionamos JSON.

3. Introducimos los datos en el area de texto.

![2](https://github.com/ChewRafa/backend-resuelvefc/blob/main/assets/02.png?raw=true )

4. Presionamos `Send` y podemos ver el resultado de la ejecución de nuestra petición.

![3](https://github.com/ChewRafa/backend-resuelvefc/blob/main/assets/03.png?raw=true)


### Usando CURL
`curl --location --request POST 'https://resuelvefc-chewrafa.herokuapp.com/' \
--header 'Content-Type: application/json' \
--data-raw '{
    "jugadores": [
        {
            "nombre": "Juan Perez",
            "nivel": "C",
            "goles": 10,
            "sueldo": 50000,
            "bono": 25000,
            "sueldo_completo": null,
            "equipo": "rojo"
        },
        {
            "nombre": "EL Cuauh",
            "nivel": "Cuauh",
            "goles": 30,
            "sueldo": 100000,
            "bono": 30000,
            "sueldo_completo": null,
            "equipo": "azul"
        },
        {
            "nombre": "Cosme Fulanito",
            "nivel": "A",
            "goles": 7,
            "sueldo": 20000,
            "bono": 10000,
            "sueldo_completo": null,
            "equipo": "azul"},
            {
                "nombre": "El Rulo",
                "nivel": "B",
                "goles": 9,
                "sueldo": 30000,
                "bono": 15000,
                "sueldo_completo": null,
                "equipo": "rojo"
            }
        ]
    }'`