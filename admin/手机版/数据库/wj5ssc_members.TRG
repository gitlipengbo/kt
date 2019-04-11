TYPE=TRIGGERS
triggers='CREATE DEFINER=root@localhost TRIGGER `trig_members_update` BEFORE UPDATE ON `wj5ssc_members`\n FOR EACH ROW BEGIN\n  IF (OLD.fanDian<>NEW.fanDian or OLD.fanDianBdw<>NEW.fanDianBdw) and OLD.wjflag=NEW.wjflag THEN\n    set NEW.fanDian = OLD.fanDian;\n    set NEW.fanDianBdw = OLD.fanDianBdw;\n  END IF;\n  IF OLD.coin<>NEW.coin and NEW.wjflag<>1 THEN\n    set NEW.coin = OLD.coin;\n  END IF;\n  IF OLD.score<NEW.score and OLD.scoreTotal=NEW.scoreTotal THEN\n    set NEW.score = OLD.score;\n  END IF;\n  \nEND'
sql_modes=1342177280
definers='root@localhost'
client_cs_names='utf8'
connection_cl_names='utf8_general_ci'
db_cl_names='utf8_general_ci'
