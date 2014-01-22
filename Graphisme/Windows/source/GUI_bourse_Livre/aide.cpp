#include "aide.h"
#include "ui_aide.h"

aide::aide(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::aide)
{
    ui->setupUi(this);
}

aide::~aide()
{
    delete ui;
}

void aide::on_pushButton_clicked()
{
    this->close();
}
