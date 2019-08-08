from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

coffeePin = 2
creamerPin = 3
sugarPin = 4

coffeeLevel = int(sys.argv[1])
sugarLevel = int(sys.argv[2])
creamerLevel = int(sys.argv[3])  


try:
    connection = SerialManager()
    a = ArduinoApi(connection = connection)
except:
    print ("Failed to connect to Arduino")

# Setup the pinModes as if we were in the Arduino IDE
a.pinMode(coffeePin, a.OUTPUT)
a.pinMode(creamerPin, a.OUTPUT)
a.pinMode(sugarPin, a.OUTPUT)

try:
    while True:
        
        a.digitalWrite(sugarPin, a.HIGH)
        print('hello')
        sleep(sugarLevel)
        a.digitalWrite(sugarPin, a.LOW)
        sleep(2)
        sys.exit()
except:
    a.digitalWrite(sugarPin,a.LOW)

