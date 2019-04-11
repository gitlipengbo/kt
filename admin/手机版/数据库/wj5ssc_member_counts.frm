TYPE=VIEW
query=select `l`.`uid` AS `uid`,`l`.`username` AS `username`,date_format(from_unixtime(`l`.`actionTime`),\'%Y-%m-%d\') AS `actionDate`,ifnull(sum((case when (`l`.`typea` = 1) then `l`.`coin` end)),0) AS `rechargeAmount`,ifnull(sum((case when (`l`.`typea` = 2) then `l`.`fcoin` end)),0) AS `cashAmount`,ifnull(sum((case when (`l`.`typea` = 3) then `l`.`coin` end)),0) AS `betAmount`,ifnull(sum((case when (`l`.`typea` = 4) then `l`.`coin` end)),0) AS `delAmount`,ifnull(sum((case when (`l`.`typea` = 5) then `l`.`coin` end)),0) AS `zjAmount`,ifnull(sum((case when (`l`.`typea` = 6) then `l`.`coin` end)),0) AS `fanDianAmount`,ifnull(sum((case when (`l`.`typea` = 7) then `l`.`coin` end)),0) AS `brokerageAmount` from `caipiaopindao`.`wj5ssc_coin_log` `l` group by `l`.`uid`,`l`.`username`,date_format(from_unixtime(`l`.`actionTime`),\'%Y-%m-%d\')
md5=42cd7bafa578fc4b9d2632247e3c158d
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2016-06-21 09:49:06
create-version=1
source=select l.uid,l.username,date_format(from_unixtime(l.actionTime), \'%Y-%m-%d\') actionDate,IFNULL(sum(case when l.typea=1 then l.coin end),0) rechargeAmount,IFNULL(sum(case when l.typea=2 then l.fcoin end),0) cashAmount,IFNULL(sum(case when l.typea=3 then l.coin end),0) betAmount,IFNULL(sum(case when l.typea=4 then l.coin end),0) delAmount,IFNULL(sum(case when l.typea=5 then l.coin end),0) zjAmount,IFNULL(sum(case when l.typea=6 then l.coin end),0) fanDianAmount,IFNULL(sum(case when l.typea=7 then l.coin end),0) brokerageAmount  from wj5ssc_coin_log l group by l.uid,l.username,FROM_UNIXTIME(l.actionTime, \'%Y-%m-%d\');
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `l`.`uid` AS `uid`,`l`.`username` AS `username`,date_format(from_unixtime(`l`.`actionTime`),\'%Y-%m-%d\') AS `actionDate`,ifnull(sum((case when (`l`.`typea` = 1) then `l`.`coin` end)),0) AS `rechargeAmount`,ifnull(sum((case when (`l`.`typea` = 2) then `l`.`fcoin` end)),0) AS `cashAmount`,ifnull(sum((case when (`l`.`typea` = 3) then `l`.`coin` end)),0) AS `betAmount`,ifnull(sum((case when (`l`.`typea` = 4) then `l`.`coin` end)),0) AS `delAmount`,ifnull(sum((case when (`l`.`typea` = 5) then `l`.`coin` end)),0) AS `zjAmount`,ifnull(sum((case when (`l`.`typea` = 6) then `l`.`coin` end)),0) AS `fanDianAmount`,ifnull(sum((case when (`l`.`typea` = 7) then `l`.`coin` end)),0) AS `brokerageAmount` from `caipiaopindao`.`wj5ssc_coin_log` `l` group by `l`.`uid`,`l`.`username`,date_format(from_unixtime(`l`.`actionTime`),\'%Y-%m-%d\')
