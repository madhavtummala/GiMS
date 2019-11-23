drop database if exists Gymkhana;
drop database if exists THN2;
drop database if exists THN1;
drop database if exists MHR;
drop database if exists SHR;
drop database if exists Forms;

set global event_scheduler = ON;

create database Gymkhana;
use Gymkhana;

create table hostel
(
  hostelname varchar(50) not null,
  dbaddress varchar(100) not null,
  constraint pk_hostel primary key (hostelname),
  constraint uk_hostel_dbaddress unique (dbaddress)
);

create table officebearer
(
  post varchar(50) not null,
  name varchar(50) not null,
  contactnumber numeric(10,0) not null,
  emailid varchar(50) not null,
  password varchar(256) not null,
  constraint pk_officebearer primary key (post),
  constraint uk_officebearer_contactnumber unique (contactnumber),
  constraint uk_officebearer_emailid unique (emailid)
);

create table student
(
  rollno varchar(12) not null,
  name varchar(50) not null,
  emailid varchar(50) not null,
  password varchar(256) not null,
  hostelname varchar(50) not null,
  constraint pk_student primary key (rollno),
  constraint fk_student_hostelname foreign key (hostelname) references hostel(hostelname),
  constraint uk_student_emailid unique (emailid)
);

create table centraladmin (
  loginid varchar(50) NOT NULL,
  password varchar(256) NOT NULL,
  constraint pk_centraladmin primary key (loginid)
);
  
create table hosteladmin (
  loginid varchar(50) NOT NULL,
  password varchar(256) NOT NULL,
  hostelname varchar(50) NOT NULL,
  constraint pk_centraladmin primary key (loginid),
  constraint fk_hosteladmin_hostelname foreign key (hostelname) references hostel(hostelname)
);

insert into hostel values
("MHR", "MHR"),
("SHR", "SHR"),
("THN1", "THN1"),
("THN2", "THN2");

insert into centraladmin values('admin1', '$2y$10$lajkwiXNugj0eKHZdGLeiun8bsQ/JyejepwbDnIJOZWJxB3.sGFYm');

insert into hosteladmin values('thn1', '$2y$10$0cLXibHZh6mdhNc9a5cs1.vW6rH/7T3SuF2HZAad9qLZ32EsrnINi', "THN1");
insert into hosteladmin values('thn2', '$2y$10$0cLXibHZh6mdhNc9a5cs1.vW6rH/7T3SuF2HZAad9qLZ32EsrnINi', "THN2");

insert into student values("16cs01041", "Tummala Madhav", "tm15@iitbbs.ac.in", "$2y$10$yW9XMzeQuBlRaL7IwTjbYeWZUrgqgjHEcxkniaXswkzYKKAJDqxZO", "THN2");
insert into student values("16cs01042", "Saksham Arneja", "sa26@iitbbs.ac.in", "$2y$10$NgRzVrrE2JccpkE1Cz9NJuYeVukKtHrBpKFufkKW4VrOUuVoF76jO", "THN2");


insert into officebearer values("Gsec Science and Technology", "Geeth Nischal", "8500936193", "ggn10@iitbbs.ac.in", "$2y$12$7iSfWrzmR5481Uck3UvNO.vvm2ZYHPdGF6I4ZBvmPJw8klC/A8jX2");
insert into officebearer values("Vice President", "Punith", "9999999999", "vp.sg@iitbbs.ac.in", "$2y$12$YGOxjbqzp2H2sX0PD25vHeq1EnJrS6/HPcIg/QG66gyXRM2cwtrYm");


create database THN2;
use THN2;

create table equipment
(
  eid int not null auto_increment,
  name varchar(50) not null,
  status int not null,
  dateofpurchase date not null,
  cost int not null,
  invoiceno varchar(12) not null,
  constraint pk_equipment primary key (eid)
);

create table issuehistory
(
  issueno int not null,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int,
  constraint pk_issuehistory primary key (issueno),
  constraint fk_issuehistory_eid foreign key (eid) references equipment(eid)
);

