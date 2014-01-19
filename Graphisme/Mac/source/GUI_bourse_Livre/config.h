#ifndef CONFIG_H
#define CONFIG_H

#include <QDialog>
#include <iostream>
#include <fstream>
#include <QMessageBox>
#include <QFile>
#include <QString>
#include <QTextStream>

namespace Ui {
class Config;
}

class Config : public QDialog
{
    Q_OBJECT

public:
    explicit Config(QWidget *parent = 0);
    ~Config();

private slots:
    void on_buttonBox_accepted();

private:
    Ui::Config *ui;
};

#endif // CONFIG_H
