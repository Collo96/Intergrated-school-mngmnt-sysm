# NTURUBA Integrated School Management System

A comprehensive, production-ready school management platform built with PHP 8 OOP, MySQL, and Bootstrap 5.

## 🎯 Features

### User Roles
- **Super Admin** - Full system control
- **Principal** - School management oversight
- **Deputy Principal** - Administrative support
- **Bursar** - Finance management
- **Teacher** - Academic management
- **Student** - Learning portal
- **Parent** - Student monitoring
- **Librarian** - Library management
- **Storekeeper** - Inventory management

### Core Modules
1. **Student Module** - Admission, profiles, attendance, discipline, performance
2. **Teacher Module** - Subject allocation, timetables, attendance, performance reports
3. **Parent Portal** - Fee balance, performance, attendance, communication
4. **Academic Module** - Classes, streams, subjects, exams, grading, report cards
5. **Finance Module** - Fee structures, payments, receipts, arrears, reports
6. **Library Module** - Book management, borrowing, returning, fines
7. **HR & Payroll Module** - Employee records, salary, leave management
8. **Inventory Module** - Procurement, asset tracking, stock management
9. **AI Smart Teacher** - KCSE revision, question generator, notes, marking, chatbot

## 🛠️ Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript ES6+
- **Backend**: PHP 8.0+ (OOP)
- **Database**: MySQL 8.0+
- **Server**: XAMPP (Apache, PHP, MySQL)
- **Architecture**: MVC Pattern
- **Security**: PDO, CSRF Protection, Password Hashing, RBAC

## 📋 Installation

See `INSTALLATION.md` for detailed setup instructions.

## 📁 Project Structure

```
nturuba-school-system/
├── app/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   ├── middleware/
│   └── helpers/
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── index.php
├── database/
│   ├── schema.sql
│   └── migrations/
├── storage/
│   ├── uploads/
│   ├── documents/
│   └── reports/
├── tests/
├── .env.example
├── composer.json
└── README.md
```

## 🔒 Security Features

- CSRF Token Protection
- Password Hashing (bcrypt)
- Role-Based Access Control (RBAC)
- SQL Injection Prevention (PDO)
- Secure Session Management
- Rate Limiting
- Input Validation & Sanitization

## 📊 Key Functionalities

- ✅ Multi-user authentication
- ✅ Dashboard analytics
- ✅ PDF/Excel export
- ✅ Email notifications
- ✅ Responsive design
- ✅ API endpoints (RESTful)
- ✅ Real-time notifications
- ✅ Audit logs

## 📝 License

Proprietary - NTURUBA Systems

## 👨‍💻 Developer

Built with ❤️ for educational excellence