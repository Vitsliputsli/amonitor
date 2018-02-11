<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
//Folder that should be translated
    'sourcePath'=>'/srv/http/monitor/web',
//Example: /srv/www/<wbr />htdocs/public/testapp/protected/
 
    'messagePath'=>'/srv/http/monitor/web/messages',
//Example: /srv/www/htdocs/public/testapp/protected/messages
    'languages'=>array('ru'),
    'fileTypes'=>array('php'),
    'overwrite'=>true,
    'exclude'=>array(
        '.svn',
        '.gitignore',
        'yiilite.php',
        'yiit.php',
        '/i18n/data',
        '/messages',
        '/vendors',
        '/web/js',
    ),
);
