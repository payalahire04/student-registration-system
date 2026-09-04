# CampusConnect 2026 – Student Registration & Login System

## 📌 Project Overview

**CampusConnect 2026** is a simple student registration and login web application deployed on an **AWS EC2 instance**.

The project demonstrates how to deploy a PHP-based website on a Linux cloud server using:

- AWS EC2
- Amazon Linux 2023
- Nginx
- PHP
- MariaDB
- HTML
- SQL

Students can register by entering their personal and college details. The registration data is stored in a MariaDB database. Registered students can then log in using their Email/Student ID and Password.

---

## 🏗️ Project Architecture

```text
User Browser
     │
     │ HTTP : 80
     ▼
AWS EC2 Instance
     │
     ├── Nginx Web Server
     │       │
     │       ▼
     │    HTML Pages
     │    PHP Files
     │
     ├── PHP
     │       │
     │       ▼
     │    Processes Registration/Login
     │
     └── MariaDB
             │
             ▼
       campusconnect
             │
             ▼
          students
```

---

## ☁️ Technologies Used

| Technology | Purpose |
|---|---|
| AWS EC2 | Cloud server |
| Amazon Linux 2023 | Operating system |
| Nginx | Web server |
| PHP | Server-side programming |
| MariaDB | Database |
| HTML | Web forms |
| SQL | Database and table management |
| SSH | Remote server connection |

---

# 🚀 Installation & Deployment Steps

## 1. Launch AWS EC2 Instance

Create an EC2 instance using Amazon Linux 2023.

After launching the instance, note the:

- Instance ID
- Public IPv4 address
- Private IPv4 address
- Key pair

The public IP is used to access the website from a browser.

---

## 2. Configure Security Group

Configure the EC2 Security Group with the following inbound rules:

| Type | Port | Purpose |
|---|---:|---|
| SSH | 22 | Remote connection to EC2 |
| HTTP | 80 | Access website through browser |

For a practical/demo environment, HTTP can be allowed from `0.0.0.0/0`.

**Security Note:** For production, SSH access should preferably be restricted to a trusted IP address instead of allowing SSH from everyone.

---

## 3. Connect to EC2 Using SSH

Connect to the EC2 instance using SSH.

Example:

```bash
ssh -i "your-key.pem" ec2-user@YOUR_PUBLIC_IP
```

After successful connection:

```bash
whoami
```

The expected user is:

```text
ec2-user
```

---

## 4. Install Nginx

Install Nginx:

```bash
sudo yum install nginx -y
```

Start Nginx:

```bash
sudo systemctl start nginx
```

Enable Nginx at system startup:

```bash
sudo systemctl enable nginx
```

Check status:

```bash
sudo systemctl status nginx
```

Nginx serves the website through HTTP port `80`.

---

## 5. Install MariaDB

Install MariaDB Server:

```bash
sudo yum install mariadb105-server -y
```

Start MariaDB:

```bash
sudo systemctl start mariadb
```

Enable it at startup:

```bash
sudo systemctl enable mariadb
```

Check status:

```bash
sudo systemctl status mariadb
```

---

## 6. Install PHP

Install PHP:

```bash
sudo yum install php -y
```

Check PHP version:

```bash
php -v
```

PHP is used to process the registration and login forms on the server.

---

# 🗄️ Database Configuration

## 7. Create Database

Login to MariaDB:

```bash
sudo mariadb
```

Create the database:

```sql
CREATE DATABASE campusconnect;
```

Select the database:

```sql
USE campusconnect;
```

Verify databases:

```sql
SHOW DATABASES;
```

---

## 8. Create Student Table

Create the student table:

```sql
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    college_name VARCHAR(150) NOT NULL,
    location VARCHAR(100) NOT NULL,
    event VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

Verify the table:

```sql
SHOW TABLES;
```

Check the table structure:

```sql
DESCRIBE students;
```

---

# 🌐 Website Files

The main website files are:

```text
CampusConnect/
│
├── register.html
├── register.php
├── login.html
├── login.php
└── README.md
```

> Keep database passwords and other secrets out of GitHub. If your PHP file contains database credentials, replace them with placeholders before uploading the repository.

---

## 9. Registration Page – `register.html`

The registration form contains:

- Full Name
- Student ID
- Email
- College Name
- Location
- Event
- Password
- Register button

Example form structure:

```html
<form action="register.php" method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="text" name="student_id" placeholder="Student ID" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="college_name" placeholder="College Name" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="event" placeholder="Event" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">REGISTER</button>
</form>
```

---

## 10. Registration Processing – `register.php`

`register.php` receives the data submitted by `register.html`.

The PHP script:

1. Receives form data.
2. Connects to MariaDB.
3. Inserts student information into the database.
4. Displays a successful registration message.

The basic flow is:

```text
register.html
      ↓
