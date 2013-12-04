#ifndef AIDE_H
#define AIDE_H

#include <QDialog>

namespace Ui {
class aide;
}

class aide : public QDialog
{
    Q_OBJECT

public:
    explicit aide(QWidget *parent = 0);
    ~aide();

private slots:
    void on_pushButton_clicked();

private:
    Ui::aide *ui;
};

#endif // AIDE_H
