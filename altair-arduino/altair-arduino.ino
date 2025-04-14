const int sensorPin = A0; // Аналоговый пин для первого датчика уровня воды
const int sensorPin2 = A1; // Аналоговый пин для второго датчика уровня воды
const int relayPin = 10; // Цифровой пин для управления первым реле
const int relayPin2 = 11; // Цифровой пин для управления вторым реле
float volume_start = 0.63;
float volume_final = 0;

int sensorValue; // Переменная для хранения значения первого датчика
int sensorValue2; // Переменная для хранения значения второго датчика

int threshold = 300; // Пороговое значение для первого датчика
int threshold2 = 400; // Пороговое значение для второго датчика

unsigned long lastPumpOnTime = 0; // Время последнего включения первого насоса
unsigned long lastPumpOnTime2 = 0; // Время последнего включения второго насоса
bool pumpState = true; // Состояние первого насоса (true - включен, false - выключен)
bool pumpState2 = true; // Состояние второго насоса (true - включен, false - выключен)

void setup() {
  Serial.begin(9600); // Инициализация последовательного порта
  pinMode(sensorPin, INPUT); // Настройка пина первого датчика как входного
  pinMode(sensorPin2, INPUT); // Настройка пина второго датчика как входного
  pinMode(relayPin, OUTPUT); // Настройка пина первого реле как выходного
  pinMode(relayPin2, OUTPUT); // Настройка пина второго реле как выходного
  digitalWrite(relayPin, HIGH); // Включить первый насос при запуске
  digitalWrite(relayPin2, HIGH); // Включить второй насос при запуске
}

void loop() {
  sensorValue = analogRead(sensorPin); // Считывание значения первого датчика
  sensorValue2 = analogRead(sensorPin2); // Считывание значения второго датчика
  Serial.print("Значение датчика 1: ");
  Serial.println(sensorValue);
  Serial.print("Значение датчика 2: ");
  Serial.println(sensorValue2);
  Serial.print("Очищено воды (литров): ");
  Serial.println(volume_final);

  // Управление первым насосом
  if (sensorValue > threshold) {
    if (pumpState == true) { // Первый насос был включен
      digitalWrite(relayPin, LOW); // Выключить первое реле
      pumpState = false; // Изменить состояние первого насоса на "выключен"
      lastPumpOnTime = millis(); // Запомнить время выключения первого насоса
      volume_final = volume_final + volume_start;
      return volume_final;
    }
  }
    if (pumpState == false && millis() - lastPumpOnTime >= 5000) {
      digitalWrite(relayPin, HIGH); // Включить первое реле после 30 секунд
      pumpState = true; // Изменить состояние первого насоса на "включен"
      lastPumpOnTime = millis(); // Обновить время выключения первого насоса
    }

  // Управление вторым насосом
  if (sensorValue2 < threshold2) {
    if (pumpState2 == true) { // Второй насос был выключен
      digitalWrite(relayPin2, LOW); // Включить второе реле
      pumpState2 = false; // Изменить состояние второго насоса на "включен"
      lastPumpOnTime2 = millis(); // Запомнить время включения второго насоса
    }
  } else {
    if (pumpState2 == false && millis() - lastPumpOnTime2 >= 5000) {
      digitalWrite(relayPin2, HIGH); // Выключить второе реле после 30 секунд
      pumpState2 = true; // Изменить состояние второго насоса на "выключен"
      lastPumpOnTime2 = millis(); // Обновить время включения второго насоса
    }
  }

  delay(7000);
}