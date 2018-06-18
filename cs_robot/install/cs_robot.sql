DROP TABLE IF EXISTS csrobot_automsg;

CREATE TABLE csrobot_automsg (
msgid          INT(10)     NOT NULL    AUTO_INCREMENT,
ordernum      INT(10)      NOT NULL DEFAULT 0,
activated      TINYINT(1)   NOT NULL DEFAULT 0,
msg          TEXT               NOT NULL,
PRIMARY KEY (msgid),
KEY ordernum (ordernum)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_comment;

CREATE TABLE csrobot_comment (
commentid int(30) NOT NULL auto_increment,
touserid int(30) NOT NULL default '0',
username  VARCHAR(64)  NOT NULL default '',
content text NOT NULL,
userip  VARCHAR(32)  NOT NULL default '',
created int(11) NOT NULL default '0',
PRIMARY KEY  (commentid),
KEY touserid (touserid),
KEY created (created)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_msg;

CREATE TABLE csrobot_msg (
msgid int(30) NOT NULL auto_increment,
fromid int(30) NOT NULL default '0',
toid   int(30) NOT NULL default '0',
msg text NOT NULL,
biu varchar(3) NOT NULL default '',
color varchar(8) NOT NULL default '',
created int(11) NOT NULL default '0',
minitime float(9,8) NOT NULL default '0',
type TINYINT(1) NOT NULL default '0',
PRIMARY KEY  (msgid),
KEY fromid (fromid),
KEY toid (toid)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_guest;

CREATE TABLE csrobot_guest (
guestid int(30) NOT NULL auto_increment,
guestip VARCHAR(32)  NOT NULL default '',
browser VARCHAR(64)  NOT NULL default '',
lang TINYINT(1) NOT NULL default '1',
created int(11) NOT NULL default '0',
isonline TINYINT(1) NOT NULL default '0',
isbanned TINYINT(1) NOT NULL default '0',
serverid int(11) NOT NULL default '0',
fromurl VARCHAR(255)  NOT NULL default '',
PRIMARY KEY  (guestid),
KEY serverid (serverid)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_session;

CREATE TABLE csrobot_session (
sessionid CHAR(64) NOT NULL default '',
userid int(11) NOT NULL default '0',
ipaddress varchar(64) NOT NULL default '',
created int(11) NOT NULL default '0',
PRIMARY KEY  (sessionid),
KEY created (created)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_user;

CREATE TABLE csrobot_user (
userid          INT(10)     NOT NULL    AUTO_INCREMENT,
usergroupid   INT(10)      NOT NULL DEFAULT 0,
displayorder  INT(10)      NOT NULL DEFAULT 0,
username     VARCHAR(64)          NOT NULL DEFAULT '',
type TINYINT(1) NOT NULL DEFAULT '1',
password      VARCHAR(32)          NOT NULL DEFAULT '',
activated      TINYINT(1)               NOT NULL DEFAULT 0,
isonline        TINYINT(1)               NOT NULL DEFAULT 0,
userfrontname       VARCHAR(64)          NOT NULL DEFAULT '',
userfrontename       VARCHAR(64)          NOT NULL DEFAULT '',
infocn          TEXT               NOT NULL,
infoen          TEXT               NOT NULL,
advcn          TEXT               NOT NULL,
adven          TEXT               NOT NULL,
lastlogin  INT(11)      NOT NULL DEFAULT 0,
PRIMARY KEY (userid),
KEY usergroupid (usergroupid)
) ENGINE=MyISAM;


DROP TABLE IF EXISTS csrobot_usergroup;

CREATE TABLE csrobot_usergroup (
usergroupid    smallint(5)     NOT NULL    AUTO_INCREMENT,
displayorder   INT(10)      NOT NULL DEFAULT 0,
groupname     VARCHAR(64)          NOT NULL DEFAULT '',
groupename     VARCHAR(64)          NOT NULL DEFAULT '',
activated       TINYINT(1)               NOT NULL DEFAULT 0,
description          TEXT               NOT NULL,
descriptionen          TEXT               NOT NULL,
PRIMARY KEY (usergroupid)
) ENGINE=MyISAM;

INSERT INTO csrobot_usergroup VALUES 
(1, 0, '系统管理员',   'Administrator', 1, '', ''),
(2, 1, '销售咨询',   'Sales Service', 1, '', ''),
(3, 2, '技术支持',   'Tech Support', 1, '', '');


DROP TABLE IF EXISTS csrobot_vvc;

CREATE TABLE csrobot_vvc (
vvcid int(30) NOT NULL auto_increment,
code varchar(9) NOT NULL default '',
date int(11) NOT NULL default '0',
PRIMARY KEY  (vvcid),
KEY date (date)
) ENGINE=MyISAM;