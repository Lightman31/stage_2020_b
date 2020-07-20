#include "EtherCard.h"
#include <SPI.h>
#include <RFID.h>

// ethernet interface mac address, must be unique on the LAN
static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x32 };
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

int noteDurations[] = {
  8, 8
};
int melody[] = {
  450, 550
};



void setup () 
{
  pinMode(4,OUTPUT);
  //Serial.begin(115200);
  SPI.begin();
  monModuleRFID.init(); 
  //Serial.println("\n[Multiple browseUrl request example");

  if (ether.begin(sizeof Ethernet::buffer, mymac, 8) == 0) 
  {
    //Serial.println( "Error:Ethercard.begin");
    while(true);
  }

  if (!ether.dhcpSetup())
  {
    //Serial.println("DHCP failed");
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
  //Serial.println("Start");
}

void loop () 
{
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
        //Serial.println(UID_carte);
        digitalWrite(4,HIGH); 
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
            ether.browseUrl(PSTR("http://192.168.0.131/test/SAVTracker/arduino/update_SAV_zone_E.php?UID="),UID_carte, website, browseUrlCallback1);
            state=2;// Go to state to wait for response from browseURL
            timer = millis() + TIMEOUT_MS;// 5 second timeout
            break;
             case 2:
             if (millis() > timer)
             {
              // timeout waiting for response
              state=1;
              //Serial.println("TIMOEOUT");
             }
             // waiting for response from previois calback
             ether.packetLoop(ether.packetReceive());
             break;
            break;
             case 5:
              son();
              digitalWrite(4,LOW);
              delay(500);
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
   //Serial.println((char *)(Ethernet::buffer+off));
   state=5;// Move to state that causes next browseUrl
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
