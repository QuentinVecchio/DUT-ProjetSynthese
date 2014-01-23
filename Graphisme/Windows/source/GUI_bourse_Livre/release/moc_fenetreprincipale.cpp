/****************************************************************************
** Meta object code from reading C++ file 'fenetreprincipale.h'
**
** Created by: The Qt Meta Object Compiler version 67 (Qt 5.2.0)
**
** WARNING! All changes made in this file will be lost!
*****************************************************************************/

#include "../fenetreprincipale.h"
#include <QtCore/qbytearray.h>
#include <QtCore/qmetatype.h>
#if !defined(Q_MOC_OUTPUT_REVISION)
#error "The header file 'fenetreprincipale.h' doesn't include <QObject>."
#elif Q_MOC_OUTPUT_REVISION != 67
#error "This file was generated using the moc from 5.2.0. It"
#error "cannot be used with the include files from this version of Qt."
#error "(The moc has changed too much.)"
#endif

QT_BEGIN_MOC_NAMESPACE
struct qt_meta_stringdata_fenetrePrincipale_t {
    QByteArrayData data[19];
    char stringdata[447];
};
#define QT_MOC_LITERAL(idx, ofs, len) \
    Q_STATIC_BYTE_ARRAY_DATA_HEADER_INITIALIZER_WITH_OFFSET(len, \
    offsetof(qt_meta_stringdata_fenetrePrincipale_t, stringdata) + ofs \
        - idx * sizeof(QByteArrayData) \
    )
static const qt_meta_stringdata_fenetrePrincipale_t qt_meta_stringdata_fenetrePrincipale = {
    {
QT_MOC_LITERAL(0, 0, 17),
QT_MOC_LITERAL(1, 18, 32),
QT_MOC_LITERAL(2, 51, 0),
QT_MOC_LITERAL(3, 52, 32),
QT_MOC_LITERAL(4, 85, 28),
QT_MOC_LITERAL(5, 114, 27),
QT_MOC_LITERAL(6, 142, 26),
QT_MOC_LITERAL(7, 169, 29),
QT_MOC_LITERAL(8, 199, 28),
QT_MOC_LITERAL(9, 228, 26),
QT_MOC_LITERAL(10, 255, 27),
QT_MOC_LITERAL(11, 283, 31),
QT_MOC_LITERAL(12, 315, 26),
QT_MOC_LITERAL(13, 342, 23),
QT_MOC_LITERAL(14, 366, 8),
QT_MOC_LITERAL(15, 375, 23),
QT_MOC_LITERAL(16, 399, 4),
QT_MOC_LITERAL(17, 404, 30),
QT_MOC_LITERAL(18, 435, 10)
    },
    "fenetrePrincipale\0on_actionConfigServeur_triggered\0"
    "\0on_actionVue_initialie_triggered\0"
    "on_actionZoomMoins_triggered\0"
    "on_actionZoomPlus_triggered\0"
    "on_actionQuitter_triggered\0"
    "on_actionPlein_cran_triggered\0"
    "on_actionPr_c_dent_triggered\0"
    "on_actionSuivant_triggered\0"
    "on_actionImprimer_triggered\0"
    "on_actionDeveloppeurs_triggered\0"
    "on_actionAccueil_triggered\0"
    "on_pageWeb_loadProgress\0progress\0"
    "on_pageWeb_loadFinished\0arg1\0"
    "on_actionUtilisation_triggered\0"
    "chargement\0"
};
#undef QT_MOC_LITERAL

static const uint qt_meta_data_fenetrePrincipale[] = {

 // content:
       7,       // revision
       0,       // classname
       0,    0, // classinfo
      15,   14, // methods
       0,    0, // properties
       0,    0, // enums/sets
       0,    0, // constructors
       0,       // flags
       0,       // signalCount

 // slots: name, argc, parameters, tag, flags
       1,    0,   89,    2, 0x08,
       3,    0,   90,    2, 0x08,
       4,    0,   91,    2, 0x08,
       5,    0,   92,    2, 0x08,
       6,    0,   93,    2, 0x08,
       7,    0,   94,    2, 0x08,
       8,    0,   95,    2, 0x08,
       9,    0,   96,    2, 0x08,
      10,    0,   97,    2, 0x08,
      11,    0,   98,    2, 0x08,
      12,    0,   99,    2, 0x08,
      13,    1,  100,    2, 0x08,
      15,    1,  103,    2, 0x08,
      17,    0,  106,    2, 0x08,
      18,    0,  107,    2, 0x08,

 // slots: parameters
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void,
    QMetaType::Void, QMetaType::Int,   14,
    QMetaType::Void, QMetaType::Bool,   16,
    QMetaType::Void,
    QMetaType::Void,

       0        // eod
};

void fenetrePrincipale::qt_static_metacall(QObject *_o, QMetaObject::Call _c, int _id, void **_a)
{
    if (_c == QMetaObject::InvokeMetaMethod) {
        fenetrePrincipale *_t = static_cast<fenetrePrincipale *>(_o);
        switch (_id) {
        case 0: _t->on_actionConfigServeur_triggered(); break;
        case 1: _t->on_actionVue_initialie_triggered(); break;
        case 2: _t->on_actionZoomMoins_triggered(); break;
        case 3: _t->on_actionZoomPlus_triggered(); break;
        case 4: _t->on_actionQuitter_triggered(); break;
        case 5: _t->on_actionPlein_cran_triggered(); break;
        case 6: _t->on_actionPr_c_dent_triggered(); break;
        case 7: _t->on_actionSuivant_triggered(); break;
        case 8: _t->on_actionImprimer_triggered(); break;
        case 9: _t->on_actionDeveloppeurs_triggered(); break;
        case 10: _t->on_actionAccueil_triggered(); break;
        case 11: _t->on_pageWeb_loadProgress((*reinterpret_cast< int(*)>(_a[1]))); break;
        case 12: _t->on_pageWeb_loadFinished((*reinterpret_cast< bool(*)>(_a[1]))); break;
        case 13: _t->on_actionUtilisation_triggered(); break;
        case 14: _t->chargement(); break;
        default: ;
        }
    }
}

const QMetaObject fenetrePrincipale::staticMetaObject = {
    { &QMainWindow::staticMetaObject, qt_meta_stringdata_fenetrePrincipale.data,
      qt_meta_data_fenetrePrincipale,  qt_static_metacall, 0, 0}
};


const QMetaObject *fenetrePrincipale::metaObject() const
{
    return QObject::d_ptr->metaObject ? QObject::d_ptr->dynamicMetaObject() : &staticMetaObject;
}

void *fenetrePrincipale::qt_metacast(const char *_clname)
{
    if (!_clname) return 0;
    if (!strcmp(_clname, qt_meta_stringdata_fenetrePrincipale.stringdata))
        return static_cast<void*>(const_cast< fenetrePrincipale*>(this));
    return QMainWindow::qt_metacast(_clname);
}

int fenetrePrincipale::qt_metacall(QMetaObject::Call _c, int _id, void **_a)
{
    _id = QMainWindow::qt_metacall(_c, _id, _a);
    if (_id < 0)
        return _id;
    if (_c == QMetaObject::InvokeMetaMethod) {
        if (_id < 15)
            qt_static_metacall(this, _c, _id, _a);
        _id -= 15;
    } else if (_c == QMetaObject::RegisterMethodArgumentMetaType) {
        if (_id < 15)
            *reinterpret_cast<int*>(_a[0]) = -1;
        _id -= 15;
    }
    return _id;
}
QT_END_MOC_NAMESPACE
