#include "config.h"
#include "ui_config.h"

Config::Config(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::Config)
{
    ui->setupUi(this);
    ui->lineEdit->setText("http://");
    ui->lineEdit_2->setText("80");
}

Config::~Config()
{
    delete ui;
}

void Config::on_buttonBox_accepted()
{
    if(ui->lineEdit->text() == "" || ui->lineEdit_2->text() == "")
    {
        QMessageBox::warning(this, "Attention", "Le serveur est mal configuré, veuillez le reconfigurer.");
    }
    else
    {
        QString string(ui->lineEdit->text() + ":" + ui->lineEdit_2->text());
        QFile configServeur("../configServeur.txt");
        if(!(configServeur.open(QIODevice::WriteOnly)))
        {
             QMessageBox::critical(this, "Erreur Configuration du Serveur", "Erreur dû à la configuration du serveur, veuillez contacter un administrateur.");
        }
        else
        {
            QTextStream contenuFic(&configServeur);
            contenuFic << string;
        }
        configServeur.close();
    }
}
