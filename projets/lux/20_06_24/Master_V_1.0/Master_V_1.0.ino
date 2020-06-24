#include <Wire.h>


#define SLAVE_ADDR 9

int analogPin = 0;
int val = 0;


void setup() {
  
  Wire.begin();
}

void loop() {
  // put your main code here, to run repeatedly:
  val = analogRead(analogPin);
  char tosend[5];

  tosend[0] = char(val%10);
  val = val-val%10;
  
  tosend[1] = char((val%100)/ 10);
  val = val-val%100;
  
  tosend[2] = char((val%1000)/ 100);
  val = val-val%1000;
  
  tosend[3] = char((val%10000)/ 1000);
  val = val-val%10000;
  
  tosend[4] = char((val%100000)/ 10000);
  val = val-val%100000;
  
  Wire.beginTransmission(SLAVE_ADDR);
  Wire.write(tosend);
  Wire.endTransmission();
  delay (500);

}
