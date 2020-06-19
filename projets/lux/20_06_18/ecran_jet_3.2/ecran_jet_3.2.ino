#include "Adafruit_Keypad.h"

#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library
#include <SPI.h>

#define KEYPAD_PID3844
#define R1    42
#define R2    43
#define R3    44
#define R4    45
#define C1    36
#define C2    37
#define C3    38
#define C4    39
#include "keypad_config.h"

//Use these pins for the shield!
#define sclk 52
#define mosi 51
#define cs   53
#define dc   8
#define rst  5  // you can also connect this to the Arduino reset

#define NOTE 392

#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library
#include <SPI.h>

#if defined(__SAM3X8E__)
#undef __FlashStringHelper::F(string_literal)
#define F(string_literal) string_literal
#endif
Adafruit_ST7735 tft = Adafruit_ST7735(cs, dc, rst);

#define Neutral 0
#define Press 1
#define Up 2
#define Down 3
#define Right 4
#define Left 5

#define NBPOINT 6

#define NOIR ST7735_BLACK
#define ROUGE ST7735_RED
#define JAUNE ST7735_YELLOW
#define BLEU ST7735_BLUE
#define VERT ST7735_GREEN
#define BLANC ST7735_WHITE

Adafruit_Keypad customKeypad = Adafruit_Keypad( makeKeymap(keys), rowPins, colPins, ROWS, COLS);

/////////////////////////////////////////////
// MOTEUR
/////////////////////////////////////////////
// Connections to A4988
const int dirPin = 2;  // Direction
const int stepPin = 3; // Step

// Motor steps per rotation
const int STEPS_PER_REV = 400;


/////////////////////////////////////////////
// Boutons de contrôle 
/////////////////////////////////////////////
const int button_mooveRight = 22;
const int button_mooveLeft = 24;
const int button_mesure_lancement = 32;
const int button_mesure_pt_suivant = 34;
// variables will change:
int buttonState = 0;         // variable for reading the pushbutton status
float supossedpos = 0 ; // position voulue par l'homme
float actualpos = 0 ; // position réelle du chariot

float savedVal[NBPOINT];
bool pointused[NBPOINT] = {false};
char* text;

int MusiquePin = 10;





void setup() {
  

  customKeypad.begin();

    // Setup the pins as Outputs
  pinMode(stepPin,OUTPUT); 
  pinMode(dirPin,OUTPUT);

  pinMode(button_mooveRight, INPUT);
  pinMode(button_mooveLeft, INPUT);
  pinMode(button_mesure_lancement, INPUT);
  pinMode(button_mesure_pt_suivant, INPUT);

  tft.initR(INITR_BLACKTAB);

  initialaff();
}

void loop() {
  customKeypad.tick();
  while (customKeypad.available()) {
    keypadEvent e = customKeypad.read();


    if ((char)e.bit.KEY == '1' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(0);
    }
    if ((char)e.bit.KEY == '2' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(1);
    }
    if ((char)e.bit.KEY == '3' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(2);
    }
    if ((char)e.bit.KEY == '4' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(3);
    }
    if ((char)e.bit.KEY == '5' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(4);
    }
    if ((char)e.bit.KEY == '6' && e.bit.EVENT == KEY_JUST_RELEASED)
    {
      positionchoosed(5);
    }
  }
  // boutons de déplacement du chariot
  buttonState = digitalRead(button_mooveRight);
  if (buttonState == HIGH) {
    hideCurrentPos();
    supossedpos = supossedpos - 0.01;
    affCurrentPos();
  }

  buttonState = digitalRead(button_mooveLeft);
  if (buttonState == HIGH) {
    hideCurrentPos();
    supossedpos = supossedpos + 0.01;
    affCurrentPos();
  }
  
  float joystickValue = analogRead(A0);
  if (joystickValue < 340 || joystickValue > 350)
  {
    hideCurrentPos();
    supossedpos = supossedpos +  (joystickValue - 345) / 200;
    affCurrentPos();
  }



  buttonState = digitalRead(button_mesure_lancement);
  if (buttonState == HIGH) {
    throwMesure();
  }

  delay (200);
}





