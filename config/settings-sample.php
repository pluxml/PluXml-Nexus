<?php 
/**
 * NEXUS application global settings
 * @author Pedro CADETE <pedro@hyperion-web.fr>
 * @link https://ressources.pluxml.org
 */

const DEBUG = TRUE;

const DB_HOST = 'localhost';
const DB_DBNAME = '';
const DB_CHARSET = 'utf8';
const DB_PORT = '3306';
const DB_USER = '';
const DB_PASSWORD = '';

const MAIL_PROVIDER = ''; // set 'smtp' to use SMTP host and authentification otherwise set empty ('') to use the PHP function mail()
const MAIL_SMTP_HOST = '';
const MAIL_SMTP_USERNAME = '';
const MAIL_SMTP_PASSWORD = '';
const MAIL_SMTP_PORT = '';

const MAIL_FROM = 'p3ter@pluxml.org';
const MAIL_FROM_NAME = 'Pluxml.org';
const MAIL_NEWUSER_SUBJECT = 'Welcome to PluXml Nexus';
const MAIL_NEWUSER_BODY = 'To complete your signup and be able to login to <a href="https://ressources.pluxml.org">ressources.pluxml.org</a>, please confirm your email address by clicking the link below<br><br><a href="##TOKEN##">##TOKEN##</a>';