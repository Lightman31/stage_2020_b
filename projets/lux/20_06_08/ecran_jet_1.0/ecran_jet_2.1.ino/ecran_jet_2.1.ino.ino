/***************************************************
  This is an example sketch for the Adafruit 1.8" SPI display.
  This library works with the Adafruit 1.8" TFT Breakout w/SD card
  ----> http://www.adafruit.com/products/358
  as well as Adafruit raw 1.8" TFT display
  ----> http://www.adafruit.com/products/618

  Check out the links above for our tutorials and wiring diagrams
  These displays use SPI to communicate, 4 or 5 pins are required to
  interface (RST is optional)
  Adafruit invests time and resources providing this open source code,
  please support Adafruit and open-source hardware by purchasing
  products from Adafruit!

  Written by Limor Fried/Ladyada for Adafruit Industries.
  MIT license, all text above must be included in any redistribution
 ****************************************************/

// For the breakout, you can use any (4 or) 5 pins
//#define sclk 4
//#define mosi 5
//#define cs   6
//#define dc   7
//#define rst  8  // you can also connect this to the Arduino reset

//Use these pins for the shield!
#define sclk 13
#define mosi 11
#define cs   10
#define dc   8
#define rst  5  // you can also connect this to the Arduino reset

#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library
#include <SPI.h>

#if defined(__SAM3X8E__)
#undef __FlashStringHelper::F(string_literal)
#define F(string_literal) string_literal
#endif

// Option 1: use any pins but a little slower
Adafruit_ST7735 tft = Adafruit_ST7735(cs, dc, mosi, sclk, rst);
// Option 2: must use the hardware SPI pins
// (for UNO thats sclk = 13 and sid = 11) and pin 10 must be
// an output. This is much faster - also required if you want
// to use the microSD card (see the image drawing example)
//Adafruit_ST7735 tft = Adafruit_ST7735(cs, dc, rst);
float p = 3.1415926;

#define Neutral 0
#define Press 1
#define Up 2
#define Down 3
#define Right 4
#define Left 5

#define NOIR ST7735_BLACK 
#define ROUGE ST7735_RED 
#define JAUNE ST7735_YELLOW 
#define BLEU ST7735_BLUE 
#define VERT ST7735_GREEN 
#define BLANC ST7735_WHITE 



const int button_mooveRight = 22;
const int button_mooveLeft = 24;
const int button_save1 = 26;
const int button_save2 = 28;
const int button_save3 = 30;
const int button_save4 = 32;
const int button_save5 = 34;
// variables will change:
int buttonState = 0;         // variable for reading the pushbutton status


void setup(void) {
   pinMode(button_mooveRight, INPUT);
   pinMode(button_mooveLeft, INPUT);
   pinMode(button_save1, INPUT);
   pinMode(button_save2, INPUT);
   pinMode(button_save3, INPUT);
   pinMode(button_save4, INPUT);
   pinMode(button_save5, INPUT);
  // Our supplier changed the 1.8" display slightly after Jan 10, 2012
  // so that the alignment of the TFT had to be shifted by a few pixels
  // this just means the init code is slightly different. Check the
  // color of the tab to see which init code to try. If the display is
  // cut off or has extra 'random' pixels on the top & left, try the
  // other option!
  // If you are seeing red and green color inversion, use Black Tab
  // If your TFT's plastic wrap has a Black Tab, use the following:
  tft.initR(INITR_BLACKTAB);   // initialize a ST7735S chip, black tab
  // If your TFT's plastic wrap has a Red Tab, use the following:
  //tft.initR(INITR_REDTAB);   // initialize a ST7735R chip, red tab
  // If your TFT's plastic wrap has a Green Tab, use the following:
  //tft.initR(INITR_GREENTAB); // initialize a ST7735R chip, green tab
  tft.setCursor(0, 30);
  tft.fillScreen(ST7735_BLACK);
  tft.setCursor(0, 30);
  //tft.setTextColor(ST7735_GREEN);
  //delay(1000);

  tftPrintTest();
  clearscreen();

}

void loop() {

  buttonState = digitalRead(button_mooveRight);
  if (buttonState == HIGH) {
    testdrawtext("right", BLANC, 0,0, 2);
  } else {
    testdrawtext("right", NOIR, 0,0, 2);
  }

  buttonState = digitalRead(button_mooveLeft);
  if (buttonState == HIGH) {
    testdrawtext("left", BLANC, 0,40, 2);
  } else {
    testdrawtext("left", NOIR, 0,40, 2);
  }

  


delay (20);
}

void clearscreen()
{
  tft.fillScreen(NOIR);
}

void testdrawtext(char *text, uint16_t color, int cursor_x, int cursor_y, int taille) {
  tft.setTextWrap(true);
  tft.setCursor(cursor_x, cursor_y);
  tft.setTextColor(color);
  tft.setTextSize(taille);
  tft.print(text);
}

void tftPrintTest() {
  tft.setTextWrap(false);
  tft.fillScreen(NOIR);
  tft.setCursor(0, 30);
  tft.setTextColor(ROUGE);
  tft.setTextSize(1);
  tft.println("Hello World!");
  tft.setTextColor(JAUNE);
  tft.setTextSize(2);
  tft.println("Hello World!");
  tft.setTextColor(VERT);
  tft.setTextSize(3);
  tft.println("Hello World!");
  tft.setTextColor(BLEU);
  tft.setTextSize(4);
  tft.print(1234.567);
  delay(1500);
  tft.setCursor(0, 0);
  tft.fillScreen(ST7735_BLACK);
  tft.setTextColor(ST7735_WHITE);
  tft.setTextSize(0);
  tft.println("Hello World!");
  tft.setTextSize(1);
  tft.setTextColor(ST7735_GREEN);
  tft.print(p, 6);
  tft.println(" Want pi?");
  tft.println(" ");
  tft.print(8675309, HEX); // print 8,675,309 out in HEX!
  tft.println(" Print HEX!");
  tft.println(" ");
  tft.setTextColor(ST7735_WHITE);
  tft.println("Sketch has been");
  tft.println("running for: ");
  tft.setTextColor(ST7735_MAGENTA);
  tft.print(millis() / 1000);
  tft.setTextColor(ST7735_WHITE);
  tft.print(" seconds.");
}
