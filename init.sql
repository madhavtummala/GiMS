create table hostel
(
  hostelname varchar(50) not null,
  dbaddress varchar(100) not null,
  primary key (hostelname),
  unique (dbaddress)
);

create table officebearer
(
  post varchar(50) not null,
  name varchar(50) not null,
  contactnumber numeric(10,0) not null,
  emailid varchar(50) not null,
  primary key (post),
  unique (contactnumber),
  unique (emailid)
);

create table student
(
  rollno varchar(12) not null,
  name varchar(50) not null,
  emailid varchar(50) not null,
  password varchar(50) not null,
  hostelname varchar(50) not null,
  primary key (rollno),
  foreign key (hostelname) references hostel(hostelname),
  unique (emailid)
);

create table issuehistory
(
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  dateofreturn date not null,
  fineamount int not null,
  reasonforfine int not null,
  primary key (eid, rollno, dateofissue),
  foreign key (rollno) references student(rollno)
);

create table fines
(
  eid int not null,
  rollno varchar(12) not null,
  amount int not null,
  reason int not null,
  primary key (eid),
  foreign key (rollno) references student(rollno)
);

create table requests
(
  equipmentname varchar(50) not null,
  rollno varchar(12) not null,
  hostelname varchar(50) not null,
  estimatedcost int not null,
  purchaselinks varchar(1000),
  reason varchar(1000) not null,
  primary key (equipmentname, hostelname, rollno),
  foreign key (hostelname) references hostel(hostelname),
  foreign key (rollno) references student(rollno)
);

create table issued
(
  eid int not null,
  rollno varchar(12) not null,
  dateofissue date not null,
  primary key (eid, rollno, dateofissue),
  foreign key (rollno) references student(rollno)
);