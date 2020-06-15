#include <SPI.h>
#include <Ethernet.h>

// network configuration.  gateway and subnet are optional.

 // the media access control (ethernet hardware) address for the shield:
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xEF };  
//the IP address for the shield:
byte ip[] = { 192, 168, 43, 144 };    
// the router's gateway address:
//byte gateway[] = { 10, 0, 0, 1 };
// the subnet:
//byte subnet[] = { 255, 255, 0, 0 };

// telnet defaults to port 23
EthernetServer server = EthernetServer(23);

void setup()
{
  // initialize the ethernet device
  //Ethernet.begin(mac, ip, gateway, subnet);
  Ethernet.begin(mac, ip);
  Serial.println("Hello");

  // start listening for clients
  server.begin();
}

void loop()
{
  // if an incoming client connects, there will be bytes available to read:
  EthernetClient client = server.available();
  if (client == true) {
    // read bytes from the incoming client and write them back
    // to any clients connected to the server:
    server.write(client.read());
  }
}
