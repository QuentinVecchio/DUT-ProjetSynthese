#ifndef FENETREPRINCIPALE_H
#define FENETREPRINCIPALE_H

#include <QMainWindow>
#include <QUrl>
#include <QDialog>
#include <QPrinter>
#include <QPrintDialog>
#include <QWebSettings>
#include <config.h>
#include <aide.h>
#include <QTextStream>
#include <QProgressBar>
#include <QNetworkReply>
#include <QFileInfo>
#include <QDir>
#include <QProgressDialog>
#include <QFileDialog>
#include <QtWebKitWidgets>

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

    void on_pageWeb_loadProgress(int progress);

    void on_pageWeb_loadFinished(bool arg1);

    void on_actionUtilisation_triggered();

    void chargement();
private:
    Ui::fenetrePrincipale *ui;
    QFile fichierATelecharger;
    QProgressDialog *dialogueTelechargement;
    QNetworkReply *reponse;
    Config *c;
    aide *a;
    QString *lien;
    QProgressBar *barreProgresse;
};

#endif // FENETREPRINCIPALE_H
