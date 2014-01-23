/********************************************************************************
** Form generated from reading UI file 'aide.ui'
**
** Created by: Qt User Interface Compiler version 5.2.0
**
** WARNING! All changes made in this file will be lost when recompiling UI file!
********************************************************************************/

#ifndef UI_AIDE_H
#define UI_AIDE_H

#include <QtCore/QVariant>
#include <QtWebKitWidgets/QWebView>
#include <QtWidgets/QAction>
#include <QtWidgets/QApplication>
#include <QtWidgets/QButtonGroup>
#include <QtWidgets/QDialog>
#include <QtWidgets/QHeaderView>
#include <QtWidgets/QPushButton>
#include <QtWidgets/QVBoxLayout>
#include <QtWidgets/QWidget>

QT_BEGIN_NAMESPACE

class Ui_aide
{
public:
    QWidget *verticalLayoutWidget;
    QVBoxLayout *verticalLayout;
    QWebView *viewTuto;
    QPushButton *pushButton;

    void setupUi(QDialog *aide)
    {
        if (aide->objectName().isEmpty())
            aide->setObjectName(QStringLiteral("aide"));
        aide->resize(434, 713);
        aide->setMaximumSize(QSize(434, 713));
        verticalLayoutWidget = new QWidget(aide);
        verticalLayoutWidget->setObjectName(QStringLiteral("verticalLayoutWidget"));
        verticalLayoutWidget->setGeometry(QRect(-1, 9, 431, 701));
        verticalLayout = new QVBoxLayout(verticalLayoutWidget);
        verticalLayout->setObjectName(QStringLiteral("verticalLayout"));
        verticalLayout->setSizeConstraint(QLayout::SetMaximumSize);
        verticalLayout->setContentsMargins(0, 0, 0, 0);
        viewTuto = new QWebView(verticalLayoutWidget);
        viewTuto->setObjectName(QStringLiteral("viewTuto"));
        viewTuto->setUrl(QUrl(QStringLiteral("qrc:/icones/tuto.html")));
        viewTuto->setRenderHints(QPainter::Qt4CompatiblePainting|QPainter::SmoothPixmapTransform|QPainter::TextAntialiasing);

        verticalLayout->addWidget(viewTuto);

        pushButton = new QPushButton(verticalLayoutWidget);
        pushButton->setObjectName(QStringLiteral("pushButton"));

        verticalLayout->addWidget(pushButton);


        retranslateUi(aide);

        QMetaObject::connectSlotsByName(aide);
    } // setupUi

    void retranslateUi(QDialog *aide)
    {
        aide->setWindowTitle(QApplication::translate("aide", "Aide", 0));
        pushButton->setText(QApplication::translate("aide", "Quitter", 0));
    } // retranslateUi

};

namespace Ui {
    class aide: public Ui_aide {};
} // namespace Ui

QT_END_NAMESPACE

#endif // UI_AIDE_H
