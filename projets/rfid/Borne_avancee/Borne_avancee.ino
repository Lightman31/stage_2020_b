//On include les bibliotheques

#include <SPI.h>
#include <RFID.h>
#include "Adafruit_Keypad.h"
#include <LiquidCrystal_I2C.h>

//déclaration adresse I2C de l'écran LCD
LiquidCrystal_I2C lcd(0x27, 2, 1, 0, 4, 5, 6, 7, 3, POSITIVE);

//Déclaration Module RFID sur les pins 10 & 9
RFID monModuleRFID(10,9);

int UID[5];
int j = 0;
char SAV[20];
char car;
bool comp = false;
int noteDurations[] = {
  8, 8
};
int melody[] = {
  450, 550
};

//Déclaration des pins du clavier

#define KEYPAD_PID3844
#define R1    6
#define R2    7
#define R3    5
#define R4    4
#define C1    A3
#define C2    A2
#define C3    A1
#define C4    A0
#include "keypad_config.h"
Adafruit_Keypad customKeypad = Adafruit_Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS);


void setup()
{
  Serial.begin(9600);
  SPI.begin();
  monModuleRFID.init();  
  pinMode(3, OUTPUT);
  customKeypad.begin();
  lcd.begin(20,4);
  lcd.setCursor(0,0);
  lcd.print("Num SAV : ");
}

void loop()
{
  //RFID
    if (monModuleRFID.isCard()) {  
          if (monModuleRFID.readCardSerial()) { //Si on detecte une carte RFID
            for(int i=0;i<=4;i++) {
              if (UID[i] == monModuleRFID.serNum[i]) { //On compare les UID pour ne pas scanner 2x la même carte
                comp = true;
              }
              else {
                comp = false;
              }
            }
            if (comp == false) { //Si cartes différentes
               
               for(int i=0;i<=4;i++)
               {
                 UID[i]=monModuleRFID.serNum[i]; //On récupère l'UID     
               }
               
               REC(); //On enregistre le numéro de SAV et on affichage la validation
               
            }
          }          
          monModuleRFID.halt();
          
    }
    delay(1);  
    //détection clavier
    keypad_val();
    
}

void son()
{
  
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

void keypad_val() {
  customKeypad.tick();
  while (customKeypad.available()) { //Si le keypad est disponible
    
    keypadEvent e = customKeypad.read(); //On lit l'event
    if(e.bit.EVENT == KEY_JUST_PRESSED) { //Quand une touche est pressée
      car = (char)e.bit.KEY; //la variable car rècupère le caractère 

      
      lcd.setCursor(j,1); //on place le curseur


      
      if(car == '*') { //Le bouton * signifie effacer
        j = j-1; //On revient un cran en arrière
        SAV[j] = NULL; //On efface dans le numéro de SAV
        lcd.setCursor(j,1);
        lcd.print(" "); //On efface sur l'écran
        clrline(3); //On efface "Validation" si affiché
      }
      else if (car == 'A') { //Bouton d'enregistrement
        REC();
      }
      else { //Si on appuie sur n'importe quel autre bouton
        
        SAV[j] = car; //On écrit le caractère dans le numéro de SAV
        lcd.print(car); //On affiche à l'écran
        if (j<20) { //Si on va trop à droite, on retourne à gauche
          j = j + 1;
        }
        else {j=0;}
        clrline(3); 
      }

      if(j==2 && car != '*') { //Si on atteint le 3eme caractère sans retour en arrière, on affiche le tiret
        tir();
      }
    }
  }
}

void clrline(int line) { //permet d'effacer la ligne de son choix
  for (int m=0;m<20;m++) {
    lcd.setCursor(m,line);
    lcd.print(" ");
  }
}

void REC() { //fonction de validation
  digitalWrite(3,HIGH);
  lcd.setCursor(5,4);
  lcd.print("Validation");
  for (int l=0;l<20;l++) {
    Serial.print(SAV[l]); //On affiche le numéro de SAV en Serial
  }
  Serial.println("");
  son();
  delay(500);
  while(j>2) { //On efface tout après le tiret
    //Serial.print(j);
    lcd.setCursor(j,1); //On efface l'écran
    lcd.print(" ");
    SAV[j] = NULL; //On efface dans le numéro de SAV
    j = j-1;
  }
  tir();
  clrline(3);
  digitalWrite(3,LOW); //On éteint la LED
}


void tir() { 
  lcd.setCursor(j,1);
  lcd.print("-");
  j=j+1;
}
