# 🏦 Application Bancaire Console – PHP OOP & PDO

## 📌 Description
Cette application est une application bancaire en mode console développée en **PHP**, destinée à l’apprentissage de la **Programmation Orientée Objet (POO)** et de la manipulation d’une base de données relationnelle avec **PDO**.

Elle permet de gérer :
- Les clients
- Les comptes bancaires
- Les transactions (dépôts et retraits)

Le projet respecte les bonnes pratiques du développement back-end et met l’accent sur la séparation des responsabilités et la modélisation UML.

---

## 🎯 Objectifs pédagogiques
- Comprendre et appliquer la POO en PHP
- Utiliser PDO avec des requêtes préparées
- Implémenter un CRUD complet
- Appliquer les règles métier bancaires
- Structurer un projet back-end proprement
- Comprendre la modélisation UML (diagrammes)

---

## 🗂️ Structure du projet
├── config/
│ └── Database.php # Connexion PDO (Singleton)
├── src/
│ ├── Client.php 
│ ├── Transaction.php│
│ ├── Compte.php 
│ ├── CompteCourant.php
│ ├── CompteEpargne.php
├── Repository/
│ ├──CompteRepository.php
│ ├── ClientRepository.php
│ └── TransactionRepository.php
├── public/
│ └── index.php # Tests 
└── database.sql 

