## 📈 About Apriori Algorithm

This project implements the Apriori algorithm to discover association rules in transaction data.  
It calculates:

- Support
- Confidence
- Frequent itemsets

The result is used to recommend product placement and understand buying patterns.

## 📁 Project Structure

apriori-market-basket-analysis/

├── assets/ # CSS, JS, Bootstrap, libraries

├── DATABASE/ # SQL database

├── export/ # Export PDF / Excel

├── import/ # Import data

├── koneksi.example.php # Example database configuration

├── database.php # Database connection handler

├── proses_apriori.php # Apriori algorithm

├── mining.php # Mining results

└── index.php # Main dashboard

## 🛠️ Built With

- PHP (Native)
- MySQL
- Bootstrap
- JavaScript
- Apriori Algorithm

## ⚙️ Installation & Setup

Clone this repository
```bash

git clone https://github.com/thmsalfan/apriori-market-basket-analysis.git
Move the project folder to:
C:/xampp/htdocs/
Import database:
DATABASE/db_apriori.sql
Copy the example configuration:
koneksi.example.php → koneksi.php
Edit koneksi.php and adjust your database credentials.
## Run the project:
http://localhost/apriori-market-basket-analysis

## Default Login
Tambahkan:
```markdown id="z8abn9"
## Default Login
| Role  | Username | Password |
|-------|---------|---------|
| Admin | admin   | 12345   |

## 📸 Screenshots

- Dashboard
Login Page : 
<img width="1919" height="911" alt="Screenshot 2026-03-31 142822" src="https://github.com/user-attachments/assets/d41daa39-27eb-4846-ac4e-fe02b6c308fe" />

Dashboard : 
<img width="1919" height="913" alt="Screenshot 2026-03-31 143140" src="https://github.com/user-attachments/assets/ad18326c-20f3-45b3-9533-7896d51748bf" />

- Apriori result page :
<img width="1919" height="788" alt="Screenshot 2026-03-31 143301" src="https://github.com/user-attachments/assets/eb920203-8ae5-45f6-b63d-38623b9c7b60" />

- Association rule output
<img width="1696" height="878" alt="image" src="https://github.com/user-attachments/assets/220c0ce0-8b4a-462e-88cf-937860c8d2de" />

#Noted
## ⚙️ System Requirements

| Component | Version |
|----------|--------|
| PHP      | 5.2.1  |
| MySQL    | Any    |
| Server   | XAMPP / Apache |

> ⚠️ Important:
> This project was developed using PHP 5.2.1. Compatibility issues may occur on newer PHP versions.


## 👨‍💻 Author
Thomas Alfan  
GitHub: https://github.com/thmsalfan





