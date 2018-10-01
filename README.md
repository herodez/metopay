# MetoPay

Una aplicacion que integra el servicio de pago PSE de placetopay, desarrollado con las siguiente:

  - PHP
  - Laravel
  - Y bunas intenciones
### Instalación
Clone y instale las dependencias

```sh
$ git clone https://github.com/herodez/metopay.git
$ composer install
> You has been installed something awesome
```
Lugo de la instalación se ejecutan las migraciones 
```sh
$ php artisan migrate
```
### Configuración

Una vez instalado, configure las variables del entorno para ello copia el archivo .env-example a .env, las variables
de entorno person permiten configurar las datos para las persona  vendedor y transporte. 

```sh
$ cp .env-example .env
```

| Variables de entorno  | Descripción  |
| ------ | ------ |
| PLACE_TO_PAY_WSDL | Configura el wsdl para la connecion con el SOAP service |
| PLACE_TO_PAY_IDENTIFICATOR | Identificador dado por placetopay para la connecion conexión |
| PLACE_TO_PAY_TRANS_KE | Transaction key dada por placetopay para la connecion conexión |
| PLACE_TO_PAY_{PERSON_TYPE}_DOCUMENT | Numero de documento |
| PLACE_TO_PAY_{PERSON_TYPE}_DOCUMENT_TYPE | Tipo de documento  |
| PLACE_TO_PAY_{PERSON_TYPE}_DOCUMENT_FIRST_NAME | Primer nomber|
| PLACE_TO_PAY_{PERSON_TYPE}_DOCUMENT_LAST_NAME | Segundo nombre|
| PLACE_TO_PAY_{PERSON_TYPE}_DOCUMENT_EMAIL | Email |

### Configuración de servicios 

Para configurar los servicios que obtiene la lista de bancos y el resultado de las transaciones solo es necesario
configurar en el crontab la siguinte line:

```sh
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

License
----

MIT


**Free Software, Hell Yeah!**