create table issued
(
  issueno int not null auto_increment,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  fine int not null default 0,
  reason int default 0,
  constraint pk_issued primary key (issueno),
  constraint fk_issued_eid foreign key (eid) references equipment(eid)
);

create table requests
(
  requestno int not null auto_increment,
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  constraint pk_requests primary key (requestno)
);

insert into equipment values
(NULL,"Ludo",1,"20-02-21",653,"CVU87WNA0XZ"),
(NULL,"Swimming gogles",1,"19-05-25",6281,"AUB55NMI8ZQ"),
(NULL,"Tennis Ball",1,"19-02-28",3455,"CWW60HQC2ZK"),
(NULL,"Arduino",1,"18-11-13",7864,"VUL22KUE0PS"),
(NULL,"Arduino",1,"19-02-19",7857,"QMD75FYD0EU"),
(NULL,"Arduino",1,"19-05-05",9945,"GWK58ISM7CP"),
(NULL,"Water Ballon",1,"19-06-19",9780,"RFT53VEJ8CH"),
(NULL,"Baseball",1,"19-08-27",9643,"GYX37TDP2GR"),
(NULL,"Swimming sutis",1,"19-06-11",1546,"CEX06SBJ4MA"),
(NULL,"Baseball",1,"20-01-24",7094,"MRY70RGA6EP"),
(NULL,"Screw Driver",1,"20-03-20",7732,"JQO90MNP5JS"),
(NULL,"Swimming sutis",1,"20-01-19",8204,"FYH95YGP7RU"),
(NULL,"VolleyBall",1,"19-12-17",336,"LMA96OBC2PI"),
(NULL,"Baseball",1,"19-09-16",2590,"KFN37QJD8ST"),
(NULL,"Lock",1,"18-07-17",8598,"LAB63IHM3HD"),
(NULL,"Lock",1,"18-06-20",6185,"SXA33KEF3ZB"),
(NULL,"Swimming gogles",1,"19-02-18",3659,"GYI33PHG9WK"),
(NULL,"First Aid bands",1,"19-09-01",4733,"JRH74DGS5YZ"),
(NULL,"Chess",1,"19-03-24",8989,"OXK74UJB3IW"),
(NULL,"Lock",1,"19-05-16",1629,"VUR55RRG1EW"),
(NULL,"Air Pump",1,"19-11-06",693,"GSZ86IVS7BC"),
(NULL,"VolleyBall",1,"20-01-12",2082,"PWI69LLI7VT"),
(NULL,"Table Tennis Ball",1,"18-09-04",6093,"WMG68UCZ4LU"),
(NULL,"Cricket Ball",1,"19-03-27",1476,"LNL79JAQ6PK"),
(NULL,"Motors",1,"19-12-19",2164,"HNS68MMX8DN");

DELIMITER //

create trigger issue 
before insert on issued
for each row
begin
update equipment set status=0 where eid=new.eid;
end //

create trigger returned
before delete on issued
for each row
begin
insert into issuehistory values(old.issueno,old.eid,old.rollno,old.dateofissue,curdate(),old.fine,old.reason);
update equipment set status = case when old.reason=0 then 1 when old.reason=1 then 2 else 3 end where eid=old.eid;
end //

create event cal_fine
on schedule every 1 day
starts current_timestamp
ends current_timestamp + interval 1 year
do
begin
update issued set fine = case when datediff(curdate(),dateofissue)<=7 then fine+10 else fine end;
end //

DELIMITER ;

create database THN1;
use THN1;

create table equipment
(
  eid int not null auto_increment,
  name varchar(50) not null,
  status int not null,
  dateofpurchase date not null,
  cost int not null,
  invoiceno varchar(12) not null,
  constraint pk_equipment primary key (eid)
);

create table issuehistory
(
  issueno int not null,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int,
  constraint pk_issuehistory primary key (issueno),
  constraint fk_issuehistory_eid foreign key (eid) references equipment(eid)
);

create table issued
(
  issueno int not null auto_increment,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  fine int not null default 0,
  reason int default 0,
  constraint pk_issued primary key (issueno),
  constraint fk_issued_eid foreign key (eid) references equipment(eid)
);

