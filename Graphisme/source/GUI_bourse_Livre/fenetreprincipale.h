#ifndef FENETREPRINCIPALE_H
#define FENETREPRINCIPALE_H

#include <QMainWindow>
#include <QUrl>
#include <QDialog>
#include <QPrinter>
#include <QPrintDialog>
#include <config.h>
#include <QTextStream>

namespace Ui {
class fenetrePrincipale;
}

class fenetrePrincipale : public QMainWindow
{
    Q_OBJECT

public:
    explicit fenetrePrincipale(QWidget *parent = 0);
    ~fenetrePrincipale();

private slots:
    void on_actionConfigServeur_triggered();

    void on_actionVue_initialie_triggered();

    void on_actionZoomMoins_triggered();

    void on_actionZoomPlus_triggered();

    void on_actionQuitter_triggered();

    void on_actionPlein_cran_triggered();

    void on_actionPr_c_dent_triggered();

    void on_actionSuivant_triggered();

    void on_actionImprimer_triggered();

    void on_actionDeveloppeurs_triggered();

    void on_actionAccueil_triggered();

private:
    Ui::fenetrePrincipale *ui;
    Config *c;
    QString *lien;
};

#endif // FENETREPRINCIPALE_H
