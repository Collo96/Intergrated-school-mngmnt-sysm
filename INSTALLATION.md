# NTURUBA School Management System - Installation Guide

## Prerequisites

- XAMPP (Apache, PHP 8.0+, MySQL 8.0+)
- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer (optional, for dependency management)
- Git

## Installation Steps

### 1. Download and Extract

```bash
# Clone the repository
git clone https://github.com/Collo96/Intergrated-school-mngmnt-sysm.git

# Navigate to the project directory
cd Intergrated-school-mngmnt-sysm
```

### 2. Configure Environment

```bash
# Copy the environment file
cp .env.example .env

# Edit .env with your database credentials
```

### 3. Database Setup

1. **Create Database**
   - Open phpMyAdmin: `http://localhost/phpmyadmin`
   - Create a new database: `nturuba_school_db`
   - Set charset to `utf8mb4`

2. **Import Schema**
   - Go to Import tab
   - Select `database/schema.sql`
   - Click Import

3. **Import Sample Data** (optional)
   ```bash
   mysql -u root -p nturuba_school_db < database/sample_data.sql
   ```

### 4. File Permissions

```bash
# For Linux/Mac
chmod -R 755 storage/
chmod -R 755 public/

# For Windows (in Command Prompt as Admin)
icacls "storage\" /grant:r "%username%:F" /t
icacls "public\" /grant:r "%username%:F" /t
```

### 5. Run Application

1. **Start XAMPP Services**
   - Apache
   - MySQL

2. **Move Project to htdocs**
   ```bash
   # Copy to XAMPP htdocs directory
   # Windows: C:\xampp\htdocs
   # Linux: /opt/lampp/htdocs
   # Mac: /Applications/XAMPP/xamppfiles/htdocs
   ```

3. **Access Application**
   - URL: `http://localhost/Intergrated-school-mngmnt-sysm/public/`

### 6. Default Login Credentials

**Super Admin**
- Username: `admin`
- Password: `admin123`
- Email: `admin@nturuba.local`

**Teacher**
- Username: `teacher1`
- Password: `teacher123`

**Student**
- Username: `student1`
- Password: `student123`

## Troubleshooting

### Database Connection Error
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure database `nturuba_school_db` exists

### File Upload Issues
- Check `storage/` folder permissions
- Verify `MAX_UPLOAD_SIZE` in `.env`

### Session Issues
- Clear browser cookies
- Check session save path in `php.ini`
- Verify `storage/sessions/` directory exists

### PHP Version
- Ensure PHP 8.0 or higher
- Check: `php -v`

## Post-Installation

1. Change default admin password
2. Configure email settings
3. Upload school logo
4. Set academic calendar
5. Configure fee structures

## Support

For issues, contact: support@nturuba.local
