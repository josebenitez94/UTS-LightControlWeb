# UTS-LightControlWeb

_Este repositorio se crea con el fin de llevar el almacenamiento y desarrollo del proyecto de Grado LightControl para optar por el titulo de Ingeniero Electronico de un cliente. El dispositivo consta de un hardware diseñado y desarrollado + firmware que permite la lectura de tarjetas RFID y que llevan el control del encendido-apagado de las luces de las UNIDADES TECNOLOGICAS DE SANTANDER_ con tecnologías web PHP, Javascript y MySQL.

### Pre-requisitos 📋

* [Instalar XAMPP para Windows](https://www.apachefriends.org/xampp-files/8.0.9/xampp-windows-x64-8.0.9-0-VS16-installer.exe)
* [Configuraciones XAMPP para acceso local] https://www.youtube.com/watch?v=puq0tb2xjUA&ab_channel=xCraash
* Descargar e instalar proyecto en xampp/htdocs
* Importar Base de Datos en Gestor MySql y habilitar usuario root
* Subir servicios Apache y MySql
* Utilizar a la par el proyecto [UTS-LightControlESP32](https://github.com/josebenitez94/UTS-LightControl)

## Ejecutando las pruebas ⚙️
* Entrar a http://IP_SERVER:PORT/UTS-LightControlWeb :: si esto funciona es porque el servicio se encuentra en linea de forma satisfactoriamente
* Agregar un usuario con su respectiva tarjeta
* Descargar y usar el hardware para probar que efectivamente se suban las ordenes

## PAGINAS WEB VISIBLES 📋
* http://IP_SERVER:PORT/UTS-LightControlWeb :: Pagina principal donde:
_Agregar usuarios_
_Enlazar Tarjetas NFC_
_Agregar Salon de Clases_
* http://IP_SERVER:PORT/UTS-LightControlWeb/salones.php :: tabla con reporte web de registros
* http://IP_SERVER:PORT/UTS-LightControlWeb/php/visualizar_pdf.php :: tabla exportada como PDF de registros

__

## Construido con 🛠️

* [Visual Studio](https://visualstudio.microsoft.com/es/) - Herramienta Editor por Excelencia para Desarrolladores
* [XAMPP](https://www.apachefriends.org/es/index.html) - Software servidor con dependencias de apache + mySQL

## Versionado 📌

Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/josebenitez94/UTS-LightControlWeb/tags).

## Autores ✒️

* **Jose Benítez** - *Ingeriero Electronico y Tecnólogo en Desarrollo de Sistemas Informáticos* - [josebenitez94](https://github.com/josebenitez94)

## Licencia 📄

Este proyecto está bajo la Licencia GPT 2.0

---
⌨️ con ❤️ por [josebenitez94](https://github.com/josebenitez94) 😊
