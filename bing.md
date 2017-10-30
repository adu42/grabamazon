###mysql主从配置

    create user repl;
    grant file on *.* to repl@'192.168.1.%' IDENTIFIED by 'mysql';
    grant replication slave on *.* to repl@'192.168.1.%' IDENTIFIED by 'mysql';
    FLUSH PRIVILEGES;

加配置master，加下面的代码并且重启。
   
    server-id = 1
    log-bin=mysql-bin

查看master/SLAVE日志坐标和状态：

    SHOW MASTER STATUS\G;
    SHOW SLAVE STATUS\G;

配置slave

    server-id = 2
    log-bin=mysql-bin
    binlog-do-db = follow
    relay_log = mysql-relay-bin
    log_slave_updates =1
    
启动slave方式，用sql语句去做：

    CHANGE MASTER TO MASTER_HOST='192.168.1.72',
           MASTER_USER='repl',
           MASTER_PASSWORD='mysql',
           MASTER_LOG_FILE='mysql-bin.000001',
           MASTER_LOG_POS=0;
    start slave;
    
如果有变更，先stop slave;
SHOW SLAVE STATUS\G sql语句可以查看到错误缘由。

    create database vuelaravel;
    grant all on vuelaravel.* to vuelaravel@'%' IDENTIFIED by 'vuelaravel';
    grant all on vuelaravel.* to vuelaravel@'localhost' IDENTIFIED by 'vuelaravel';
    FLUSH PRIVILEGES;



      $numberPettn = '/^[1-9]\d*/';


验证码识别？

    https://github.com/tesseract-ocr/tesseract/wiki
    https://github.com/thiagoalessio/tesseract-ocr-for-php


1. 识别验证码还需要测试，一般过一天可以继续抓数据，商品数据失败的概率有点，其他还好，sleep时间可以再长一点。
2. 抓目标分类和抓特定类目商品，让抓取分析更及时有效 ***
3. 分布式抓取，程序可以放在多台服务器上，怎么做成mysql主从数据？ **
  是否需要用远程服务器作为最终主节点？内网。1.2两个网关不能联通。
  
过滤规则说明：
0 css规则，就使用css Selector选择器选择css标识的dom内容，返回新的crawler
1  字符标识  指内容里包含那些字符，就保留本块
2  提取规则 指正则匹配规则，或者用简单描述a(*)b分割取(*)区域的内容,先设置1字符标识，已免全局去搜


mysqldump -uroot -p grabamazon>grabamazon.sql
grabamazon

自动挂载尺码、颜色、属性等资料，产品集中管理

pull 被拒：git shell到本目录
git pull origin master --allow-unrelated-histories

大文件处理，先删除，超过100M提交不上去
git rm --cached grabamazon.sql
git commit --amend -CHEAD

跳过大文件了吗？