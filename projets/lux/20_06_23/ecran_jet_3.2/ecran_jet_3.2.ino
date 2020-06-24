#include "Adafruit_Keypad.h"

#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library
#include <SPI.h>
#include <Wire.h>


#define SLAVE_ADDR 9


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
#define mosi 51 //SDA
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
// Boutons de contrôle 
/////////////////////////////////////////////
const int button_mesure_lancement = 32;
const int button_mesure_pt_suivant = 34;
// variables will change:
int buttonState = 0;         // variable for reading the pushbutton status
int supossedpos = 0 ; // position voulue par l'homme
int actualpos = 0 ; // position réelle du chariot

float savedVal[NBPOINT];
bool pointused[NBPOINT] = {false};
char* text;

int MusiquePin = 10;





void setup() {
  

  customKeypad.begin();
  Wire.begin();

  pinMode(button_mesure_lancement, INPUT);
  pinMode(button_mesure_pt_suivant, INPUT);

  Serial.begin(9600);
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

  
  float joystickValue = analogRead(A0) ;
  if (joystickValue < 510 || joystickValue > 525)
  {
    hideCurrentPos();
    supossedpos = supossedpos + ( (joystickValue - 516) / 40 ) * (( analogRead(A2)/40)+1);
    affCurrentPos();
  }



  buttonState = digitalRead(button_mesure_lancement);
  if (buttonState == HIGH) {
    throwMesure();
  }
  int memory = actualpos;
  moove_chariot();

  delay(200);
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
      vect = -1;
    }
    else
    {
      vect = -1;
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
  tft.setCursor(20, 70 + 10 * number);
  tft.print(savedVal[number]);
  savedVal[number] = supossedpos;
  pointused[number] = true;
  tft.setTextColor(VERT);
  tft.setTextWrap(true);
  tft.setCursor(0, 70 + 10 * number);
  tft.print(number + 1);
  tft.setCursor(10, 70 + 10 * number);
  tft.print(":");
  tft.setCursor(20, 70 + 10 * number);
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
    supossedpos = supossedpos - 1;
    delay(1);
  }
  Serial.println(supossedpos);
  delay (1500);

  supossedpos = 2;
  Serial.println(supossedpos);

  while (supossedpos >= 0)
  {
    Serial.println(supossedpos);
    supossedpos = supossedpos - 1;
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
  testdrawtext("1", ROUGE, 0, 70, 1);
  testdrawtext("2", ROUGE, 0, 80, 1);
  testdrawtext("3", ROUGE, 0, 90, 1);
  testdrawtext("4", ROUGE, 0, 100, 1);
  testdrawtext("5", ROUGE, 0, 110, 1);
  testdrawtext("6", ROUGE, 0, 120, 1);
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
  char tosend[5];
  int val = supossedpos;
  tosend[0] = char(val%10);
  val = val-val%10;
  if (tosend[0] == 0) {tosend[0] = 'A';}
  
  tosend[1] = char((val%100)/ 10);
  val = val-val%100;
  if (tosend[1] == 0) {tosend[1] = 'A';}
  
  tosend[2] = char((val%1000)/ 100);
  val = val-val%1000;
  if (tosend[2] == 0) {tosend[2] = 'A';}
  
  tosend[3] = char((val%10000)/ 1000);
  val = val-val%10000;
  if (tosend[3] == 0) {tosend[3] = 'A';}
  
  tosend[4] = char((val%100000)/ 10000);
  val = val-val%100000;
  if (tosend[4] == 0) {tosend[4] = 'A';}
  
  Wire.beginTransmission(SLAVE_ADDR);
  Wire.write(tosend);
  Wire.endTransmission();
  Serial.print("value : ");
  Serial.println(supossedpos);
  Serial.print("trame : ");
  Serial.print(int(tosend[0]));
  Serial.print(int(tosend[1]));
  Serial.print(int(tosend[2]));
  Serial.print(int(tosend[3]));
  Serial.println(int(tosend[4]));

  
}
