#!/usr/bin/env python3

import mysql.connector;
from datetime import date;
from datetime import timedelta;
import smtplib;
import time;

issue_add = set();
issue_due = set();
issue_ret = set();

gym = mysql.connector.connect(
  host="localhost",
  port="8889",
  user="root",
  passwd="root",
  database="Gymkhana"
);

gymcursor = gym.cursor();

while True:

  gymcursor.execute("select dbaddress from hostel");

  for db in gymcursor:
    hostel = mysql.connector.connect(
      host="localhost",
      port="8889",
      user="root",
      passwd="root",
      database=db[0]
    );
    hostelcursor=hostel.cursor();

    # For sending issued mail
    hostelcursor.execute("select * from issued,equipment where issued.eid=equipment.eid");
    for issue in hostelcursor:
      if issue[0] not in issue_add:
        issue_add.add(issue[0]);
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
          header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Issued \n';
          msg = header + 'Dear ' + std[1] + ',\n\nThis is to inform you that ' + issue[7] + ' has been issued by you today.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
          smtpserver.sendmail(gmail_user, to, msg);
          smtpserver.close();

    # For sending return due mail
    hostelcursor.execute("select * from issued,equipment where issued.eid=equipment.eid and dateofissue<=%s", ((date.today() - timedelta(days=6)).strftime("%Y-%m-%d"), ));
    for issue in hostelcursor:
      if issue[0] not in issue_due:
        issue_due.add(issue[0]);
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
          msg = header + 'Dear ' + std[1] + ',\n\nThis is to remind you that ' + issue[7] + ' is now due to be returned.\nPer day, Rs.10/- Fine will be charged from now, till the date of return.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
          smtpserver.sendmail(gmail_user, to, msg);
          smtpserver.close();      

    # For sending return successful mail
    hostelcursor.execute("select * from issuehistory,equipment where issuehistory.eid=equipment.eid");
    for issue in hostelcursor:
      if issue[0] not in issue_ret:
        issue_ret.add(issue[0]);
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
          header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Returned Successfully \n';
          msg = header + 'Dear ' + std[1] + ',\n\nThis is to infrom you that ' + issue[8] + ' is returned with fine of '+ str(issue[5]) + '.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
          smtpserver.sendmail(gmail_user, to, msg);
          smtpserver.close(); 

  print (issue_add);
  print (issue_due);
  print (issue_ret);
  time.sleep(60);