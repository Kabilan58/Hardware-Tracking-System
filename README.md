# Hardware Tracking System (HTS)

![Project Banner](images/login/hard.png)

A comprehensive web-based solution for managing hardware inventory, tracking maintenance, and streamlining technical support within an organization.

## 🚀 Features

- **Role-Based Access Control**: Separate interfaces and permissions for Administrators, Technical Engineers, and End Users.
- **Hardware Inventory Management**: Track PC specifications, components, and historical maintenance data.
- **AMC Tracking**: Monitor Annual Maintenance Contracts for all hardware assets.
- **Complaint Management System**: 
  - Users can log technical issues in real-time.
  - Technical Engineers can track, update, and resolve tickets.
  - Comprehensive reporting on pending and rectified complaints.
- **System Allotment**: Assign and track hardware distribution across various departments.
- **Departmental Organization**: Manage organizational structure and department-wise asset allocation.
- **Reports & Analytics**: Generate detailed reports for inventory status and maintenance history.

## 🛠️ Requirements

- **PHP**: v7.4 or higher (Compatible with PHP 8.x)
- **Database**: MySQL v5.7+ or MariaDB
- **Web Server**: Apache (XAMPP / WAMP / MAMP)
- **Browser**: Modern web browsers (Chrome, Firefox, Edge, Safari)
- **Frontend Framework**: Bootstrap 5 (Integrated)

## 📥 Installation

1. **Clone/Download**: Extract the project files into your web server's root directory (e.g., `C:/xampp/htdocs/hwtracking`).
2. **Database Setup**:
   - Open **phpMyAdmin** or your preferred MySQL client.
   - Create a new database named `hts`.
   - Import the SQL file: `db/hts.sql`.
3. **Configuration**:
   - Open `db.php` and verify the database credentials:
     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db   = "hts";
     ```
4. **Access the App**:
   - Start Apache and MySQL in your XAMPP/WAMP control panel.
   - Navigate to `http://localhost/hwtracking` in your browser.

## 🔑 Default Credentials

| Role | Username | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin` | `admin` |
| **User** | Register via UI | Set during registration |

## 📂 Project Structure

- `adminh.php`: Administrator dashboard.
- `techenggh.php`: Technical Engineer dashboard.
- `userh.php`: User dashboard.
- `db/`: Contains the database schema (`hts.sql`).
- `assets/`: CSS and JavaScript dependencies (Bootstrap 5).
- `images/`: UI assets and hardware-related imagery.

---
*Developed by KABILAN T with ❤️ for streamlined hardware management.*
