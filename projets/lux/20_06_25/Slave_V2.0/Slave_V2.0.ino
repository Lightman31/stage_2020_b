#include <Wire.h>

#define SLAVE_ADDR 9

#define VITESSE 1000
int value = 2000;
int pos = 0;

/////////////////////////////////////////////
// MOTEUR
/////////////////////////////////////////////
// Connections to A4988
const int dirPin = 2;  // Direction
const int stepPin = 3; // Step

// Motor steps per rotation
const int STEPS_PER_REV = 400;

void setup() {
  Wire.begin(SLAVE_ADDR);

  Wire.onReceive(receiveEvent);
Serial.begin(19200);
  
/////////////////////////////////////////////
// MOTEUR
/////////////////////////////////////////////
  pinMode(stepPin,OUTPUT); 
  pinMode(dirPin,OUTPUT);

}


void receiveEvent()
{
  value = 0;
  int trame[5] = {0};
  int cpt = 0;
  while (Wire.available())
  {
    char c = (Wire.read());
    if (c == 'A') {trame[cpt] = 0;}
    else { trame[cpt] = int (c);} 
    
    cpt = cpt +1;
    //Serial.print(c);
  }

    
    value = 0;
    value = trame[4] * 10000 + trame[3] * 1000 + trame[2] * 100 + trame[1] * 10 + trame[0] ;
    Serial.println( "coucou" );

  

}


void loop() {
  int dir = 0;
  dir = value - pos;
  if (dir != 0)
  {
    if (dir <= 0)
    {
      digitalWrite(dirPin,HIGH); 
    }
    else if (dir >= 0 )
    {
      digitalWrite(dirPin,LOW); 
    }
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(VITESSE); 
    digitalWrite(stepPin,LOW); 
    delayMicroseconds(VITESSE);
           
    if (dir >= 0)
    {
      pos = pos + 1;
    }
    else 
    {
      pos = pos -1;
    }
  }
  

  
}
