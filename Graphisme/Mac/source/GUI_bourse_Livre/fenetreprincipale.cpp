#include "fenetreprincipale.h"
#include "ui_fenetreprincipale.h"

fenetrePrincipale::fenetrePrincipale(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::fenetrePrincipale)
{
    ui->setupUi(this);
    this->barreProgresse = new QProgressBar();
    ui->statusBar->addWidget(this->barreProgresse);
}

fenetrePrincipale::~fenetrePrincipale()
{
    delete ui;
}

void fenetrePrincipale::on_actionConfigServeur_triggered()
{
    this->c = new Config();
    this->c->show();
}

void fenetrePrincipale::on_actionVue_initialie_triggered()
{
    ui->pageWeb->setZoomFactor(1.0);
}

void fenetrePrincipale::on_actionZoomMoins_triggered()
{
   qreal var = ui->pageWeb->zoomFactor();
   if(var > 0.5)
   {
       var -= 0.25;
       ui->pageWeb->setZoomFactor(var);
   }
}

void fenetrePrincipale::on_actionZoomPlus_triggered()
{
    qreal var = ui->pageWeb->zoomFactor();
    if(var < 5)
    {
        var += 0.25;
        ui->pageWeb->setZoomFactor(var);
    }
}

void fenetrePrincipale::on_actionQuitter_triggered()
{
    this->close();
}

void fenetrePrincipale::on_actionPlein_cran_triggered()
{
    this->setWindowState(this->windowState() ^ Qt::WindowFullScreen);
}

void fenetrePrincipale::on_actionPr_c_dent_triggered()
{
    ui->pageWeb->back();
}

void fenetrePrincipale::on_actionSuivant_triggered()
{
    ui->pageWeb->forward();
}

void fenetrePrincipale::on_actionImprimer_triggered()
{
    QPrinter *printer = new QPrinter();
    QPrintDialog *dialog = new QPrintDialog(printer, this);
    dialog->setWindowTitle(tr("Impression du document"));
    dialog->addEnabledOption(QAbstractPrintDialog::PrintSelection);
    if (dialog->exec() != QDialog::Accepted)
        return;
    else
        ui->pageWeb->print(printer);

}

void fenetrePrincipale::on_actionDeveloppeurs_triggered()
{
    QMessageBox::about(this, "Développeurs",
                "Cette application a été développé par :\n" \
                "Matthieu Clin\n" \
                "Hugo Czekala\n" \
                "Dylan Koby\n" \
                "Erreur 404\n" \
                "Quentin Vecchio\n");
}

void fenetrePrincipale::on_actionAccueil_triggered()
{
    QFile configServeur("../configServeur.txt");
    if((configServeur.open(QIODevice::ReadOnly | QIODevice::Text)))
    {
        QTextStream flux(&configServeur);
        this->lien = new QString(flux.readLine());
        if(!(this->lien->isEmpty()))
        {
            ui->pageWeb->setUrl(QUrl(*this->lien));
        }
    }
    configServeur.close();
}

void fenetrePrincipale::on_pageWeb_loadProgress(int progress)
{
    this->barreProgresse->show();
    this->barreProgresse->setValue(progress);
}

void fenetrePrincipale::on_pageWeb_loadFinished(bool arg1)
{
    if(arg1)
    {
        this->barreProgresse->hide();
    }
    else if(arg1 == false)
    {
        this->barreProgresse->hide();
    }
}

void fenetrePrincipale::on_actionUtilisation_triggered()
{
    this->a = new aide();
    this->a->show();
}

void fenetrePrincipale::chargement()
{
    QFile configServeur("../configServeur.txt");
    if((configServeur.open(QIODevice::ReadOnly | QIODevice::Text)))
    {
        QTextStream flux(&configServeur);
        this->lien = new QString(flux.readLine());
        if(!(this->lien->isEmpty()))
        {
            ui->pageWeb->setUrl(QUrl(*this->lien));
        }
    }
    configServeur.close();
    ui->actionAccueil->trigger();
}
