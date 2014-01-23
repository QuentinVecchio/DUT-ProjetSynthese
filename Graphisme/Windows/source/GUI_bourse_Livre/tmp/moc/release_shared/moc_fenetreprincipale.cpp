/****************************************************************************
** Meta object code from reading C++ file 'fenetreprincipale.h'
**
** Created: Fri 8. Nov 16:06:41 2013
**      by: The Qt Meta Object Compiler version 62 (Qt 4.7.0)
**
** WARNING! All changes made in this file will be lost!
*****************************************************************************/

#include "../../../fenetreprincipale.h"
#if !defined(Q_MOC_OUTPUT_REVISION)
#error "The header file 'fenetreprincipale.h' doesn't include <QObject>."
#elif Q_MOC_OUTPUT_REVISION != 62
#error "This file was generated using the moc from 4.7.0. It"
#error "cannot be used with the include files from this version of Qt."
#error "(The moc has changed too much.)"
#endif

QT_BEGIN_MOC_NAMESPACE
static const uint qt_meta_data_fenetrePrincipale[] = {

 // content:
       5,       // revision
       0,       // classname
       0,    0, // classinfo
      11,   14, // methods
       0,    0, // properties
       0,    0, // enums/sets
       0,    0, // constructors
       0,       // flags
       0,       // signalCount

 // slots: signature, parameters, type, tag, flags
      19,   18,   18,   18, 0x08,
      54,   18,   18,   18, 0x08,
      89,   18,   18,   18, 0x08,
     120,   18,   18,   18, 0x08,
     150,   18,   18,   18, 0x08,
     179,   18,   18,   18, 0x08,
     211,   18,   18,   18, 0x08,
     242,   18,   18,   18, 0x08,
     271,   18,   18,   18, 0x08,
     301,   18,   18,   18, 0x08,
     335,   18,   18,   18, 0x08,

       0        // eod
};

static const char qt_meta_stringdata_fenetrePrincipale[] = {
    "fenetrePrincipale\0\0"
    "on_actionConfigServeur_triggered()\0"
    "on_actionVue_initialie_triggered()\0"
    "on_actionZoomMoins_triggered()\0"
    "on_actionZoomPlus_triggered()\0"
    "on_actionQuitter_triggered()\0"
    "on_actionPlein_cran_triggered()\0"
    "on_actionPr_c_dent_triggered()\0"
    "on_actionSuivant_triggered()\0"
    "on_actionImprimer_triggered()\0"
    "on_actionDeveloppeurs_triggered()\0"
    "on_actionAccueil_triggered()\0"
};

const QMetaObject fenetrePrincipale::staticMetaObject = {
    { &QMainWindow::staticMetaObject, qt_meta_stringdata_fenetrePrincipale,
      qt_meta_data_fenetrePrincipale, 0 }
};

#ifdef Q_NO_DATA_RELOCATION
const QMetaObject &fenetrePrincipale::getStaticMetaObject() { return staticMetaObject; }
#endif //Q_NO_DATA_RELOCATION

const QMetaObject *fenetrePrincipale::metaObject() const
{
    return QObject::d_ptr->metaObject ? QObject::d_ptr->metaObject : &staticMetaObject;
}

void *fenetrePrincipale::qt_metacast(const char *_clname)
{
    if (!_clname) return 0;
    if (!strcmp(_clname, qt_meta_stringdata_fenetrePrincipale))
        return static_cast<void*>(const_cast< fenetrePrincipale*>(this));
    return QMainWindow::qt_metacast(_clname);
}

int fenetrePrincipale::qt_metacall(QMetaObject::Call _c, int _id, void **_a)
{
    _id = QMainWindow::qt_metacall(_c, _id, _a);
    if (_id < 0)
        return _id;
    if (_c == QMetaObject::InvokeMetaMethod) {
        switch (_id) {
        case 0: on_actionConfigServeur_triggered(); break;
        case 1: on_actionVue_initialie_triggered(); break;
        case 2: on_actionZoomMoins_triggered(); break;
        case 3: on_actionZoomPlus_triggered(); break;
        case 4: on_actionQuitter_triggered(); break;
        case 5: on_actionPlein_cran_triggered(); break;
        case 6: on_actionPr_c_dent_triggered(); break;
        case 7: on_actionSuivant_triggered(); break;
        case 8: on_actionImprimer_triggered(); break;
        case 9: on_actionDeveloppeurs_triggered(); break;
        case 10: on_actionAccueil_triggered(); break;
        default: ;
        }
        _id -= 11;
    }
    return _id;
}
QT_END_MOC_NAMESPACE
