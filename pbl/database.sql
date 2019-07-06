CREATE TABLE T_USER(
 USER_ID varchar(16) PRIMARY KEY, -- ユーザID
 ACCOUNT_NAME varchar(32) NOT NULL, -- ユーザ名
 USER_PASS varchar(16) NOT NULL, -- パスワード
 urole int -- ユーザ種別 1-社員 2-ゲスト

);

INSERT INTO T_USER VALUES
('u001','渡部 妃菜', '1234',1),
('u002','安田 敬太', '1234',1),
('u003','前田 稟',   '1234',1),
('u004','山本 明莉', '1234',1),
('u005','斉藤 万葉', '1234',1),
('u006','高野 歩',   '1234',1),
('u007','尾崎 沙織', '1234',1),
('u008','菅原 直子', '1234',1),
('u009','大島 ゆら',  '1234',1),
('u010','中西 陽花', '1234',1),
('t001', 'ゲスト1',   '3456',2),
('t002', 'ゲスト2',   '3456',2),
('t003', 'ゲスト3',   '3456',2),
('t004', 'ゲスト4',   '3456',2),
('t005', 'ゲスト5',   '3456',2);

CREATE TABLE T_RSTINFO(
 STORE_ID VARCHAR(32) PRIMARY KEY,
 STORE_NAME VARCHAR(32) NOT NULL,
 ADDRESS VARCHAR(64) NOT NULL,
 OP_HOUR INT(10),
 OP_MIN INT(10),
 CL_HOUR INT(10),
 CL_MIN INT(10),
 MOVE_TIME INT(10),
 HOLIDAY INT(10),
 HP_URL VARCHAR(20),
 EVALUATION FLOAT(2) NOT NULL,
 USER_ID VARCHAR(16)
);

INSERT INTO T_RSTINFO VALUES
('r001','ファミレス','福岡県福岡市',9,8,7,6,4,2,'NULL',3,'NULL');

CREATE TABLE T_REVIEW(
 REVIEW_ID VARCHAR(32) PRIMARY KEY,
 EVALUATION_POINTS INT(1) NOT NULL,
 COMMENT VARCHAR(400) NOT NULL,
 USER_ID VARCHAR(8) NOT NULL,
 STORE_ID VARCHAR(16) NOT NULL
);

INSERT INTO T_REVIEW VALUES
('p001',3,"おいしかった","u001","r001");

CREATE TABLE T_USERTYPE(
 USER_TYPE_ID VARCHAR(16) PRIMARY KEY,
 USER_TYPE VARCHAR(20) NOT NULL
);


