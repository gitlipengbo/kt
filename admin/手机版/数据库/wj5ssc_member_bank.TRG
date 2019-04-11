TYPE=TRIGGERS
triggers='CREATE DEFINER=root@localhost TRIGGER `trig_bank_update2` BEFORE UPDATE ON `wj5ssc_member_bank`\n FOR EACH ROW BEGIN\n  IF OLD.account<>NEW.account and OLD.wjflag=NEW.wjflag THEN\n    set NEW.account = OLD.account;\n    set NEW.username = OLD.username;\n    \n  END IF;\nEND'
sql_modes=1342177280
definers='root@localhost'
client_cs_names='utf8'
connection_cl_names='utf8_general_ci'
db_cl_names='utf8_general_ci'
