from base64 import encode
from pickle import encode_long
import cv2
import numpy as np
import face_recognition
import os


path='ImagesAttendance'
images = []
classNames = []
myList = os.listdir(path)
# print(myList)

def check(list1, val):
    return(any(x < val for x in list1))

for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])
# print(classNames)

def findEncodings(images):
    encodeList=[]
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

encodeListKnown = findEncodings(images)
# print('Encoding Complete')
chk=0
cap = cv2.VideoCapture(0)

while 1:
    if(chk):break
    success, img = cap.read()
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        print(faceDis)
        matchIndex = np.argmin(faceDis)

        if(check(faceDis, 0.33)):
            matchIndex = np.argmin(faceDis)

            if matches[matchIndex]:
                chk=1
                name = classNames[matchIndex]
                print(name)
                break


    cv2.imshow('webcam', img)
    cv2.waitKey(1)