register.php
      ↓
MariaDB
      ↓
students table
      ↓
Registration Successful
```

---

## 11. Registration Output

After successful registration, the application displays:

```text
Registration Successful!

Welcome to CampusConnect 2026.

Go to Login
```

The registered student's information can be verified using:

```sql
SELECT * FROM students;
```

---

# 🔐 Login System

## 12. Login Page – `login.html`

The login page contains:

- Email / Student ID
- Password
- Login button

Example:

```html
<form action="login.php" method="POST">
    <input type="text" name="login" placeholder="Email / Student ID" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">LOGIN</button>
</form>
```

---

## 13. Login Processing – `login.php`

`login.php` verifies the credentials entered by the student.

The login process is:

```text
Login Form
     ↓
login.php
     ↓
MariaDB
     ↓
Check Email/Student ID + Password
     ↓
Successful / Invalid Login
```

---

## 14. Successful Login

When valid credentials are entered, the website displays:

```text
Login Successful!

Welcome, Student Name
```

Invalid credentials should display an appropriate error message.

---

# 🌍 Final Website

The website can be accessed through the EC2 public IP:

```text
http://YOUR_EC2_PUBLIC_IP/
```

Example:

```text
http://54.xx.xx.xx/
```

Registration page:

```text
http://YOUR_EC2_PUBLIC_IP/register.html
```

Login page:

```text
http://YOUR_EC2_PUBLIC_IP/login.html
```

---

# 🧪 Testing

## Registration Test

1. Open the registration page.
2. Enter student details.
3. Click **REGISTER**.
4. Confirm the success message.
5. Check the database.

SQL:

```sql
USE campusconnect;

SELECT * FROM students;
```

---

## Login Test

1. Open the login page.
2. Enter registered Email/Student ID.
3. Enter the correct password.
4. Click **LOGIN**.
5. Confirm the successful login message.

---

## Invalid Login Test

Enter an incorrect password or unregistered Email/Student ID.

The application should reject the login and show an error message.

---

# 🔍 Service Verification

Check Nginx:

```bash
sudo systemctl status nginx
```

Check MariaDB:

```bash
sudo systemctl status mariadb
```

Check PHP:

```bash
php -v
```

Check listening ports:

```bash
sudo ss -tulpn
```

HTTP normally uses:

```text
Port 80
```

SSH normally uses:

```text
Port 22
```

---

# 📸 Practical Evidence

The project practical includes screenshots for:

1. EC2 instance launch
2. EC2 instance running
3. Security Group configuration
4. SSH connection
5. Nginx installation
6. MariaDB installation
7. PHP installation
8. Service status
9. Database creation
10. Student table creation
11. Registration form
12. Registration success
13. Login form
14. Successful login
15. Final website through EC2 public IP
16. SQL/registration data verification
17. Invalid login testing

---

# 📁 Recommended GitHub Repository Structure

```text
CampusConnect-2026/
│
├── register.html
├── register.php
├── login.html
├── login.php
├── README.md
│
└── screenshots/
    ├── 01-ec2-launch.png
    ├── 02-security-group.png
    ├── 03-nginx-installation.png
    ├── 04-mariadb-installation.png
    ├── 05-php-installation.png
    ├── 06-database.png
    ├── 07-student-table.png
    ├── 08-registration.png
    ├── 09-registration-success.png
    ├── 10-login.png
    └── 11-login-success.png
```

---

# ⚠️ Security Notes

- Do **not** upload `.pem` key files to GitHub.
- Do **not** upload real database passwords.
- Do **not** upload private API keys or AWS access keys.
- Use environment variables or a separate configuration file for production credentials.
- Passwords should be stored using secure hashing such as PHP `password_hash()` rather than plain text.

---

# 🎯 Project Outcome

The project successfully demonstrates deployment of a student registration and login application on an AWS EC2 Linux server.

The complete flow is:

```text
AWS EC2
   ↓
Security Group
   ↓
SSH Connection
   ↓
Nginx
   ↓
PHP
   ↓
MariaDB
   ↓
campusconnect Database
   ↓
students Table
   ↓
Registration
   ↓
Login
   ↓
Website Accessible Through EC2 Public IP
```

---

## 👩‍💻 Project

**Project Name:** CampusConnect 2026  
**Domain:** Cloud Computing / Web Application Deployment  
**Platform:** AWS EC2  
**Web Server:** Nginx  
**Database:** MariaDB  
**Backend:** PHP  
**Frontend:** HTML
