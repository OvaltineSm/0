#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "SUKIT";
const char* password = "159357456";
const char* serverUrl = "http://tersornpat.3bbddns.com:24817/0/get_lastest_command.php";

String lastCommand = "";
unsigned long lastCommandTime = 0;
unsigned long lastCheckTime = 0;
const unsigned long checkInterval = 500; // Check every 5 seconds

enum RequestState {
  IDLE,
  WAITING_TO_START,
  IN_PROGRESS
};

RequestState requestState = IDLE;
unsigned long requestStartTime = 0;
const unsigned long requestTimeout = 10000; // 10 second timeout

void setup() {
  Serial.begin(115200);
  delay(2000); // Wait for Serial Monitor to initialize
  
  Serial.println("\n\n===== ESP32 D-pad Controller =====");
  Serial.println("Starting...");
  
  WiFi.begin(ssid, password);
  
  Serial.print("Connecting to WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  unsigned long currentTime = millis();
  
  // Check WiFi connection
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi disconnected. Attempting to reconnect...");
    WiFi.reconnect();
    delay(1000);
    return;
  }
  
  // Start a new request if it's time and no request is in progress
  if (requestState == IDLE && (currentTime - lastCheckTime >= checkInterval)) {
    Serial.println("\n----- Checking for new commands -----");
    lastCheckTime = currentTime;
    requestState = WAITING_TO_START;
  }
  
  // Handle HTTP request states
  if (requestState == WAITING_TO_START) {
    fetchCommand();
  }
  
  // Do other tasks here while waiting for next HTTP request
  // For example:
  // checkSensors();
  // updateDisplay();
  
  // Small delay to prevent CPU hogging
  delay(50);
}

void fetchCommand() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    
    Serial.print("Connecting to server: ");
    Serial.println(serverUrl);
    
    http.begin(serverUrl);
    Serial.println("Sending HTTP request...");
    
    int httpCode = http.GET();
    
    Serial.print("HTTP Response code: ");
    Serial.println(httpCode);
    
    if (httpCode > 0) {
      String payload = http.getString();
      
      // Debug: Print the raw payload with character codes
      Serial.println("Raw response payload:");
      for (int i = 0; i < payload.length(); i++) {
        Serial.print(payload[i]);
        Serial.print(" (");
        Serial.print((int)payload[i], DEC);
        Serial.print(") ");
      }
      Serial.println();
      
      // Try to clean the payload
      payload.trim();
      
      // Check if payload is empty
      if (payload.length() == 0) {
        Serial.println("Empty payload received");
        http.end();
        requestState = IDLE;
        return;
      }
      
      // Try to detect if it's JSON by checking for { or [ at the beginning
      if (payload[0] != '{' && payload[0] != '[') {
        Serial.println("Response doesn't appear to be JSON. Trying to extract JSON portion...");
        
        // Try to find JSON start
        int jsonStart = payload.indexOf('{');
        if (jsonStart == -1) jsonStart = payload.indexOf('[');
        
        // Try to find JSON end
        int jsonEnd = payload.lastIndexOf('}');
        if (jsonEnd == -1) jsonEnd = payload.lastIndexOf(']');
        
        if (jsonStart != -1 && jsonEnd != -1 && jsonEnd > jsonStart) {
          payload = payload.substring(jsonStart, jsonEnd + 1);
          Serial.print("Extracted JSON: ");
          Serial.println(payload);
        } else {
          Serial.println("Could not extract valid JSON from response");
          http.end();
          requestState = IDLE;
          return;
        }
      }
      
      // Parse JSON
      DynamicJsonDocument doc(1024);
      DeserializationError error = deserializeJson(doc, payload);
      
      if (error) {
        Serial.print("JSON parsing failed: ");
        Serial.println(error.c_str());
        
        // Try with a larger buffer if the error might be related to size
        if (error == DeserializationError::NoMemory) {
          DynamicJsonDocument largerDoc(2048);
          error = deserializeJson(largerDoc, payload);
          
          if (!error) {
            Serial.println("JSON parsed successfully with larger buffer");
            doc = largerDoc;
          } else {
            Serial.println("JSON parsing still failed with larger buffer");
            http.end();
            requestState = IDLE;
            return;
          }
        } else {
          http.end();
          requestState = IDLE;
          return;
        }
      } else {
        Serial.println("JSON parsed successfully");
      }
      
      // Check for commands
      if (doc.containsKey("direction")) {
        String direction = doc["direction"];
        String timestamp = doc["timestamp"];
        
        Serial.print("Command found - Direction: ");
        Serial.println(direction);
        Serial.print("Timestamp: ");
        Serial.println(timestamp);
        
        executeCommand(direction);
      } else if (doc.containsKey("status")) {
        String status = doc["status"];
        Serial.print("Status message: ");
        Serial.println(status);
      } else {
        Serial.println("No command or status found in response");
      }
    } else {
      Serial.print("HTTP request failed, error: ");
      Serial.println(http.errorToString(httpCode).c_str());
    }
    
    http.end();
    Serial.println("HTTP connection closed");
  }
  
  requestState = IDLE;
}

void executeCommand(String direction) {
  Serial.print("Executing command: ");
  Serial.println(direction);
  
  if (direction == "ขึ้น (UP)") {
    Serial.println("ACTION: Moving forward");
  } 
  else if (direction == "ลง (DOWN)") {
    Serial.println("ACTION: Moving backward");
  }
  else if (direction == "ซ้าย (LEFT)") {
    Serial.println("ACTION: Turning left");
  }
  else if (direction == "ขวา (RIGHT)") {
    Serial.println("ACTION: Turning right");
  }
  else {
    Serial.print("ACTION: Unknown command - ");
    Serial.println(direction);
  }
}