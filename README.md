# 広告配信システム
## 1.batchはcronで実行  
`sudo vim /etc/cron.d/ad`  
```
#!/usr/bin/php
*/5 * * * * root php /var/www/html/vc/batch/bdbBatch.php
```
## 2.クリックログ
クリックログは以下に出力
`logs/click_log`