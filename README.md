# 🔐 Smart Door Lock ESP32 RFID

A Smart Door Lock system based on **ESP32**, **RFID RC522**, **PHP**, and **MySQL** with a real-time web dashboard for user management and access monitoring.

---

## 📌 Features

- 🔑 RFID card authentication
- 🌐 Real-time web dashboard
- 👥 RFID user management (Add, Edit, Delete)
- 📜 Access history logging
- 🔒 Servo motor door lock
- 📟 LCD I2C status display
- 🔊 Buzzer notification
- 📊 Dashboard statistics
- 🗄️ MySQL database integration
- 📡 ESP32 communication with PHP via HTTP POST

---

## 🛠 Hardware

- ESP32 DevKit V1
- RFID RC522
- Servo Motor SG90
- LCD I2C 16x2
- Active Buzzer
- RFID Card / Tag
- Breadboard / PCB
- Jumper Wires
- USB Cable

---

## 💻 Software

- Arduino IDE
- Visual Studio Code
- XAMPP
- PHP
- MySQL
- phpMyAdmin

---

## 📂 Project Structure

```
Smart-Door-Lock-ESP32-RFID
│
├── Arduino
│   └── SmartDoor.ino
│
├── Web
│   ├── index.php
│   ├── users.php
│   ├── logs.php
│   ├── tambah.php
│   ├── pengaturan.php
│   ├── save_log.php
│   ├── simpan_user.php
│   ├── koneksi.php
│
├── Database
│   └── smartdoor.sql
│
├── Screenshots
│
└── README.md
```

---

## ⚡ Wiring

### RFID RC522

| RC522 | ESP32 |
|-------|-------|
| SDA | GPIO 5 |
| SCK | GPIO 18 |
| MOSI | GPIO 23 |
| MISO | GPIO 19 |
| RST | GPIO 21 |
| 3.3V | 3.3V |
| GND | GND |

### Servo

| Servo | ESP32 |
|--------|-------|
| Signal | GPIO 13 |
| VCC | 5V |
| GND | GND |

### LCD I2C

| LCD | ESP32 |
|-----|-------|
| SDA | GPIO 21 |
| SCL | GPIO 22 |
| VCC | 5V |
| GND | GND |

### Buzzer

| Buzzer | ESP32 |
|---------|-------|
| + | GPIO 27 |
| - | GND |

---

## 🗄 Database

Import the SQL file located in:

```
Database/smartdoor.sql
```

using **phpMyAdmin**.

---

## 🚀 Installation

1. Install XAMPP.
2. Copy the **Web** folder into:

```
xampp/htdocs/
```

3. Import the database using phpMyAdmin.
4. Update the database configuration in:

```
koneksi.php
```

5. Open:

```
http://localhost/smartdoor
```

6. Upload the Arduino code to ESP32.
7. Update your Wi-Fi credentials and server IP address inside:

```cpp
const char* ssid = "YOUR_WIFI";
const char* password = "YOUR_PASSWORD";

String serverName = "http://YOUR_IP/smartdoor/save_log.php";
```

---

## 📷 Screenshots

Add screenshots of:

- Dashboard
  <img width="1357" height="652" alt="image" src="https://github.com/user-attachments/assets/3407139c-b7dd-4e03-a910-d7a5ddd47490" />
  
- RFID User Management
<img width="1362" height="643" alt="Screenshot 2026-07-09 135834" src="https://github.com/user-attachments/assets/8ef69c1c-db35-4fc1-8eac-68ed380847d0" />

- Access Log
  <img width="1360" height="653" alt="image" src="https://github.com/user-attachments/assets/efe9dbb0-b9d2-4d4c-b6e4-8a1cfdc8d28c" />

- Add RFID Card
  <img width="1349" height="641" alt="Screenshot 2026-07-09 135902" src="https://github.com/user-attachments/assets/c36c1264-ce0e-4f54-b5d4-5595b98fd19d" />

- Setting
<img width="1360" height="651" alt="image" src="https://github.com/user-attachments/assets/f8e6d244-be14-4ca4-af2a-3d07c76ed4a6" />

---

## 🎯 Project Objectives

This project aims to develop an IoT-based smart door lock system using ESP32 and RFID technology. The system authenticates RFID cards, controls a servo door lock, records access history into a MySQL database, and provides a real-time web dashboard for monitoring and user management.

---

## 👨‍💻 Author

**Hoki Wibowo**

Automation Engineering Student

Universitas Negeri Jakarta

---

## 📄 License

This project is developed for educational and research purposes.
