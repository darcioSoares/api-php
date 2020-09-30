
## tabela da aplicacao cadastro e validacao de usuario

CREATE TABLE t_users(

'id', 'int(11)', 'NO', 'PRI', NULL, 'auto_increment'
'name', 'varchar(60)', 'NO', '', NULL, ''
'lastname', 'varchar(60)', 'NO', '', NULL, ''
'email', 'varchar(60)', 'NO', 'UNI', NULL, ''
'password', 'varchar(100)', 'NO', '', NULL, ''
'create_at', 'timestamp', 'NO', '', 'CURRENT_TIMESTAMP'
)


## tabela de teste crud da aplicacao

CREATE TABEL users(

'id', 'int(11)', 'NO', 'PRI', NULL, 'auto_increment'
'nome', 'varchar(50)', 'NO', '', NULL, ''
'sobrenome', 'varchar(50)', 'NO', '', NULL, ''

)