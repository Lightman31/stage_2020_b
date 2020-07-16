#include "Adafruit_Keypad.h"
#include "EtherCard.h"
#include <SPI.h>
#include <RFID.h>
#include <LiquidCrystal_I2C.h>

//déclaration adresse I2C de l'écran LCD
LiquidCrystal_I2C lcd(0x27, 2, 1, 0, 4, 5, 6, 7, 3, POSITIVE);

// ethernet interface mac address, must be unique on the LAN
static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x31 };
const char website[] PROGMEM = "192.168.0.131";
byte Ethernet::buffer[700];
static uint32_t timer;
int state;
#define TIMEOUT_MS 5000

//Déclaration Module RFID sur les pins 10 & 9
RFID monModuleRFID(10,9);
int UID[5];
char UID_carte[27] = {0};
String UID_carte_s;
bool comp = true;
bool scan = true;

//Déclaration des pins du clavier

#define KEYPAD_PID3844
#define R1    7
#define R2    6
#define R3    5
#define R4    4
#define C1    A3
#define C2    A2
#define C3    A1
#define C4    A0
#include "keypad_config.h"
Adafruit_Keypad customKeypad = Adafruit_Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS);


int noteDurations[] = {
  8, 8
};
int melody[] = {
  450, 550
};

int j = 0;
char SAV[20];
char car;

void setup () 
{
  Serial.begin(115200);
  SPI.begin();
  lcd.begin(20,4);
  lcd.setCursor(0,0);
  lcd.print("Num SAV : ");
  
  monModuleRFID.init(); 
  //Serial.println("\n[Multiple browseUrl request example");

  if (ether.begin(sizeof Ethernet::buffer, mymac, 8) == 0) 
  {
    //Serial.println( "Error:Ethercard.begin");
    while(true);
  }

  if (!ether.dhcpSetup())
  {
    while(true);
  }
  
  //ether.printIp("IP:  ", ether.myip);
  //ether.printIp("GW:  ", ether.gwip);  
  //ether.printIp("DNS: ", ether.dnsip); 
  
#if 0
  // Wait for link to become up - this speeds up the dnsLoopup in the current version of the Ethercard library
  while (!ether.isLinkUp())
  {
      ether.packetLoop(ether.packetReceive());
  }
#endif
long t=millis();
  if (!ether.dnsLookup(website,false))
  {
    //Serial.println("DNS failed. Unable to continue.");
    while (true);
  }
  
  state=0;
  customKeypad.begin();
  Serial.println("Start");
}

void loop () 
{
  keypad_val();
  //RFID
    if (monModuleRFID.isCard()) 
    {  
      if (monModuleRFID.readCardSerial()) //Si on detecte une carte RFID
      { 
        for(int i=0;i<=4;i++) 
        {
          if (UID[i] != monModuleRFID.serNum[i]) //On compare les UID pour ne pas scanner 2x la même carte
          { 
            comp = false;
          }
        }
      }
      monModuleRFID.halt();
    }
    if (comp == false) //Si cartes différentes
    { 
      if (scan == true) 
      {
      UID_carte_s="";
        for(int i=0;i<=4;i++)
        {
          UID[i]=monModuleRFID.serNum[i]; //On récupère l'UID 
        }  
        for (int k=0;k<5;k++) 
        {
          if (UID[k]<100) 
          {
            if (UID[k]<10) 
            {
              UID_carte_s.concat("0");
            }
            UID_carte_s.concat("0");
          }
          UID_carte_s.concat((String)UID[k]);
        }    
        scan = false;
        for (int j=0;j<15;j++)
        {
          UID_carte[j]=UID_carte_s[j];
        }         
        UID_carte[15]={'&'};
        UID_carte[16]={'S'};
        UID_carte[17]={'='};
        for(int h=0;h<=7;h++) {
          if(h==2) {UID_carte[20]={'-'};}
          else {UID_carte[18+h]=SAV[h];};
        }
        Serial.println(UID_carte);
      }    
        
        byte len;
        //ether.packetLoop(ether.packetReceive());
        switch (state)
        {
          case 0:
          if (millis() > timer) 
          {
          timer = millis() + 150;// every 30 secs
          state=1;
          }
          break;
           case 1:
            while(ether.packetLoop(ether.packetReceive()));            
            ether.browseUrl(PSTR("http://192.168.0.131/test/SAVTracker/arduino/creation_sav.php?UID="),UID_carte, website, browseUrlCallback1);
            state=2;// Go to state to wait for response from browseURL
            timer = millis() + TIMEOUT_MS;// 5 second timeout
            break;
             case 2:
             if (millis() > timer)
             {
              // timeout waiting for response
              state=1;
              Serial.println("TIMOEOUT");
             }
             // waiting for response from previois calback
             ether.packetLoop(ether.packetReceive());
             break;
            break;
             case 5:
              REC();
              comp = true;
              scan = true;
              // waiting for response from previois calback
              while( ether.packetLoop(ether.packetReceive()));
              state=0;
             break;
          default:
          break;
        }
    }
}

// Called for each packet of returned data from the call to browseUrl (as persistent mode is set just before the call to browseUrl)
static void browseUrlCallback1 (byte status, word off, word len) 
{
   Ethernet::buffer[off+len] = 0;// set the byte after the end of the buffer to zero to act as an end marker (also handy for displaying the buffer as a string)
   
   //Serial.println("Callback 1");
   Serial.println((char *)(Ethernet::buffer+off));
   state=5;// Move to state that causes next browseUrl
}

void keypad_val() {
  customKeypad.tick();
  while (customKeypad.available()) { //Si le keypad est disponible
    keypadEvent e = customKeypad.read(); //On lit l'event
    if(e.bit.EVENT == KEY_JUST_PRESSED) { //Quand une touche est pressée
      car = (char)e.bit.KEY; //la variable car rècupère le caractère 
      lcd.setCursor(j,1); //on place le curseur
      if(car == '*') //Le bouton * signifie effacer
      { 
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

  lcd.setCursor(5,4);
  lcd.print("Validation");
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
}

void son()
{
  // iterate over the notes of the melody:
  for (int thisNote = 0; thisNote < 2; thisNote++) {

    // to calculate the note duration, take one second divided by the note type.
    //e.g. quarter note = 1000 / 4, eighth note = 1000/8, etc.
    int noteDuration = 1000 / noteDurations[thisNote];
    tone(3, melody[thisNote], noteDuration);

    // to distinguish the notes, set a minimum time between them.
    // the note's duration + 30% seems to work well:
    int pauseBetweenNotes = noteDuration * 1.30;
    delay(pauseBetweenNotes);
    // stop the tone playing:
    noTone(3);
  }
}

void tir() { 
  lcd.setCursor(j,1);
  lcd.print("-");
  j=j+1;
}
