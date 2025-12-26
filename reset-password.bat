@echo off
"c:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe" -u root -e "UPDATE lms_database.users SET password = '$2y$10$bk1L0MEe526bs0pT64we5eX5Rs5ohdmroWeHE7d/AdgerzR/veBAy' WHERE id = 1;"
echo Password reset done!
