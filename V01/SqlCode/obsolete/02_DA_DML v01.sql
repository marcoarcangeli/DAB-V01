--
-- database: dadb
-- prove di verifica: Data Analysis DB
use dadb;


/*
		

*/
-- Utente
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente02','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente03','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente04','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente05','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente06','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente07','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente08','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente09','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente10','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente11','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente12','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente13','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente14','pwd01','utente01','pwd01','utente01@pwd01.da');	
INSERT INTO utente(nomeUtente, pwd, cognome, nome, eMail) VALUES ('utente15','pwd01','utente01','pwd01','utente01@pwd01.da');	
	
-- Progetto
select 
	p.idProgetto ,
	p.idUtente,
	p.nome,
	p.descrizione,
	p.folderRef,
	p.idStatoProgetto,
	sp.nome as StatoProgetto
from Progetto p
join StatoProgetto sp on p.idStatoProgetto=sp.idStatoProgetto
order by p.nome

--

	