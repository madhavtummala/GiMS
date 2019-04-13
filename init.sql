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
  constraint pk_officebearer primary key (post),
  constraint uk_officebearer_contactnumber unique (contactnumber),
  constraint uk_officebearer_emailid unique (emailid)
);

create table student
(
  rollno varchar(12) not null,
  name varchar(50) not null,
  emailid varchar(50) not null,
  password varchar(50) not null,
  hostelname varchar(50) not null,
  constraint pk_student primary key (rollno),
  constraint fk_student_hostelname foreign key (hostelname) references hostel(hostelname),
  constraint uk_student_emailid unique (emailid)
);

create database THN2;
use THN2;

create table equipment
(
  eid int not null,
  name varchar(50) not null,
  status int not null,
  dateofpurchase date not null,
  cost int not null,
  invoiceno int not null,
  constraint pk_equipment primary key (eid)
);

create table issuehistory
(
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int not null,
  constraint pk_issuehistory primary key (eid, rollno, dateofissue),
  constraint fk_issuehistory_eid foreign key (eid) references equipment(eid)
);

create table issued
(
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  fine int not null default 0,
  constraint pk_issued primary key (eid, rollno, dateofissue),
);

create table requests
(
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  constraint pk_requests primary key (equipmentname, hostelname, rollno),
);