from nanpy import (ArduinoApi, SerialManager)
from time import sleep
import sys

coffeePin = 3
sugarPin = 4
creamerPin = 2
cupPin = 6
valvePin = 5

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
a.pinMode(sugarPin, a.OUTPUT)
a.pinMode(creamerPin, a.OUTPUT)
a.pinMode(cupPin, a.OUTPUT)
a.pinMode(valvePin, a.OUTPUT)



try:
    a.digitalWrite(cupPin, a.HIGH)
    sleep(5)
    a.digitalWrite(cupPin, a.LOW)
    a.digitalWrite(coffeePin, a.HIGH)
    sleep(coffeeLevel*0.735)
    a.digitalWrite(coffeePin, a.LOW)
    a.digitalWrite(sugarPin, a.HIGH)
    sleep(sugarLevel*0.735)
    a.digitalWrite(sugarPin, a.LOW)
    a.digitalWrite(creamerPin, a.HIGH)
    sleep(creamerLevel*0.735)
    a.digitalWrite(creamerPin, a.LOW)
    sleep(1)
    a.digitalWrite(valvePin, a.HIGH)
    sleep(5)
    a.digitalWrite(valvePin, a.LOW)
    sys.exit()
except:
    a.digitalWrite(coffeePin,a.LOW)
    

