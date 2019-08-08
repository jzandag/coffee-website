from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

creamerPin = 3

creamerLevel = int(sys.argv[1])

try:
    connection = SerialManager()
    a = ArduinoApi(connection = connection)
except:
    print ("Failed to connect to Arduino")

# Setup the pinModes as if we were in the Arduino IDE
a.pinMode(creamerPin, a.OUTPUT)

try:
    a.digitalWrite(creamerPin, a.HIGH)
    sleep(creamerLevel)
    a.digitalWrite(creamerPin, a.LOW)
    sys.exit()
except:
    a.digitalWrite(creamerPin,a.LOW)

