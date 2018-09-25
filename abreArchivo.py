import json

file = ("resultados.json")

typeFile = (type(file))

readFile = open(file, "r")

docs = ()


if file == None:
    print ("File not found")
else:
    print('File found', file, typeFile)


for line in readFile:
    docs = (line)
    #print (docs)


for mac in docs:
    macCount = 0
    if mac == "mac":
        totalCount = macCount + 1
        print(totalCount)
