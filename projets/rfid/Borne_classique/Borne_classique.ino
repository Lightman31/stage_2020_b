#include <SPI.h>
#include <RFID.h>

RFID monModuleRFID(10,9);

int UID[5];
bool comp = false;
// note durations: 4 = quarter note, 8 = eighth note, etc.:
int noteDurations[] = {
  8, 8
};
int melody[] = {
  450, 550
};

void setup()
{
  Serial.begin(9600);
  SPI.begin();
  monModuleRFID.init();  
  pinMode(5, OUTPUT);
}

void loop()
{
  //RFID
    if (monModuleRFID.isCard()) {  
          if (monModuleRFID.readCardSerial()) {
            for(int i=0;i<=4;i++) {
              if (UID[i] == monModuleRFID.serNum[i]) {
                comp = true;
              }
              else {
                comp = false;
              }
            }
            if (comp == false) {
               son();        
               delay(100);
               Serial.print("L'UID est: ");
               for(int i=0;i<=4;i++)
               {
                 UID[i]=monModuleRFID.serNum[i];
                 Serial.print(UID[i],DEC);
                 Serial.print(".");
               }
               Serial.println("");
            }
          }          
          monModuleRFID.halt();
          digitalWrite(5,LOW);
    }
    delay(1);    
}

void son()
{
  digitalWrite(5,HIGH);
  // iterate over the notes of the melody:
  for (int thisNote = 0; thisNote < 2; thisNote++) {

    // to calculate the note duration, take one second divided by the note type.
    //e.g. quarter note = 1000 / 4, eighth note = 1000/8, etc.
    int noteDuration = 1000 / noteDurations[thisNote];
    tone(8, melody[thisNote], noteDuration);

    // to distinguish the notes, set a minimum time between them.
    // the note's duration + 30% seems to work well:
    int pauseBetweenNotes = noteDuration * 1.30;
    delay(pauseBetweenNotes);
    // stop the tone playing:
    noTone(8);
  }
}
