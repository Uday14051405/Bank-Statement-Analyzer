# 1Flo – Bank Statement Analyzer API (Portfolio Project)

[![Laravel](https://img.shields.io/badge/Laravel-10-red)](https://laravel.com)
[![API](https://img.shields.io/badge/API-REST-green)](https://developer.mozilla.org/en-US/docs/Glossary/REST)
[![License](https://img.shields.io/badge/Status-Completed-brightgreen)]()

**1Flo – Bank Statement Analyzer** is a **Laravel-based API platform** designed to analyze bank statements and evaluate financial health. It integrates data from multiple accounts, detects anomalies, and generates insightful reports.  

This project was developed as part of my professional experience, where I contributed to **API architecture design, backend development, anomaly detection logic, and report generation modules**.

---

## 📋 Project Overview
- **Goal:** Automate financial statement analysis for underwriting and risk assessment.  
- **Core Functions:**  
  - Detect tampered or inconsistent statements.  
  - Identify unusual transactions.  
  - Provide income, expense, and obligation summaries.  
  - Generate real-time financial health reports.

---

## 🚀 Key Features
- **360-degree Financial Health Analysis** – Uses payment histories, transaction patterns, and balances for insights.
- **Anomaly Detection** – Identifies fraudulent or tampered transactions.
- **Data Integration** – Consolidates multi-account data for better evaluation.
- **Automated Reporting** – Generates financial summaries and expenditure trends.

---

## 🛠 Tech Stack
- **Backend Framework:** Laravel 10
- **Database:** MySQL
- **API Standard:** RESTful API
- **Authentication:** Laravel Sanctum
- **Reporting Engine:** Custom analytics module

---

## 📦 Installation Guide (For Demonstration)
> Note: This repository is for **portfolio purposes** only. Some sensitive business logic and private data have been removed.

### Steps:
```bash
git clone https://github.com/yourusername/bank-statement-analyzer.git
cd bank-statement-analyzer
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## 💼 My Role & Contributions
- Designed and implemented API architecture in Laravel.
- Built financial data parsing and anomaly detection logic.
- Integrated report generation module for underwriting insights.
- Worked on database design and query optimization for performance.
