aMonitor
--------


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


CONFIGURATION
-------------

### Database

Edit the files `config/db-*.php` with real data.

**NOTES:**
- App won't create the databases for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Don't forget change params.php after new databases added.


SYNCHRONIZATION
---------------
For items values updating You must run synchronization script, there are 2 ways:

Command: 
```code
php yii monitor/update
```

Web:
```code
http://localhost/monitor/web/update
http://monitor.domain.ru/update
```

ALERTS
------
For information persons You must write correct e-mail data for mailer in config/params.php