# Student Profile Management System (SPMS)

## Overview
The **Student Profile Management System (SPMS)** is a lightweight, JSON-based web application that allows students to register, log in, and manage their own profiles. The system supports **CRUD operations** (Create, Read, Update, Delete) for student profiles, making it simple and efficient for small-scale student management without requiring a database.    

---

## Features

- **Student Registration & Login**
  - Students can register with their name, email, and password.
  - Login is secured using hashed passwords.
  
- **CRUD Functionality**
  - **Create:** Register a new student profile.
  - **Read:** View dashboard with personalized welcome message.
  - **Update:** Edit student profile fields: Name, Course, Year, Contact Info.
  - **Delete:** Delete student profile completely.

- **JSON-Based Storage**
  - All student data is stored in `data/students.json`, eliminating the need for MySQL or other databases.
  
- **Responsive Design**
  - Clean and modern interface for login, registration, dashboard, profile management, and deletion.
  
---

## Installation

1. **Requirements**
   - PHP 7+ installed.
   - A local server like XAMPP or WAMP.

2. **Steps**
   1. Download or clone the repository:
      ```bash
      git clone https://github.com/yourusername/student-profile-system.git
      ```
   2. Copy the folder into your `htdocs` (for XAMPP) or your server root directory.
   3. Open your browser and navigate to:
      ```
      http://localhost/student-profile-system/auth/auth.php
      ```
   4. Register a new student or log in if you already have an account.

---

## Folder Structure

student-profile-system/
│
├── data/
│ └── students.json # JSON file storing all student profiles
│
├── auth/
│ └── auth.php # Combined login & registration
│
├── student/
│ ├── dashboard.php # Student dashboard
│ ├── profile.php # View/Edit profile
│ └── delete.php # Delete profile
│
└── README.md # This file


---

## Usage

1. **Register:** Fill in name, email, and password on the registration form.
2. **Login:** Use your registered email and password.
3. **Dashboard:** After login, see a personalized greeting and options to view/edit your profile or logout.
4. **Update Profile:** Edit your Name, Course, Year, and Contact Info.
5. **Delete Profile:** Permanently remove your student profile. Option to register again after deletion.

---

## Notes

- This system is designed for **small-scale use** and educational purposes.
- For production-level applications, consider **using a database** (MySQL/PostgreSQL) and **more advanced security measures**.

---

## Author

**Luigi Barte**  

