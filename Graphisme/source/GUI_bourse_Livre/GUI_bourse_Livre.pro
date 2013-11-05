#-------------------------------------------------
#
# Project created by QtCreator 2013-10-28T20:41:17
#
#-------------------------------------------------

QT       += core gui
QT += webkitwidgets
greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = GUI_bourse_Livre
TEMPLATE = app


SOURCES += main.cpp\
        fenetreprincipale.cpp \
    config.cpp

HEADERS  += fenetreprincipale.h \
    config.h

FORMS    += fenetreprincipale.ui \
    config.ui

RESOURCES += \
    ressource.qrc
