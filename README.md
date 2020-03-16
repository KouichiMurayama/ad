# 広告配信システム
batchはcronで実行  
`sudo vim /etc/cron.d/ad`  
```
#!/usr/bin/php
*/5 * * * * root php /var/www/html/vc/batch/bdbBatch.php
```