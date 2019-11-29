import mysql.connector;
from datetime import date;
from datetime import timedelta;
import time;

import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
from email import encoders

mail_content = '''Hello,
This is a test mail.
In this mail we are sending some attachments.
The mail is sent using Python SMTP library.
Thank You
'''

sender_address = 'tummalamadhav1999@gmail.com'
sender_pass = 'Madhav6193'

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

        receiver_address = std[2]
        cc_address = form[6]

        message = MIMEMultipart()
        message['From'] = sender_address
        message['To'] = receiver_address
        message['CC'] = cc_address
        message['Subject'] = 'Application {} Accepted'.format(form[0])

        mail_content = 'Dear ' + std[1] + ',\n\nThis is to infrom you that your application (id:'+str(form[0])+') for form ' + form[7] + ' is Accepted by the corresponding authority ('+form[3]+').'+ '\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';

        message.attach(MIMEText(mail_content, 'plain'));
        file_name = '{}/{}.pdf'.format(base_pdf_location,form[0])
        file = open(file_name, 'rb')

        payload = MIMEBase('application', 'octate-stream')
        payload.set_payload((file).read())
        encoders.encode_base64(payload)

        payload.add_header('Content-Decomposition', 'attachment', filename=file_name)
        message.attach(payload)

        session = smtplib.SMTP('smtp.gmail.com', 587) #use gmail with port
        session.starttls() #enable security
        session.login(sender_address, sender_pass) #login with mail_id and password
        text = message.as_string()
        session.sendmail(sender_address, receiver_address, text)
        session.quit()
        # print('Mail Sent')  

  gymcursor.execute("select dbaddress from hostel");

  # for db in gymcursor:
  #   hostel = mysql.connector.connect(
  #     host="localhost",
  #     port="8889",
  #     user="root",
  #     passwd="root",
  #     database=db[0]
  #   );
  #   hostelcursor=hostel.cursor();

    # # For sending issued mail
    # hostelcursor.execute("select * from issued,equipment where issued.eid=equipment.eid");
    # for issue in hostelcursor:
    #   if issue[0] not in issue_add:
    #     issue_add.add(issue[0]);
    #     gymcursor2 = gym.cursor();
    #     gymcursor2.execute("select * from student where rollno=%s",(issue[2], ) );
    #     for std in gymcursor2:
    #       to = std[2];
    #       gmail_user = 'sg.iitbbs@gmail.com';
    #       gmail_pwd = 'Password';
    #       smtpserver = smtplib.SMTP("smtp.gmail.com",587);
    #       smtpserver.ehlo();
    #       smtpserver.starttls();
    #       smtpserver.ehlo;
    #       smtpserver.login(gmail_user, gmail_pwd);
    #       header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Issued \n';
    #       msg = header + 'Dear ' + std[1] + ',\n\nThis is to inform you that ' + issue[7] + ' has been issued by you today.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
    #       smtpserver.sendmail(gmail_user, to, msg);
    #       smtpserver.close();

    # # For sending return due mail
    # hostelcursor.execute("select * from issued,equipment where issued.eid=equipment.eid and dateofissue<=%s", ((date.today() - timedelta(days=6)).strftime("%Y-%m-%d"), ));
    # for issue in hostelcursor:
    #   if issue[0] not in issue_due:
    #     issue_due.add(issue[0]);
    #     gymcursor2 = gym.cursor();
    #     gymcursor2.execute("select * from student where rollno=%s",(issue[2], ) );
    #     for std in gymcursor2:
    #       to = std[2];
    #       gmail_user = 'sg.iitbbs@gmail.com';
    #       gmail_pwd = 'Password';
    #       smtpserver = smtplib.SMTP("smtp.gmail.com",587);
    #       smtpserver.ehlo();
    #       smtpserver.starttls();
    #       smtpserver.ehlo;
    #       smtpserver.login(gmail_user, gmail_pwd);
    #       header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Return Reminder \n';
    #       msg = header + 'Dear ' + std[1] + ',\n\nThis is to remind you that ' + issue[7] + ' is now due to be returned.\nPer day, Rs.10/- Fine will be charged from now, till the date of return.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
    #       smtpserver.sendmail(gmail_user, to, msg);
    #       smtpserver.close();      

    # # For sending return successful mail
    # hostelcursor.execute("select * from issuehistory,equipment where issuehistory.eid=equipment.eid");
    # for issue in hostelcursor:
    #   if issue[0] not in issue_ret:
    #     issue_ret.add(issue[0]);
    #     gymcursor2 = gym.cursor();
    #     gymcursor2.execute("select * from student where rollno=%s",(issue[2], ) );
    #     for std in gymcursor2:
    #       to = std[2];
    #       gmail_user = 'sg.iitbbs@gmail.com';
    #       gmail_pwd = 'Password';
    #       smtpserver = smtplib.SMTP("smtp.gmail.com",587);
    #       smtpserver.ehlo();
    #       smtpserver.starttls();
    #       smtpserver.ehlo;
    #       smtpserver.login(gmail_user, gmail_pwd);
    #       header = 'To:' + to + '\n' + 'From: ' + gmail_user + '\n' + 'Subject:Gymkhana Equipment Returned Successfully \n';
    #       msg = header + 'Dear ' + std[1] + ',\n\nThis is to infrom you that ' + issue[8] + ' is returned with fine of '+ str(issue[5]) + '.\n\nRegards,\nStudents\' Gymkhana,\nIndian Institute of Technology Bhubaneswar\n\n';
    #       smtpserver.sendmail(gmail_user, to, msg);
    #       smtpserver.close(); 

  print (issue_add);
  print (issue_due);
  print (issue_ret);
  print (applications);
  time.sleep(10);