create table requests
(
  requestno int not null auto_increment,
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  constraint pk_requests primary key (requestno)
);

insert into equipment values
(NULL,"Lock",1,"19-12-03",9980,"KQW95NQT6LD"),
(NULL,"Water Ballon",1,"19-10-01",4863,"BGP03CKL4XG"),
(NULL,"Tennis Ball",1,"18-09-27",5155,"IEU04MPR8CV"),
(NULL,"Carroms",1,"19-07-13",7679,"FDP66FJC7YV"),
(NULL,"Baseball",1,"19-03-20",5644,"HSW26KQE6ZS"),
(NULL,"Raspi",1,"19-07-29",8241,"VZI01WSM9LT"),
(NULL,"Mess card",1,"19-07-13",9775,"QAW99TAQ7XQ"),
(NULL,"First Aid bands",1,"19-02-14",1192,"QOS11XRF0QH"),
(NULL,"Raspi Zero",1,"19-01-10",6376,"CBN57NJH2DY"),
(NULL,"Water Ballon",1,"19-10-17",9081,"VBV18WEF9QH"),
(NULL,"Motors",1,"20-03-22",3893,"LDD44UWW8KA"),
(NULL,"VolleyBall",1,"19-09-07",9832,"LWN80FRU5WD"),
(NULL,"Tennis Ball",1,"18-08-17",1525,"UML41LHF2MA"),
(NULL,"BasketBall",1,"18-11-24",1158,"PBQ31NMH6PV"),
(NULL,"Motors",1,"18-11-10",2038,"OGD42XLV9DC"),
(NULL,"Guard Dress",1,"18-08-07",6419,"QWB26CBI1YB"),
(NULL,"Cricket Ball",1,"19-07-05",3633,"KET77CMT0FR"),
(NULL,"Swimming gogles",1,"20-02-27",2037,"NHS88VIT9MA"),
(NULL,"Chess",1,"20-03-16",1572,"WKX94AXY6GJ"),
(NULL,"Water Ballon",1,"19-05-23",1565,"LYA58XHT2OC"),
(NULL,"Lock",1,"18-12-19",292,"OEH62CQO8HG"),
(NULL,"VolleyBall",1,"19-11-20",4816,"SYT75EYR9KP"),
(NULL,"Ludo",1,"18-09-27",7791,"GQE27FCI4AB"),
(NULL,"First Aid bands",1,"20-01-26",5540,"HKM58XHD5UG"),
(NULL,"Cards",1,"18-07-14",3148,"BTO34YJP2DT");

DELIMITER //

create trigger issue 
before insert on issued
for each row
begin
update equipment set status=0 where eid=new.eid;
end //

create trigger returned
before delete on issued
for each row
begin
insert into issuehistory values(old.issueno,old.eid,old.rollno,old.dateofissue,curdate(),old.fine,old.reason);
update equipment set status = case when old.reason=0 then 1 when old.reason=1 then 2 else 3 end where eid=old.eid;
end //

create event cal_fine
on schedule every 1 day
starts current_timestamp
ends current_timestamp + interval 1 year
do
begin
update issued set fine = case when datediff(curdate(),dateofissue)<=7 then fine+10 else fine end;
end //

DELIMITER ;

create database MHR;
use MHR;

create table equipment
(
  eid int not null auto_increment,
  name varchar(50) not null,
  status int not null,
  dateofpurchase date not null,
  cost int not null,
  invoiceno varchar(12) not null,
  constraint pk_equipment primary key (eid)
);

create table issuehistory
(
  issueno int not null,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int,
  constraint pk_issuehistory primary key (issueno),
  constraint fk_issuehistory_eid foreign key (eid) references equipment(eid)
);

create table issued
(
  issueno int not null auto_increment,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  fine int not null default 0,
  reason int default 0,
  constraint pk_issued primary key (issueno),
  constraint fk_issued_eid foreign key (eid) references equipment(eid)
);

create table requests
(
  requestno int not null auto_increment,
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  constraint pk_requests primary key (requestno)
);

