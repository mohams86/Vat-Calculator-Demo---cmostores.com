# Vat Calculator Exercise

•	Author: [mohams86](https://github.com/mohams86/) <br>

## Technical Requirements
•	PHP 8.2 or higher <br>
•	Composer installed <br>

## Prerequisites
•	Basic PHP knowledge <br>
•	Low level HTML & CSS knowledge <br>
•	Object-Oriented Programming <br>
•	Please run composer update for the first time in order to download required dependencies related to Symfony

## Vat Calculator Overview

If you access url like this http://localhost/vat_calculator_demo/public/vatcalculator then you will be able to see the Vat Calculator page.

If you access url like this http://localhost/vat_calculator_demo/public/vatcalculationhistory then Vat Calculation History page will appear.

## 1. Vat Calculator page

There's a Vat Calculator page on which user can enter his/her desired amount, Vat rate(%) and need to select operation whether Add Vat or Remove Vat and system will store the Vat calculation history data under the database table called "vat_calculation_history" and vat calculation history will be displayed on listing page.

## 2. Vat Calculation History page

Vat Calculation History page displays all the calculation history data stored based on the amount, vat rate and operation selected by the user on Vat Calculator page. There's provision to delete as well as export the vat calculation history data also on the same page.

## 3. Project structure

If we open our project in any code editor, you can see a very thin project because we pulled in **Symfony’s skeleton**. The Symfony Skeletion doesn't add many dependencies, but only the components that are needed to run a Symfony project in the browser.

| **Name**       | **Explanation** |
| -------------  |-------------|
| bin            | Has the ```console``` file which is the main entry point |
| config         | Default and sensible configuration files |
| migrations     | Place where you store your database migrations |
| public         | Has the ```index.php``` file which will be the main entry point for all dynamic http resources |
| src            | Most important folder, all code you write will be stored right here |
| var            | Contains all ```caches```, ```logs``` and files that are generated at runtime by the application |
| vendor         | Had the files that you pull in through Composer |
| .env           | You store individual working environment variables that you can use throughout your app |
| composer.json  | Specifies a common project properties, meta data and dependencies |
| composer.lock  | When running ```composer install``` for the first time, or when running ```composer update``` a lock file called composer.lock will be created  |
| symfony.lock   | It is the proper lock file for Symfony recipes instead of trying to guess via the state of composer.lock |

## Notes
---------
I have downloaded and setup Symfony 6.2.11 under Wampserver on Windows machine and then started working on the Vat Calculator task based on the email received.

I have created a new controller called VatCalculatorController.php under src/Controller folder which contains all the required methods for storing vat calculation history data under database table, display list of vat calculation history data, deletion of vat calculation history data, export vat calculation history data in csv file.
---
src/Controller/VatCalculatorController.php

I have created a new entity called VatCalculationHistory.php under src/Entity folder which contains all the methods related to get and set data for the fields of database table.
---
src/Entity/VatCalculationHistory.php

I have created a new formtype called VatCalculatorFormType.php under src/Form folder which is responsible for displaying Vat Calculator form.
---
src/Form/VatCalculatorFormType.php

I have created a new repository file called VatCalculationHistoryRepository.php under src/Repository folder related to database operation.
---
src/Repository/VatCalculationHistoryRepository.php

I have created new twig html files related to Vat Calculator under templates folder which are used for front-end and html elements mostly.
---
vatcalculationhistory.html.twig - Vat Calculation History list
vatcalculator.html.twig - Vat Calculator page

I have generated a migration file called Version20230527171628.php under migrations folder which can be used to create required database table called vat_calculation_history.
---
migrations/Version20230527171628.php

Please find the below routes which are added new related to Vat Calculator
Vat Calculation History listing page

#[Route('/vatcalculationhistory', name: 'vatcalculationhistory')]

Vat Calculator page

#[Route('/vatcalculator', name: 'vatcalculator')]
