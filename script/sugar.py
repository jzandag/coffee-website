from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

sugarPin = 4

sugarLevel = int(sys.argv[1])

try:
    connection = SerialManager()
    a = ArduinoApi(connection = connection)
except:
    print ("Failed to connect to Arduino")

# Setup the pinModes as if we were in the Arduino IDE
a.pinMode(sugarPin, a.OUTPUT)

try:
    a.digitalWrite(sugarPin, a.HIGH)
    sleep(sugarLevel)
    a.digitalWrite(sugarPin, a.LOW)
    sys.exit()
except:
    a.digitalWrite(sugarPin,a.LOW)