void throwMesure()
{
  int nextpoint = 0;
  gotopoint(nextpoint);
  while (nextpoint < NBPOINT - 1)
  {

    buttonState = digitalRead(button_mesure_pt_suivant);
    if (buttonState == HIGH)
    {
      nextpoint = nextpoint + 1;
      gotopoint(nextpoint);
    }
  }


}

void gotopoint(int point)
{
  float vect;
  if (pointused[point] == true)
  {

    if (supossedpos > savedVal[point])
    {
      vect = -0.01;
    }
    else
    {
      vect = -0.01;
    }
    hideCurrentPos();
    supossedpos = savedVal[point];

    affCurrentPos();
    tone(MusiquePin, NOTE, 50);
    delay(200);
    tone(MusiquePin, 450, 50);
    delay(200);
  }


}


void clearscreen()
{
  tft.fillScreen(NOIR);
}

void positionchoosed(int number)
{
  tft.setTextColor(NOIR);
  tft.setTextSize(1);
  tft.setCursor(20, 50 + 10 * number);
  tft.print(savedVal[number]);
  savedVal[number] = supossedpos;
  pointused[number] = true;
  tft.setTextColor(VERT);
  tft.setTextWrap(true);
  tft.setCursor(0, 50 + 10 * number);
  tft.print(number + 1);
  tft.setCursor(10, 50 + 10 * number);
  tft.print(":");
  tft.setCursor(20, 50 + 10 * number);
  tft.print(savedVal[number]);
}

void testdrawtext(char *text, uint16_t color, int cursor_x, int cursor_y, int taille) {
  tft.setTextWrap(true);
  tft.setCursor(cursor_x, cursor_y);
  tft.setTextColor(color);
  tft.setTextSize(taille);
  tft.print(text);
}

void initialisationazero()
{
  while (supossedpos >= 0)
  {
    Serial.println(supossedpos);
    supossedpos = supossedpos - 0.05;
    delay(1);
  }
  Serial.println(supossedpos);
  delay (1500);

  supossedpos = 2;
  Serial.println(supossedpos);

  while (supossedpos >= 0)
  {
    Serial.println(supossedpos);
    supossedpos = supossedpos - 0.01;
    delay(20);
  }
  Serial.println(supossedpos);
  delay (1500);



}

void initialaff()
{
  tft.setCursor(0, 30);
  clearscreen();
  affCurrentPos();
  testdrawtext("1", ROUGE, 0, 50, 1);
  testdrawtext("2", ROUGE, 0, 60, 1);
  testdrawtext("3", ROUGE, 0, 70, 1);
  testdrawtext("4", ROUGE, 0, 80, 1);
  testdrawtext("5", ROUGE, 0, 90, 1);
  testdrawtext("6", ROUGE, 0, 100, 1);
}


void hideCurrentPos()
{
  tft.setTextWrap(true);
  tft.setCursor(10, 10);
  tft.setTextColor(NOIR);
  tft.setTextSize(2);
  tft.print(supossedpos);
}
void affCurrentPos()
{
  tft.setTextWrap(true);
  tft.setCursor(10, 10);
  tft.setTextColor(BLANC);
  tft.setTextSize(2);
  tft.print(supossedpos);
}

void moove_chariot()
{
  int sens = actualpos - suposedpos;

  letempsdepas = 1000;
  if (sens >= 0){
    digitalWrite(dirPin,HIGH); 
    
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(letempsdepas); 
    digitalWrite(stepPin,LOW); 
    delayMicroseconds(letempsdepas);
    suposedpos = suposedpos +1;
  }
  else {
    digitalWrite(stepPin,LOW); 
    digitalWrite(stepPin,HIGH); 
    delayMicroseconds(letempsdepas); 
    digitalWrite(stepPin,LOW); 
  delayMicroseconds(letempsdepas); 
  suposedpos = suposedpos -1;
  }




  
}