insert into equipment values
(NULL,"Printer",1,"18-08-01",4689,"FJI64KUM5OA"),
(NULL,"First Aid bands",1,"20-03-23",9393,"UHP50BBP2WN"),
(NULL,"Cricket Ball",1,"19-03-28",4178,"MYZ65UNL9LU"),
(NULL,"FootBall",1,"19-06-14",7245,"TNM46JJV3JD"),
(NULL,"Cricket Ball",1,"18-08-10",4798,"SFQ82HRP2NY"),
(NULL,"Mess card",1,"19-09-26",6190,"LOU90SOK8YJ"),
(NULL,"Carroms",1,"20-01-02",4746,"LEY51FUV3KK"),
(NULL,"Cards",1,"20-03-07",5527,"DCV90ETZ0ZP"),
(NULL,"Tennis Ball",1,"18-05-19",2183,"BWE44TKE6UJ"),
(NULL,"Hockey",1,"18-09-01",979,"PQY81UUZ0AV"),
(NULL,"VolleyBall",1,"18-07-02",6381,"SCU86NPU6YD"),
(NULL,"Ludo",1,"19-11-12",571,"CZC85OHV8TT"),
(NULL,"BasketBall",1,"20-03-14",8222,"WZA54TTB8AH"),
(NULL,"First Aid bands",1,"19-11-09",505,"KXH38WVQ4WM"),
(NULL,"First Aid bands",1,"19-09-10",2341,"DFY10FRS8AX"),
(NULL,"Table Tennis Ball",1,"18-05-06",8390,"GSN56WGS9GG"),
(NULL,"Carroms",1,"19-10-27",5572,"XNT38FLV9NZ"),
(NULL,"First Aid bands",1,"19-10-17",927,"RSM08KYR1LQ"),
(NULL,"Cards",1,"19-07-05",4949,"ECX71VAP7TT"),
(NULL,"Screw Driver",1,"19-12-28",9316,"ARV79OMQ6IT"),
(NULL,"Cricket Bat",1,"19-07-03",311,"TYU51EMA0NR"),
(NULL,"Printer",1,"18-06-15",1052,"DHE70WHE6DI"),
(NULL,"Motors",1,"19-07-27",6213,"VGA39JDK0QE"),
(NULL,"Swimming sutis",1,"19-03-07",8816,"PCI30QPU9WO"),
(NULL,"Cricket Ball",1,"18-05-11",2732,"IDL79XQC0UJ");

DELIMITER //

create trigger issue 
before insert on issued
for each row
begin
update equipment set status=0 where eid=new.eid;
end //

create trigger returned
before delete on issued
for each row
begin
insert into issuehistory values(old.issueno,old.eid,old.rollno,old.dateofissue,curdate(),old.fine,old.reason);
update equipment set status = case when old.reason=0 then 1 when old.reason=1 then 2 else 3 end where eid=old.eid;
end //

create event cal_fine
on schedule every 1 day
starts current_timestamp
ends current_timestamp + interval 1 year
do
begin
update issued set fine = case when datediff(curdate(),dateofissue)<=7 then fine+10 else fine end;
end //

DELIMITER ;

create database SHR;
use SHR;

create table equipment
(
  eid int not null auto_increment,
  name varchar(50) not null,
  status int not null,
  dateofpurchase date not null,
  cost int not null,
  invoiceno varchar(12) not null,
  constraint pk_equipment primary key (eid)
);

create table issuehistory
(
  issueno int not null,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int,
  constraint pk_issuehistory primary key (issueno),
  constraint fk_issuehistory_eid foreign key (eid) references equipment(eid)
);

create table issued
(
  issueno int not null auto_increment,
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  fine int not null default 0,
  reason int default 0,
  constraint pk_issued primary key (issueno),
  constraint fk_issued_eid foreign key (eid) references equipment(eid)
);

create table requests
(
  requestno int not null auto_increment,
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  ts timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  constraint pk_requests primary key (requestno)
);

