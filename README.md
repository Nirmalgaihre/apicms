# 🎓 Annapurna Polytechnic Institute - Management System
### *Excellence in Technical Education*

A comprehensive, full-stack web platform designed to digitize administrative workflows and enhance public engagement for **Annapurna Polytechnic Institute (API)**. This system serves as the official digital hub for faculty, students, and the general public.

---

## 🏛 Frontend Features

The frontend is crafted for speed, clarity, and accessibility, using a modern **Tailwind CSS** UI.

* **🇳🇵 Native Date Integration:** Real-time display of the current date in Nepali script using `LaravelNepaliDate`.
* **📢 Dynamic Notice Board:** A live-updating system for the latest 10 notices regarding exams, admissions, and events.
* **🌾 Agriculture Focused:** Dedicated sections showcasing specialized Diploma programs in **Plant Science** and **Animal Science**.
* **👨‍💼 Leadership Section:** A prominent "Principal’s Message" area for official institutional communication.
* **👥 Staff Directory:** An organized display of faculty members, sorted logically by hierarchy and position.
* **🖼 Multimedia Gallery:** High-performance photo and video galleries to showcase campus infrastructure and activities.
* **🖋 Academic Blog & Publications:** A digital library for campus news, journals, and research papers.
* **📱 Responsive Design:** Mobile-first experience using **Tailwind CSS** and **Plus Jakarta Sans**.

---

## 🛠 Admin Features (CMS)

* **Unified Dashboard:** Full CRUD (Create, Read, Update, Delete) control over all frontend content modules.
* **Staff Management:** Easily manage faculty profiles, designations, and display order.
* **Media Management:** Automated handling of gallery images and document uploads for publications.
* **Resource Center:** A central repository for students to download curriculum resources and official forms.
* **Secure Access:** Multi-layered authentication to protect sensitive institutional data.
* **SEO Optimized:** Pre-configured with dynamic Meta tags and JSON-LD schema for better search engine visibility.

---

## 💻 Technical Stack

| Component          | Technology                               |
|-------------------|-----------------------------------------|
| **Backend**        | PHP 8.4.16                              |
| **Framework**      | Laravel 13.8.0                          |
| **Database**       | MySQL (Relational)                       |
| **Frontend**       | Tailwind CSS & Alpine.js                 |
| **Dev Environment**| Kali Linux                               |
| **Date API**       | `Anuzpandey/LaravelNepaliDate`          |

---

## 📂 Project Structure Highlights

* **`HomeController`**: Manages complex data injection for the landing page (Notices, Staff, Gallery).
* **`app.blade.php`**: Unified layout file ensuring consistent SEO, styles, and scripts across pages.
* **Database Migrations**: Structured schema for `notices`, `staff`, `galleries`, and `publications`.

---

## 📂 Core Components

* **`HomeController`**: Fetches and injects all critical landing page data in a single optimized request.
* **`app.blade.php`**: Master layout file managing global SEO, styles, and scripts.
* **Announcement Management**: Handles logic for public programs and short-term courses.
* **Staff Management Module**: Sorts staff by hierarchy and department automatically.
* **Gallery Module**: Automatically fetches thumbnails and optimizes gallery media performance.

---

## 🛡 License & Copyright

**Copyright © 2026 Nirmal Gaihre.** All rights reserved.  

This software is proprietary and developed specifically for **Annapurna Polytechnic Institute**, Kahundanda, Kaski.

---

*Last Updated: May 2026*  
*Developed by: [Nirmalgaihre](https://facebook.com/nirmalgaihre.com.np)*