from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

cupPin = 6

try:
    connection = SerialManager()
    a = ArduinoApi(connection = connection)
except:
    print ("Failed to connect to Arduino")

# Setup the pinModes as if we were in the Arduino IDE
a.pinMode(cupPin, a.OUTPUT)

try:
    a.digitalWrite(cupPin, a.HIGH)
    sleep(5)
    a.digitalWrite(cupPin, a.LOW)
    sys.exit()
except:
    a.digitalWrite(cupPin,a.LOW)

