# Illayrun Intranet – Bus Ticket & Cargo Management Platform

Illayrun Intranet is a **multi-company, multi-branch transportation management system** built with **Laravel 11** and **PHP 8.3**.  
It allows bus companies across Perú to manage:

- 🎫 **Passenger ticket sales**
- 📦 **Cargo / Encomienda shipments**
- 🏢 **Company & Branch management**
- 🚍 **Routes, schedules, fares, and drivers**
- 🧾 **Electronic invoicing (Boleta, Factura, Ticket Interno)**
- 📄 **Shipment waybills (Guía de Remisión)**
- 👥 **User roles and terminal staff operations**

Illayrun centralizes the entire workflow: **buy a seat → generate ticket → issue invoice → board passenger or process shipment**.

## ✨ Core Features

### 🚌 Ticket Sales
- Real-time seat availability  
- Route selection  
- Bus/driver assignment  
- QR ticket validation  
- Internal ticket, Boleta or Factura issuance  

### 📦 Cargo / Encomiendas
- Sender & receiver registration  
- Shipment weight/volume  
- Barcode/QR generation  
- Automatic **Guía de Remisión**  
- Delivery confirmation  

### 🏢 Multi-Company / Multi-Branch
- Each company with independent settings  
- Different terminal/branch staff  
- Custom fares per company  

### 🧾 Electronic Documents (SUNAT-ready)
- Boleta Electrónica  
- Factura Electrónica  
- Ticket Interno  
- Guía de Remisión  

### 👥 User & Access Control
- Super Admin  
- Company Admin  
- Terminal Staff (Tickets / Cargo)  
- Drivers  
- Custom role permissions  

### 📅 Routes & Schedules
- Origin/Destination configuration  
- Timetable system  
- Bus assignment  
- Price configuration per route  

## 🏗️ Tech Stack

| Layer | Technology |
|------|------------|
| Backend | Laravel 11 (PHP 8.3) |
| Frontend | Blade + Tailwind / Bootstrap |
| Database | MySQL 8+ |
| Authentication | Laravel Breeze / Sanctum |
| Build Tool | Vite |
| Deployment | Linux, CPanel, Forge, or VPS |

## 🚀 Installation Guide

### 1️⃣ Clone the repository

```bash
git clone https://github.com/ClarenceMartinez/illayrun-intranet.git
cd illayrun-intranet
