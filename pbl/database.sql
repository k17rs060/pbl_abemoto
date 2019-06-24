CREATE TABLE tbl_user(
 uid varchar(16) PRIMARY KEY, -- ユーザID
 uname varchar(32) NOT NULL, -- ユーザ名
 upass varchar(16) NOT NULL, -- パスワード
 urole int -- ユーザ種別 1-社員 2-ゲスト　9-管理者
);

INSERT INTO tbl_user VALUES 
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
('t005', 'ゲスト5',   '3456',2),
('admin', 'Admin',  '5678',9);
 