/********************************************************************************
** Form generated from reading UI file 'fenetreprincipale.ui'
**
** Created by: Qt User Interface Compiler version 5.2.0
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_FENETREPRINCIPALE_H
#define UI_FENETREPRINCIPALE_H

#include <QtCore/QVariant>
#include <QtWebKitWidgets/QWebView>
#include <QtWidgets/QAction>
#include <QtWidgets/QApplication>
#include <QtWidgets/QButtonGroup>
#include <QtWidgets/QGridLayout>
#include <QtWidgets/QHeaderView>
#include <QtWidgets/QMainWindow>
#include <QtWidgets/QMenu>
#include <QtWidgets/QMenuBar>
#include <QtWidgets/QStatusBar>
#include <QtWidgets/QToolBar>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_fenetrePrincipale
{
public:
    QAction *actionDeveloppeurs;
    QAction *actionUtilisation;
    QAction *actionPlein_cran;
    QAction *actionPr_c_dent;
    QAction *actionSuivant;
    QAction *actionAccueil;
    QAction *actionImprimer;
    QAction *actionQuitter;
    QAction *actionConfigServeur;
    QAction *actionZoomPlus;
    QAction *actionZoomMoins;
    QAction *actionVue_initialie;
    QWidget *centralWidget;
    QGridLayout *gridLayout;
    QWebView *pageWeb;
    QMenuBar *menuBar;
    QMenu *menuFichier;
    QMenu *menuEdition;
    QMenu *menuAffichage;
    QMenu *menuAide;
    QMenu *menu;
    QMenu *menuConfiguration;
    QStatusBar *statusBar;
    QToolBar *mainToolBar;

    void setupUi(QMainWindow *fenetrePrincipale)
    {
        if (fenetrePrincipale->objectName().isEmpty())
            fenetrePrincipale->setObjectName(QStringLiteral("fenetrePrincipale"));
        fenetrePrincipale->resize(750, 500);
        fenetrePrincipale->setMinimumSize(QSize(750, 500));
        actionDeveloppeurs = new QAction(fenetrePrincipale);
        actionDeveloppeurs->setObjectName(QStringLiteral("actionDeveloppeurs"));
        QIcon icon;
        icon.addFile(QStringLiteral(":/icones/logos/info.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionDeveloppeurs->setIcon(icon);
        actionUtilisation = new QAction(fenetrePrincipale);
        actionUtilisation->setObjectName(QStringLiteral("actionUtilisation"));
        QIcon icon1;
        icon1.addFile(QStringLiteral(":/icones/logos/question.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionUtilisation->setIcon(icon1);
        actionPlein_cran = new QAction(fenetrePrincipale);
        actionPlein_cran->setObjectName(QStringLiteral("actionPlein_cran"));
        QIcon icon2;
        icon2.addFile(QStringLiteral(":/icones/logos/resize.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionPlein_cran->setIcon(icon2);
        actionPr_c_dent = new QAction(fenetrePrincipale);
        actionPr_c_dent->setObjectName(QStringLiteral("actionPr_c_dent"));
        QIcon icon3;
        icon3.addFile(QStringLiteral(":/icones/logos/arrow-small-17.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionPr_c_dent->setIcon(icon3);
        actionSuivant = new QAction(fenetrePrincipale);
        actionSuivant->setObjectName(QStringLiteral("actionSuivant"));
        QIcon icon4;
        icon4.addFile(QStringLiteral(":/icones/logos/arrow-small-18.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionSuivant->setIcon(icon4);
        actionAccueil = new QAction(fenetrePrincipale);
        actionAccueil->setObjectName(QStringLiteral("actionAccueil"));
        QIcon icon5;
        icon5.addFile(QStringLiteral(":/icones/logos/home.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionAccueil->setIcon(icon5);
        actionImprimer = new QAction(fenetrePrincipale);
        actionImprimer->setObjectName(QStringLiteral("actionImprimer"));
        QIcon icon6;
        icon6.addFile(QStringLiteral(":/icones/logos/printer.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionImprimer->setIcon(icon6);
        actionQuitter = new QAction(fenetrePrincipale);
        actionQuitter->setObjectName(QStringLiteral("actionQuitter"));
        QIcon icon7;
        icon7.addFile(QStringLiteral(":/icones/logos/power-button.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionQuitter->setIcon(icon7);
        actionConfigServeur = new QAction(fenetrePrincipale);
        actionConfigServeur->setObjectName(QStringLiteral("actionConfigServeur"));
        QIcon icon8;
        icon8.addFile(QStringLiteral(":/icones/logos/gear.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionConfigServeur->setIcon(icon8);
        actionZoomPlus = new QAction(fenetrePrincipale);
        actionZoomPlus->setObjectName(QStringLiteral("actionZoomPlus"));
        QIcon icon9;
        icon9.addFile(QStringLiteral(":/icones/logos/34.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionZoomPlus->setIcon(icon9);
        actionZoomMoins = new QAction(fenetrePrincipale);
        actionZoomMoins->setObjectName(QStringLiteral("actionZoomMoins"));
        QIcon icon10;
        icon10.addFile(QStringLiteral(":/icones/logos/35.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionZoomMoins->setIcon(icon10);
        actionVue_initialie = new QAction(fenetrePrincipale);
        actionVue_initialie->setObjectName(QStringLiteral("actionVue_initialie"));
        QIcon icon11;
        icon11.addFile(QStringLiteral(":/icones/logos/33.png"), QSize(), QIcon::Normal, QIcon::Off);
        actionVue_initialie->setIcon(icon11);
        centralWidget = new QWidget(fenetrePrincipale);
        centralWidget->setObjectName(QStringLiteral("centralWidget"));
        gridLayout = new QGridLayout(centralWidget);
        gridLayout->setSpacing(6);
        gridLayout->setContentsMargins(11, 11, 11, 11);
        gridLayout->setObjectName(QStringLiteral("gridLayout"));
        gridLayout->setContentsMargins(0, 0, 0, 0);
        pageWeb = new QWebView(centralWidget);
        pageWeb->setObjectName(QStringLiteral("pageWeb"));
        pageWeb->setUrl(QUrl(QStringLiteral("qrc:/icones/accueil.html")));
        pageWeb->setRenderHints(QPainter::Qt4CompatiblePainting|QPainter::SmoothPixmapTransform|QPainter::TextAntialiasing);

        gridLayout->addWidget(pageWeb, 0, 0, 1, 1);

        fenetrePrincipale->setCentralWidget(centralWidget);
        menuBar = new QMenuBar(fenetrePrincipale);
        menuBar->setObjectName(QStringLiteral("menuBar"));
        menuBar->setGeometry(QRect(0, 0, 750, 22));
        menuFichier = new QMenu(menuBar);
        menuFichier->setObjectName(QStringLiteral("menuFichier"));
        menuEdition = new QMenu(menuBar);
        menuEdition->setObjectName(QStringLiteral("menuEdition"));
        menuAffichage = new QMenu(menuBar);
        menuAffichage->setObjectName(QStringLiteral("menuAffichage"));
        menuAide = new QMenu(menuBar);
        menuAide->setObjectName(QStringLiteral("menuAide"));
        menu = new QMenu(menuBar);
        menu->setObjectName(QStringLiteral("menu"));
        menuConfiguration = new QMenu(menuBar);
        menuConfiguration->setObjectName(QStringLiteral("menuConfiguration"));
        fenetrePrincipale->setMenuBar(menuBar);
        statusBar = new QStatusBar(fenetrePrincipale);
        statusBar->setObjectName(QStringLiteral("statusBar"));
        fenetrePrincipale->setStatusBar(statusBar);
        mainToolBar = new QToolBar(fenetrePrincipale);
        mainToolBar->setObjectName(QStringLiteral("mainToolBar"));
        mainToolBar->setIconSize(QSize(24, 24));
        fenetrePrincipale->addToolBar(Qt::TopToolBarArea, mainToolBar);

        menuBar->addAction(menuFichier->menuAction());
        menuBar->addAction(menuEdition->menuAction());
        menuBar->addAction(menuAffichage->menuAction());
        menuBar->addAction(menuConfiguration->menuAction());
        menuBar->addAction(menuAide->menuAction());
        menuBar->addAction(menu->menuAction());
        menuFichier->addAction(actionImprimer);
        menuFichier->addAction(actionQuitter);
        menuEdition->addAction(actionAccueil);
        menuEdition->addAction(actionPr_c_dent);
        menuEdition->addAction(actionSuivant);
        menuAffichage->addAction(actionPlein_cran);
        menuAffichage->addAction(actionZoomPlus);
        menuAffichage->addAction(actionZoomMoins);
        menuAffichage->addAction(actionVue_initialie);
        menuAide->addAction(actionUtilisation);
        menu->addAction(actionDeveloppeurs);
        menuConfiguration->addAction(actionConfigServeur);
        mainToolBar->addAction(actionAccueil);
        mainToolBar->addSeparator();
        mainToolBar->addAction(actionImprimer);
        mainToolBar->addSeparator();
        mainToolBar->addAction(actionPr_c_dent);
        mainToolBar->addAction(actionSuivant);
        mainToolBar->addSeparator();
        mainToolBar->addAction(actionPlein_cran);
        mainToolBar->addAction(actionZoomPlus);
        mainToolBar->addAction(actionZoomMoins);
        mainToolBar->addAction(actionVue_initialie);
        mainToolBar->addSeparator();
        mainToolBar->addAction(actionConfigServeur);
        mainToolBar->addSeparator();
        mainToolBar->addAction(actionQuitter);
        mainToolBar->addAction(actionUtilisation);
        mainToolBar->addAction(actionDeveloppeurs);

        retranslateUi(fenetrePrincipale);

        QMetaObject::connectSlotsByName(fenetrePrincipale);
    } // setupUi

    void retranslateUi(QMainWindow *fenetrePrincipale)
    {
        fenetrePrincipale->setWindowTitle(QApplication::translate("fenetrePrincipale", "Bourse aux Livres", 0));
        actionDeveloppeurs->setText(QApplication::translate("fenetrePrincipale", "D\303\251veloppeurs", 0));
        actionUtilisation->setText(QApplication::translate("fenetrePrincipale", "Utilisation", 0));
        actionPlein_cran->setText(QApplication::translate("fenetrePrincipale", "Plein \303\251cran", 0));
        actionPr_c_dent->setText(QApplication::translate("fenetrePrincipale", "Pr\303\251c\303\251dent", 0));
        actionSuivant->setText(QApplication::translate("fenetrePrincipale", "Suivant", 0));
        actionAccueil->setText(QApplication::translate("fenetrePrincipale", "Accueil", 0));
        actionImprimer->setText(QApplication::translate("fenetrePrincipale", "Imprimer", 0));
        actionQuitter->setText(QApplication::translate("fenetrePrincipale", "Quitter", 0));
        actionConfigServeur->setText(QApplication::translate("fenetrePrincipale", "Config Serveur", 0));
        actionZoomPlus->setText(QApplication::translate("fenetrePrincipale", "Zoom +", 0));
        actionZoomMoins->setText(QApplication::translate("fenetrePrincipale", "Zoom -", 0));
        actionVue_initialie->setText(QApplication::translate("fenetrePrincipale", "Zoom Initiale", 0));
        menuFichier->setTitle(QApplication::translate("fenetrePrincipale", "Fichier", 0));
        menuEdition->setTitle(QApplication::translate("fenetrePrincipale", "Edition", 0));
        menuAffichage->setTitle(QApplication::translate("fenetrePrincipale", "Affichage", 0));
        menuAide->setTitle(QApplication::translate("fenetrePrincipale", "Aide", 0));
        menu->setTitle(QApplication::translate("fenetrePrincipale", "?", 0));
        menuConfiguration->setTitle(QApplication::translate("fenetrePrincipale", "Configuration", 0));
    } // retranslateUi

};

namespace Ui {
    class fenetrePrincipale: public Ui_fenetrePrincipale {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_FENETREPRINCIPALE_H
