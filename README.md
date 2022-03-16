# resuelvefc-chewrafa

## Descripción
Resultados de la prueba de Backend para Resuelve Ingeniería

Puedes consultar la siguiente url para ver el proyecto corriendo: [https://resuelvefc-chewrafa.herokuapp.com/](https://resuelvefc-chewrafa.herokuapp.com/). 

Para un correcto funcionamiento, es necesario usar un cliente http como [Postman](https://www.postman.com/downloads) o [Curl](https://curl.se/)

Puedes copiar la carpeta a un servidor web como apache o nginx, y posteriormente visitar la ruta [http://localhost/resuelvefc-chewrafa/](http://localhost/resuelvefc-chewrafa/)

## Requerimientos
1. PHP >= 7
2. Un servidor web (apache, nginx)
3. Un cliente http (Postman, CURL)

## Instalar un servidor web
- [Apache](https://httpd.apache.org/) o [nginx](https://www.nginx.com/) (Linux) 
- [XAMPP](https://www.apachefriends.org/es/index.html) (Windows)
- [MAMP](https://www.mamp.info/en/mac/) (MacOS)

## Instalar/descargar un cliente http

- [Postman](https://www.postman.com/downloads)
- [Curl](https://curl.se/)


## Consultar el servicio
### Usando CURL
`curl --location --request POST 'http://localhost/resuelvefc-chewrafa/' \--header 'Content-Type: application/json' \--data-raw '{"jugadores" : [  {  "nombre":"Juan Perez","nivel":"C","goles":10,"sueldo":50000,"bono":25000,"sueldo_completo":null,"equipo":"rojo"},{  "nombre":"EL Cuauh","nivel":"Cuauh","goles":30,"sueldo":100000,"bono":30000,"sueldo_completo":null,"equipo":"azul"},{  "nombre":"Cosme Fulanito","nivel":"A","goles":7,"sueldo":20000,"bono":10000,"sueldo_completo":null,"equipo":"azul"
,{  "nombre":"El Rulo","nivel":"B","goles":9,"sueldo":30000,"bono":15000,"sueldo_completo":null,"equipo":"rojo"}]}'`


