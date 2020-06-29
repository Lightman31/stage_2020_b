#include <Wire.h>

#define SLAVE_ADDR 9

#define ANSWERSIZE 5

#define VITESSE 1000
int value = 0;
int pos = 0;
int trame[5];
int cpt;
int buttonPin = 9;

/////////////////////////////////////////////
// MOTEUR
/////////////////////////////////////////////
// Connections to A4988
const int dirPin = 2;  // Direction
const int stepPin = 3; // Step

// Motor steps per rotation
const int STEPS_PER_REV = 400;

void setup() {
  Wire.begin(); 
  
/////////////////////////////////////////////
// MOTEUR
/////////////////////////////////////////////
  pinMode(stepPin,OUTPUT); 
  pinMode(dirPin,OUTPUT);

  pinMode(buttonPin, INPUT);

  setToInit();

}




void loop() {
  /*
  Serial.print("read : ");
  Serial.println(value);
  Serial.print("position : ");
  Serial.println(pos);
  */
  int dir = 0;
  dir = value - pos;
  if (dir != 0)
  {
    if (dir <= 0)
    {
      digitalWrite(dirPin,LOW); 
    }
    else if (dir >= 0 )
    {
      digitalWrite(dirPin,HIGH); 
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

  
  if (dir == 0)
  {
    Wire.requestFrom(SLAVE_ADDR, ANSWERSIZE);
    //String reponse = "";
    cpt = 0;
    while(Wire.available())
    {
      char b = Wire.read();
      //reponse += b;    
      trame[cpt] = int (b);
  Serial.print(trame[cpt]);
    
    cpt = cpt +1;
    }
    value = trame[0] + trame[1] * 10 + trame[2] * 100 + trame[3] * 1000 + trame[4] * 10000;
  //Serial.println("recived : ");
    delay(200);
  }
  

  
}



void setToInit()
{
  int fin = 0;
  int buttonState;

  
  digitalWrite(dirPin,LOW); 

  while (fin == 0)
  {
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(VITESSE); 
    digitalWrite(stepPin,LOW); 
    delayMicroseconds(VITESSE);
     
      
    buttonState = digitalRead(buttonPin);
    if (buttonState == HIGH) {
      fin = 1;
    } 
  }
  
  digitalWrite(dirPin,HIGH); 
  
  for (int i = 0 ; i < 200 ; i ++)
  {
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(VITESSE); 
    digitalWrite(stepPin,LOW); 
    delayMicroseconds(VITESSE);
  }
  fin = 0;
  digitalWrite(dirPin,LOW); 
    while (fin == 0)
  {
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(VITESSE * 4); 
    digitalWrite(stepPin,LOW); 
    delayMicroseconds(VITESSE * 4);
     
      
    buttonState = digitalRead(buttonPin);
    if (buttonState == HIGH) {
      fin = 1;
    } 
  }

  pos = 0;
  
}
