OneLab Top Managenent module
============================
This Project is owned by Department of Science and Technology Region IX.
The purpose of this project is to collect data from all regional science technology laboratories summarize for top management personnel 
it provides way for the top management to see the progress data of all RSTL in a form of chart and excel exports.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------
The minimum requirement by this project that your Web server supports PHP 7.1.0 and MySQL 5.6, Yii2 Framework

Modules
-------------
1.    Main module
2.    Top Management
3.    Articles
4.    Documentation
5.    System Settings
6.    Role Based Account Controller
7.    Members
8.    Customer Portal
9.    Referral
10.   ePayment

**NOTES:**
- The Data that is being used from top management derive from RSTL Laboratories
- Local EULIMS is equipped with posting module for data synchronization to OneLab API
- Local IT should perform or scheduled data synchronization for the script to run in an available manner that will not hinder 
  the transactions of local EULIMS.
