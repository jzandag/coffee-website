from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

valve = 5

try:
    connection = SerialManager()
    a = ArduinoApi(connection = connection)
except:
    print ("Failed to connect to Arduino")

# Setup the pinModes as if we were in the Arduino IDE
a.pinMode(valve, a.OUTPUT)

try:
    a.digitalWrite(valve, a.HIGH)
    sleep(5)
    a.digitalWrite(valve, a.LOW)
    sys.exit()
except:
    a.digitalWrite(valve,a.LOW)

