#include <WiFi.h>
#include <HTTPClient.h>

#include <SPI.h>
#include <MFRC522.h>

#include <ESP32Servo.h>

#include <Wire.h>
#include <LiquidCrystal_I2C.h>



// ================= PIN CONFIG =================

// RFID RC522
#define SS_PIN   5
#define RST_PIN  4

// Servo
#define SERVO_PIN 13

// Buzzer
#define BUZZER_PIN 27



// ================= WIFI =================

const char* ssid = "YOUR_WIFI_NAME";
const char* password = "YOUR_WIFI_PASSWORD";



// ================= SERVER =================

String serverName =
"http://YOUR_SERVER_IP/smartdoor/save_log.php";



// ================= OBJECT =================

MFRC522 rfid(SS_PIN, RST_PIN);

Servo doorServo;

LiquidCrystal_I2C lcd(0x27, 16, 2);



// ================= SETUP =================

void setup() {

  Serial.begin(115200);



  // ================= LCD =================

  lcd.init();

  lcd.backlight();



  lcd.setCursor(0,0);
  lcd.print("SMART DOOR");

  lcd.setCursor(0,1);
  lcd.print("Starting...");



  delay(2500);



  // ================= SERVO =================

  doorServo.attach(SERVO_PIN);

  // posisi awal terkunci
  doorServo.write(0);



  // ================= BUZZER =================

  pinMode(BUZZER_PIN, OUTPUT);

  digitalWrite(BUZZER_PIN, LOW);



  // ================= RFID =================

  SPI.begin();

  rfid.PCD_Init();



  // ================= WIFI =================

  WiFi.begin(ssid, password);



  lcd.clear();

  lcd.setCursor(0,0);
  lcd.print("Connecting");

  lcd.setCursor(0,1);
  lcd.print("WiFi...");



  int timeout = 0;



  while (WiFi.status() != WL_CONNECTED) {

    delay(500);

    Serial.print(".");



    timeout++;



    // timeout 20 detik
    if(timeout > 40){

      Serial.println("");

      Serial.println("WiFi Gagal");



      lcd.clear();

      lcd.setCursor(0,0);
      lcd.print("WiFi Gagal");

      lcd.setCursor(0,1);
      lcd.print("Cek Hotspot");



      delay(3000);

      break;

    }

  }



  // ================= STATUS WIFI =================

  if(WiFi.status() == WL_CONNECTED){

    Serial.println("");

    Serial.println("WiFi Connected");

    Serial.print("IP : ");

    Serial.println(WiFi.localIP());



    lcd.clear();

    lcd.setCursor(0,0);
    lcd.print("WiFi Connected");

    lcd.setCursor(0,1);
    lcd.print("SMART READY");



    delay(3000);

  }



  else{

    lcd.clear();

    lcd.setCursor(0,0);
    lcd.print("Mode Offline");

    lcd.setCursor(0,1);
    lcd.print("SMART DOOR");



    delay(3000);

  }



  // ================= READY =================

  lcd.clear();

  lcd.setCursor(0,0);
  lcd.print("Tempel Kartu");

  lcd.setCursor(0,1);
  lcd.print("RFID Anda");

}





// ================= LOOP =================

void loop() {



  // ================= CEK KARTU =================

  if (!rfid.PICC_IsNewCardPresent())
    return;



  if (!rfid.PICC_ReadCardSerial())
    return;



  // ================= BACA UID =================

  String uid = "";



  for (byte i = 0; i < rfid.uid.size; i++) {

    if (rfid.uid.uidByte[i] < 0x10) {

      uid += "0";

    }



    uid += String(
      rfid.uid.uidByte[i],
      HEX
    );

  }



  uid.toUpperCase();



  Serial.print("UID : ");

  Serial.println(uid);



  // ================= LCD MEMPROSES =================

  lcd.clear();

  lcd.setCursor(0,0);
  lcd.print("Memproses...");

  lcd.setCursor(0,1);
  lcd.print(uid);



  delay(2000);



  // ================= HTTP POST =================

  if (WiFi.status() == WL_CONNECTED) {

    HTTPClient http;



    http.begin(serverName);



    http.addHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );



    // ================= KIRIM UID =================

    String httpRequestData =
    "uid=" + uid;



    int httpResponseCode =
    http.POST(httpRequestData);



    String response =
    http.getString();



    response.trim();



    Serial.print("Response : ");

    Serial.println(response);



    // ================= AKSES DITERIMA =================

    if (response == "valid") {

      Serial.println("AKSES DITERIMA");



      // ================= LCD VALID =================

      lcd.clear();

      lcd.setCursor(0,0);
      lcd.print("AKSES");

      lcd.setCursor(0,1);
      lcd.print("DITERIMA");



      delay(3000);



      // ================= BUZZER PENDEK =================

      digitalWrite(BUZZER_PIN, HIGH);

      delay(200);

      digitalWrite(BUZZER_PIN, LOW);



      // ================= SERVO BUKA =================

      doorServo.write(180);

      Serial.println("SERVO TERBUKA");



      // ================= LCD TERBUKA =================

      lcd.clear();

      lcd.setCursor(0,0);
      lcd.print("PINTU TERBUKA");

      lcd.setCursor(0,1);
      lcd.print("WELCOME");



      // ================= DELAY 7 DETIK =================

      delay(7000);



      // ================= SERVO TUTUP =================

      doorServo.write(0);

      Serial.println("SERVO TERTUTUP");



      // ================= LCD TERKUNCI =================

      lcd.clear();

      lcd.setCursor(0,0);
      lcd.print("PINTU TERKUNCI");

      lcd.setCursor(0,1);
      lcd.print("SMART DOOR");



      delay(3000);

    }



    // ================= AKSES DITOLAK =================

    else {

      Serial.println("AKSES DITOLAK");



      // ================= LCD INVALID =================

      lcd.clear();

      lcd.setCursor(0,0);
      lcd.print("AKSES");

      lcd.setCursor(0,1);
      lcd.print("DITOLAK");



      // ================= BUZZER PANJANG =================

      digitalWrite(BUZZER_PIN, HIGH);

      delay(1000);

      digitalWrite(BUZZER_PIN, LOW);



      delay(5000);

    }



    // ================= KEMBALI NORMAL =================

    lcd.clear();

    lcd.setCursor(0,0);
    lcd.print("Tempel Kartu");

    lcd.setCursor(0,1);
    lcd.print("RFID Anda");



    http.end();

  }



  // ================= MODE OFFLINE =================

  else{

    lcd.clear();

    lcd.setCursor(0,0);
    lcd.print("WiFi Offline");

    lcd.setCursor(0,1);
    lcd.print("Tidak Terhubung");



    delay(3000);

  }



  // ================= STOP RFID =================

  rfid.PICC_HaltA();

  rfid.PCD_StopCrypto1();



  // ================= ANTI DOUBLE TAP =================

  delay(2000);

}