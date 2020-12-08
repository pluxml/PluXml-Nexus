<p align="center">
    <img src="https://www.pluxml.org/themes/pluxml-org-1.0/img/plx-logo-bleu.png" />
    <h1 align="center">PluXml Nexus</h1>
</p>

<p align="center">
    <a href="https://www.pluxml.org/download/pluxml-latest.zip"><img src="https://badgen.net/github/release/pluxml/pluxml" /></a>
    <a href="https://github.com/pluxml/PluXml/blob/master/readme/LICENSE"><img src="https://badgen.net/badge/license/GPL/green" /></a>
    <a href="https://twitter.com/pluxml"><img src="https://badgen.net/twitter/follow/pluxml" /></a>
</p>

<p align="center">Ressources center for PluXml.org</p>

Pre-requisite
----------------------------
* Php 7.3
* Mariadb
* Composer

Installation
----------------------------

Create a database and a specific user with the appropriate rights.
Clone the project :
```shell
git clone https://github.com/pluxml/PluXmlNexus
```
Install the dependencies :
```shell
composer install
```
Copy and edit settings.php
```shell
cp config/settings-sample.php 
vim config/settings.php
```
Access PluXml Nexus and create a user.

Change this user role with "admin" using SQL.
```sql
UPDATE mydatabase.users
SET `role`='admin'
WHERE id=1;
```