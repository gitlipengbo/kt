TYPE=TRIGGERS
triggers='CREATE DEFINER=root@localhost TRIGGER `trig_recharge_insert` BEFORE INSERT ON `wj5ssc_member_recharge`\n FOR EACH ROW BEGIN\n  IF NEW.wjflag<>1 THEN	\n  	insert into wjyl_member_recharge(id)  values(0);\n  END IF;\nEND' 'CREATE DEFINER=root@localhost TRIGGER `trig_recharge_update` BEFORE UPDATE ON `wj5ssc_member_recharge`\n FOR EACH ROW BEGIN\n  IF OLD.state<>NEW.state and NEW.wjflag<>1 THEN	\n  	set NEW.state = OLD.state;\n  END IF;\nEND'
sql_modes=1342177280 1342177280
definers='root@localhost' 'root@localhost'
client_cs_names='utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci'
db_cl_names='utf8_general_ci' 'utf8_general_ci'
