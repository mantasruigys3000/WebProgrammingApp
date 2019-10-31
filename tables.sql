CREATE TABLE tbl_company (
    company_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    company_name varchar(20) NOT NULL,
    company_tel varchar(15),
    company_date_added DATETIME NOT NULL,
    company_last_update DATETIME NOT NULL,
    company_description varchar(50),
    company_email varchar(50)
);

CREATE TABLE tbl_user(
    user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_username varchar (20),
    user_salt varchar(10),
    user_password varchar(256)
)

INSERT into table tbl_user VALUES ('a01','E1F53135E5','xBIBM57uij');
INSERT into tbl_user(user_username,user_salt,user_password) VALUES ('a01','E1F53135E5','7ffe3d53581e6f0b6412a0c52f739896e37145e82ecb6da12bbb84bed60fbccd');