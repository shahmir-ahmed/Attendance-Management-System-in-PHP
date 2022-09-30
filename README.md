# Attendance Management System in PHP
## Technologies used:  ##
- HTML5
- CSS3
- Bootstrap
- PHP
- MySQL.


## Requirements ##
  - PHP 5.3 or higher.
  - MySQL 5.6 or higher for spatial features in MySQL.
  - XAMPP or WAMP server for localhost. 

## Features ##

- Secure, User-friendly
- Manage Students Information
- Hassle Free Attendance within seconds
- Reports Generation 
- Easy Login, Signup, Logout, Data Updation

### Student Panel ###

- Student panel includes the registration and login page
- Student can mark his/her attendance as present or absent
- Student once marked attendance for today cannot mark attendance again or send leave
- Student can view all the marked attendances and leaves
- Student can edit their personal details along with their profile picture
- Student can send Leave Request to admin for leave

### Admin Panel ###

- Admin can login through login page
- Admin can view all the record of registered students
- Admin can edit, add, and delete the students attendance
- Admin can view all the student's atendances and leaves
- Admin can edit the student's details
- Admin can create a report of students which will show specific student attendance within the mentioned dates.
- Admin can approve, reject pending leaves of students. 
- There is proper count of leaves, presents, absents of each student.
- Admin can create a Complete System Report FROM and TO dates of all attendances of students.


  ### Admin credential
    `username:admin
    password:1212514`
    
  ### Students credentials
  ` username:shahmir
    password:1212514 `
    
  ` username:shehryar
    password:00000 `


## Database
MySQL is used as database. Database design is made easy to understand.
## Importing Database
- Download the given \*attendance-system.sql file.
- Create a database attendance-system
- Import \*attendance-system.sql, if all the steps are completed then database will be imported.


## Tables
- admin-login
- student-login
- students
- attendance
- leaves
