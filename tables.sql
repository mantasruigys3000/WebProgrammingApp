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

INSERT into tbl_company (company_name,company_tel,company_date_added,company_last_update,company_description,company_email)
VALUES('Intel','+44 7700 900702','2019-10-31 14:23:00','2019-10-31 14:23:00','Intel Corporation is an American multinational corporation and technology company headquartered in Santa Clara, California, in the Silicon Valley.','help@intel.co.uk');

INSERT into tbl_company (company_name,company_tel,company_date_added,company_last_update,company_description,company_email)
VALUES('IBM','+44 7700 900825','2019-10-31 14:28:00','2019-10-31 14:28:00','The International Business Machines Corporation is an American multinational information technology company headquartered in Armonk, New York, with operations in over 170 countries.','help@ibm.co.uk
');