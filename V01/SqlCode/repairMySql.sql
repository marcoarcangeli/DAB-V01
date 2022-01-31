
-- dadb	
-- dadbv01	
-- information_schema	
-- mysql	
-- performance_schema	
-- phpmyadmin	
-- test
USE mysql;
CHECK TABLE db;

REPAIR TABLE db;
CHECK TABLE db;
-- users table global_priv
-- 
USE mysql;
CHECK TABLE global_priv;

REPAIR TABLE global_priv;
CHECK TABLE global_priv;

USE mysql;

REPAIR TABLE columns_priv	 	     ;
REPAIR TABLE column_stats	 	     ;
REPAIR TABLE db	 	                 ;
REPAIR TABLE event	 	             ;
REPAIR TABLE func	 	             ;
REPAIR TABLE general_log      	     ;
REPAIR TABLE global_priv	 	     ;
REPAIR TABLE gtid_slave_pos	 	     ;
REPAIR TABLE help_category	 	     ;
REPAIR TABLE help_keyword	 	     ;
REPAIR TABLE help_relation	 	     ;
REPAIR TABLE help_topic	 	         ;
REPAIR TABLE index_stats	 	     ;
REPAIR TABLE innodb_index_stats	 	 ;
REPAIR TABLE innodb_table_stats	 	 ;
REPAIR TABLE plugin	 	             ;
REPAIR TABLE proc	 	             ;
REPAIR TABLE procs_priv	 	         ;
REPAIR TABLE proxies_priv	 	     ;
REPAIR TABLE roles_mapping	 	     ;
REPAIR TABLE servers	 	         ;
REPAIR TABLE slow_log	 	         ;
REPAIR TABLE tables_priv	 	     ;
REPAIR TABLE table_stats	 	     ;
REPAIR TABLE time_zone	 	         ;
REPAIR TABLE time_zone_leap_second   ;
REPAIR TABLE time_zone_name	 	     ;
REPAIR TABLE time_zone_transition    ;
REPAIR TABLE time_zone_transition_typ;
REPAIR TABLE transaction_registry	 ;

USE mysql;

CHECK TABLE columns_priv	 	     ;
CHECK TABLE column_stats	 	     ;
CHECK TABLE db	 	                 ;
CHECK TABLE event	 	             ;
CHECK TABLE func	 	             ;
CHECK TABLE general_log      	     ;
CHECK TABLE global_priv	 	     ;
CHECK TABLE gtid_slave_pos	 	     ;
CHECK TABLE help_category	 	     ;
CHECK TABLE help_keyword	 	     ;
CHECK TABLE help_relation	 	     ;
CHECK TABLE help_topic	 	         ;
CHECK TABLE index_stats	 	     ;
CHECK TABLE innodb_index_stats	 	 ;
CHECK TABLE innodb_table_stats	 	 ;
CHECK TABLE plugin	 	             ;
CHECK TABLE proc	 	             ;
CHECK TABLE procs_priv	 	         ;
CHECK TABLE proxies_priv	 	     ;
CHECK TABLE roles_mapping	 	     ;
CHECK TABLE servers	 	         ;
CHECK TABLE slow_log	 	         ;
CHECK TABLE tables_priv	 	     ;
CHECK TABLE table_stats	 	     ;
CHECK TABLE time_zone	 	         ;
CHECK TABLE time_zone_leap_second   ;
CHECK TABLE time_zone_name	 	     ;
CHECK TABLE time_zone_transition    ;
CHECK TABLE time_zone_transition_typ;
CHECK TABLE transaction_registry	 ;

/* mysql db
    Tabella Crescente	        Azione	Righe 	Tipo	Codifica caratteri	Dimensione	Overhead
	columns_priv	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	column_stats	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	db	 	                    Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	3	Aria	utf8_bin	40.0 KiB	-
	event	 	                Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	func	 	                Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	general_log      	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	2	CSV	utf8_general_ci	sconosciuto 	-
	global_priv	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	6	Aria	utf8_bin	32.0 KiB	-
	gtid_slave_pos	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	InnoDB	latin1_swedish_ci	16.0 KiB	-
	help_category	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	48	Aria	utf8_general_ci	40.0 KiB	-
	help_keyword	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	37	Aria	utf8_general_ci	40.0 KiB	-
	help_relation	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	114	Aria	utf8_general_ci	32.0 KiB	-
	help_topic	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	752	Aria	utf8_general_ci	1.6 MiB	-
	index_stats	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	innodb_index_stats	 	    Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	579	InnoDB	utf8_bin	128.0 KiB	-
	innodb_table_stats	 	    Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	176	InnoDB	utf8_bin	16.0 KiB	-
	plugin	 	                Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	proc	 	                Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	1	Aria	utf8_general_ci	32.0 KiB	-
	procs_priv	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	proxies_priv	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	1	Aria	utf8_bin	40.0 KiB	-
	roles_mapping	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	servers	 	                Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	slow_log	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	2	CSV	utf8_general_ci	sconosciuto 	-
	tables_priv	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	table_stats	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_bin	16.0 KiB	-
	time_zone	 	            Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	time_zone_leap_second       Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	time_zone_name	 	        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	time_zone_transition        Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	time_zone_transition_type   Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	Aria	utf8_general_ci	16.0 KiB	-
	transaction_registry	 	Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Svuota Svuota	Elimina Elimina	0	InnoDB	utf8_bin	64.0 KiB	-
	user	 	Mostra Mostra	Struttura Struttura	Cerca Cerca	Inserisci Inserisci	Modifica Modifica	Elimina Elimina	~0 	Vista	---	- 	-
31 tabelle	Totali	~1,721	InnoDB	utf8mb4_general_ci	2.3 MiB	0 B
*/