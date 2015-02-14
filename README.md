Program Description
-------------------
This is a web crm program developed and designed by **Peter Petropoulos**.  It has been published in 2012 and has been written in PHP and javascript. This database has been customised for legal services in Greece, so it containts:
* person attributes in **attributes** table
* legal matter types in **casetype**
* courts categories in **categories**
* courts in table **courts**
* legal documents templates in **doctypes**
* inland revenues in table **doh**
* task types in **proceduretypes**
* protocol send types in **sendtype**
* task status in **status** table
* legal matter descriptions in **thesaurus**

You can alter all described table contents to be to modified for any professional.

WebCRM Installation
-------------------
WebCRM needs mysql5.1 with php5 and a web server. It does not tested with mssql or oracle db. The tested web browsers are Mozilla Firefox and Google Chrome. I don't know any incompatibilities with other browsers, but maybe exist with IE or Safari.
* Put the folder webcrm in your webroot directory
* Create a database and import the **webcrmv2.sql** from install directory. It's safe to delete folder install after import.
* In the root folder the **config.php** has the database connection settings
* Username admin password admin and another user exist with username user and password user
* You can choose your working theme changing the jquery-ui.custom.css in css folder

>For more information about my wokrs visit my site  [Petros Petropoulos](http:.//petrospe.org) 