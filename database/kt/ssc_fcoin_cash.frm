TYPE=VIEW
query=select `r`.`id` AS `rid`,`l`.`uid` AS `uid`,`r`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `kt`.`ssc_member_cash` `r` join `kt`.`ssc_coin_log` `l` where ((`l`.`extfield0` = `r`.`id`) and (`r`.`state` = 1) and (`r`.`isDelete` = 0) and (`l`.`liqType` = 106))
md5=97068b728cabc748921163c0af6deda7
updatable=1
algorithm=0
definer_user=root
definer_host=localhost
suid=2
with_check_option=0
timestamp=2018-07-12 10:48:44
create-version=1
source=select r.id rid, l.uid, r.actionTime, l.info, l.liqType, l.fcoin from ssc_member_cash r, ssc_coin_log l where l.extfield0=r.id and r.state=1 and isDelete=0 and l.liqType=106;
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `r`.`id` AS `rid`,`l`.`uid` AS `uid`,`r`.`actionTime` AS `actionTime`,`l`.`info` AS `info`,`l`.`liqType` AS `liqType`,`l`.`fcoin` AS `fcoin` from `kt`.`ssc_member_cash` `r` join `kt`.`ssc_coin_log` `l` where ((`l`.`extfield0` = `r`.`id`) and (`r`.`state` = 1) and (`r`.`isDelete` = 0) and (`l`.`liqType` = 106))
