<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Minimal application constants: config/settings.php is not versioned and is
// only used by the web entry point, not by the test suite.
$constants = [
    'DEBUG'               => false,
    'DIR_DOWNLOAD'        => '/datas',
    'DIR_TMP'             => '/datas/tmp',
    'DIR_PLUGINS'         => '/datas/plugins',
    'DIR_THEMES'          => '/datas/themes',
    'PLUGINS_MAX_SIZE'    => '10MB',
    'THEMES_MAX_SIZE'     => '10MB',
    'DB_HOST'             => 'localhost',
    'DB_PORT'             => '3306',
    'DB_DBNAME'           => 'plxnexus',
    'DB_CHARSET'          => 'utf8',
    'DB_USER'             => '',
    'DB_PASSWORD'         => '',
    'MAIL_PROVIDER'       => '',
    'MAIL_SMTP_HOST'      => '',
    'MAIL_SMTP_USERNAME'  => '',
    'MAIL_SMTP_PASSWORD'  => '',
    'MAIL_SMTP_PORT'      => '465',
    'MAIL_SMTP_SECURITY'  => 'ssl',
    'MAIL_FROM'           => 'noreply@example.test',
    'MAIL_FROM_NAME'      => 'PluXml Nexus',
    'MAIL_NEWUSER_SUBJECT' => 'Welcome',
    'MAIL_NEWUSER_BODY'   => 'Hello ##USERNAME##: ##TOKEN##',
    'MAIL_LOSTPASSWORD_SUBJECT' => 'Lost password',
    'MAIL_LOSTPASSWORD_BODY'    => 'Reset: ##URL_PASSWORD## (##URL_EXPIRY##h)',
];

foreach ($constants as $name => $value) {
    if (!defined($name)) {
        define($name, $value);
    }
}
