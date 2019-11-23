import mysql.connector;
from datetime import date;
from datetime import timedelta;
import smtplib;
import time;
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText
from email.MIMEImage import MIMEImage

base_pdf_location = "/Applications/MAMP/htdocs/Gymkhana/forms"

issue_add = set();
issue_due = set();
issue_ret = set();
applications = set();

gym = mysql.connector.connect(
  host="localhost",
  port="8889",
  user="root",
  passwd="root",
  database="Gymkhana"
);

gymcursor = gym.cursor();

while True:

  # For sending application successful mail
  gymcursor.execute("select * from currentapplications where status = 1");
  for form in gymcursor:
    if form[0] not in applications:
      applications.add(form[0]);
      gymcursor2 = gym.cursor();
      gymcursor2.execute("select * from student where rollno=%s",(form[1], ) );
      for std in gymcursor2:

        msg = MIMEMultipart();
        msg['From'] = 'sg.iitbbs@gmail.com';
        msg['To'] = std[2];
        msg['CC'] = form[6];
        msg['Subject'] = "Application Accepted";
        body = header + 'Dear ' + std[1] + ',\n\nThis is to infrom you that your application (id:'+str(form[0])+') for form ' + form[7] + ' is Accepted by the corresponding authority ('+form[3]+').'+ '\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
        msg.attach(MIMEText(body, 'plain'));
        msg.attach(MIMEText(file('{}/{}.pdf'.format(base_pdf_location,form[0])).read()))

        gmail_user = 'sg.iitbbs@gmail.com';
        gmail_pwd = 'Password';
        # smtpserver = smtplib.SMTP("smtp.gmail.com",587);
        # smtpserver.ehlo();
        # smtpserver.starttls();
        # smtpserver.ehlo;
        # smtpserver.login(gmail_user, gmail_pwd);
        print (msg)
        # smtpserver.sendmail(gmail_user, std[2], msg);
        # smtpserver.close();   

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
          gmail_pwd = 'Password';
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
          gmail_pwd = 'Password';
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
          gmail_pwd = 'Password';
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
