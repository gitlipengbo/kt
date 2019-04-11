TYPE=TRIGGERS
triggers='CREATE DEFINER=root@localhost TRIGGER `trig_bets_insert` BEFORE INSERT ON `wj5ssc_bets`\n FOR EACH ROW BEGIN\n  \n  IF NEW.actionTime>=NEW.kjTime THEN\n     insert into wj5ssc_bets(id)  values(0);\n  END IF;\n  \nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `trig_bets_update` BEFORE UPDATE ON `wj5ssc_bets` FOR EACH ROW BEGIN\n  IF OLD.actionData<>NEW.actionData and OLD.wjflag=NEW.wjflag THEN\n    set NEW.actionData = OLD.actionData;\n  END IF;\n  IF OLD.actionNo<>NEW.actionNo THEN\n    set NEW.actionNo = OLD.actionNo;\n  END IF;\n  IF OLD.fanDian<>NEW.fanDian THEN\n    set NEW.fanDian = OLD.fanDian;\n  END IF;\n  IF OLD.bonusProp<>NEW.bonusProp THEN\n    set NEW.bonusProp = OLD.bonusProp;\n  END IF;\n  IF OLD.actionNum<>NEW.actionNum THEN\n    set NEW.actionNum = OLD.actionNum;\n  END IF;\n  IF OLD.mode<>NEW.mode THEN\n    set NEW.mode = OLD.mode;\n  END IF;\n  IF OLD.beiShu<>NEW.beiShu THEN\n    set NEW.beiShu = OLD.beiShu;\n  END IF;\n  IF OLD.isDelete<>NEW.isDelete and OLD.wjflag=NEW.wjflag THEN\n    set NEW.isDelete = OLD.isDelete;\n  END IF;	\n  \nEND'
sql_modes=1342177280 1342177280
definers='root@localhost' 'root@localhost'
client_cs_names='utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci'