insert into equipment values
(NULL,"BasketBall",1,"19-05-23",7719,"EKP09RNM1KH"),
(NULL,"Swimming gogles",1,"19-06-21",8918,"BPG75PGY2IZ"),
(NULL,"Swimming sutis",1,"19-12-06",9706,"GGI78XCY6IS"),
(NULL,"Hockey",1,"20-02-14",3155,"CIH73CDJ1XV"),
(NULL,"Chess",1,"18-05-03",2475,"FED52YXK2WQ"),
(NULL,"Table Tennis Ball",1,"19-06-17",7360,"ICA84OHK8KL"),
(NULL,"Raspi",1,"18-12-05",9803,"YCV79EXR5TC"),
(NULL,"Hockey",1,"18-04-26",7185,"XAI64FXI2OV"),
(NULL,"FootBall",1,"19-12-20",5203,"QLB15WSG3CR"),
(NULL,"Printer",1,"19-12-04",1612,"RSW96ABI5UB"),
(NULL,"Lock",1,"19-06-07",886,"KEE86YWM3GI"),
(NULL,"Swimming gogles",1,"18-05-23",922,"HLG16DNV2WQ"),
(NULL,"BasketBall",1,"18-07-29",5926,"ZEK12AZW0WN"),
(NULL,"Raspi",1,"18-04-20",1122,"HKC61IBX7TD"),
(NULL,"Lock",1,"20-01-31",1363,"NEK00OWY8LK"),
(NULL,"Guard Dress",1,"19-10-14",7123,"NKV76PQP0KJ"),
(NULL,"Guard Dress",1,"18-05-23",2532,"BWM36OWI7UG"),
(NULL,"Table Tennis Bat",1,"18-07-24",2873,"DEA27OKW2AD"),
(NULL,"Tennis Ball",1,"20-03-02",7394,"ZDM59MKL5QI"),
(NULL,"Table Tennis Ball",1,"19-05-12",2957,"JJT21XLA7BT"),
(NULL,"Air Pump",1,"18-11-02",6744,"ZQF15HXW2EH"),
(NULL,"Ludo",1,"18-08-31",4763,"FJP03DVD0WP"),
(NULL,"Printer",1,"20-04-07",5708,"LIV26KEH1MU"),
(NULL,"VolleyBall",1,"18-11-18",2155,"ZXH43SLU0EY"),
(NULL,"BasketBall",1,"19-11-03",6978,"GPX26TKZ9QK");

DELIMITER //

create trigger issue 
before insert on issued
for each row
begin
update equipment set status=0 where eid=new.eid;
end //

create trigger returned
before delete on issued
for each row
begin
insert into issuehistory values(old.issueno,old.eid,old.rollno,old.dateofissue,curdate(),old.fine,old.reason);
update equipment set status = case when old.reason=0 then 1 when old.reason=1 then 2 else 3 end where eid=old.eid;
end //

create event cal_fine
on schedule every 1 day
starts current_timestamp
ends current_timestamp + interval 1 year
do
begin
update issued set fine = case when datediff(curdate(),dateofissue)<=7 then fine+10 else fine end;
end //

DELIMITER ;

create database Forms;
use Forms;

CREATE TABLE `currentapplications` (
  `formid` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `formdata` text NOT NULL,
  `assignee` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `submitdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `currentapplications` (`formid`, `userid`, `formdata`, `assignee`, `status`, `submitdate`) VALUES
(1, '16cs01017', '{\"name\":\"b\",\"invoiceno\":\"fuili\",\"cost\":\"20\"}', '1', 'New', '2019-11-21'),
(2, '16cs01017', '{\"name\":\"p\",\"invoiceno\":\"poj\",\"cost\":\"20\"}', '1', 'New', '2019-11-21'),
(3, '16cs01017', '{\"name\":\"p\",\"invoiceno\":\"98\",\"cost\":\"8\"}', '1', 'New', '2019-11-21');

ALTER TABLE `currentapplications`
  ADD PRIMARY KEY (`formid`);

ALTER TABLE `currentapplications`
  MODIFY `formid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
 
DELIMITER ;