TYPE=VIEW
query=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`uid` AS `uid`,`b`.`username` AS `username`,`b`.`actionNo` AS `actionNo`,`b`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `kt`.`ssc_coin_log` `l` join `kt`.`ssc_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` between 101 and 102))
md5=21627ebcb01232f17c24b923f0cc8e7b
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-07-12 10:48:44
create-version=1
source=select b.id betId, b.type, b.playedId, b.uid, b.username, b.actionNo, b.actionTime, l.info, l.liqType, l.fcoin from ssc_coin_log l, ssc_bets b where b.id=l.extfield0 and b.isDelete=0 and b.lotteryNo=\'\' and l.liqType between 101 and 102;
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `b`.`id` AS `betId`,`b`.`type` AS `type`,`b`.`playedId` AS `playedId`,`b`.`uid` AS `uid`,`b`.`username` AS `username`,`b`.`actionNo` AS `actionNo`,`b`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `kt`.`ssc_coin_log` `l` join `kt`.`ssc_bets` `b` where ((`b`.`id` = `l`.`extfield0`) and (`b`.`isDelete` = 0) and (`b`.`lotteryNo` = \'\') and (`l`.`liqType` between 101 and 102))
