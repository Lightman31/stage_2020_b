#include <SPI.h>
#include <Ethernet.h>

// network configuration.  gateway and subnet are optional.

 // the media access control (ethernet hardware) address for the shield:
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xEF };  
//the IP address for the shield:
byte ip[] = { 169, 254, 220,232};    

// telnet defaults to port 23
EthernetServer serverHTTP(23);


void setup()
{
  // initialize the ethernet device
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  Serial.print("Hello");
  // start listening for clients
  serverHTTP.begin();
  
}

void loop()
{
  // if an incoming client connects, there will be bytes available to read:
  EthernetClient client = serverHTTP.available();
  
  if (client == true) {
    Serial.println("Connected");
    // read bytes from the incoming client and write them back
    // to any clients connected to the server:
    serverHTTP.write(client.read());
  }
}
