#!/usr/bin/env python3

import mysql.connector;
from datetime import date;
from datetime import timedelta;
import smtplib;

gym = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="root",
  database="Gymkhana"
);

gymcursor = gym.cursor();

gymcursor.execute("select dbaddress from hostel");

for db in gymcursor:
  hostel = mysql.connector.connect(
    host="localhost",
    user="arnejasaksham",
    passwd="Sak@192114",
    database=db[0]
  );
  hostelcursor=hostel.cursor();
  hostelcursor.execute("select * from issued,equipment where issued.eid=equipment.eid and dateofissue<=%s", ((date.today() - timedelta(days=7)).strftime("%Y-%m-%d"), ));
  for issue in hostelcursor:
    gymcursor2 = gym.cursor();
    gymcursor2.execute("select * from student where rollno=%s",(issue[2], ) );
    for std in gymcursor2:
      to = std[2];
      gmail_user = 'sg.iitbbs@gmail.com';
      gmail_pwd = 'PassGymkhana';
      smtpserver = smtplib.SMTP("smtp.gmail.com",587);
      smtpserver.ehlo();
      smtpserver.starttls();
      smtpserver.ehlo;
      smtpserver.login(gmail_user, gmail_pwd);
      header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Return Reminder \n';
      msg = header + 'Dear ' + std[1] + ',\n\nThis is to remind you that ' + issue[7] + ' is now due to be returned.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
      smtpserver.sendmail(gmail_user, to, msg);
      smtpserver.close();
