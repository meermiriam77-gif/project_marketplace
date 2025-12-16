

```markdown
# 🏫 Campus Marketplace

A multi-user PHP web application for posting and managing items within a campus community.  
Built with **PHP** and **MySQL**, this project was developed over a 13-day sprint to provide CRUD functionality, user authentication, and a styled interface for item sharing.

---

## 📖 Project Overview
Campus Marketplace is designed to allow students and staff to:
- Register and log in securely
- Post items with descriptions
- View items posted by others
- Edit or delete their own posts
- Browse a community feed of all items

This system ensures **session management**, **secure authentication**, and **ownership-based CRUD operations**.

---

## ⚙️ Tech Stack
- **Backend:** PHP (XAMPP/WAMP)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Assets:** Custom background (`mku fountain.jpg`), styled forms and buttons

---

## 🚀 Features
- 🔐 **User Authentication**: Registration, login, session management, and logout  
- 📝 **Item Posting**: Create new posts linked to the logged-in user  
- 📂 **Dashboard**: Personal view of items owned by the user  
- 🌍 **Community Feed**: Public view of all items with poster details  
- ✏️ **Edit/Delete**: Modify or remove only your own posts  
- 🎨 **Styling**: Consistent theme with background image, translucent containers, and gradient buttons  

---

## 🛠️ Installation & Setup
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/campus-marketplace.git
   ```
2. Set up a local server (XAMPP/WAMP).
3. Create a MySQL database named `victor`.
4. Import the schema:
   - `users` table: `id`, `username`, `password`
   - `items` table: `id`, `title`, `description`, `user_id`, `date_posted`
5. Update `db_connect.php` with your database credentials:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $dbname = "victor";
   ```
6. Place project files in your server’s root directory (`htdocs` for XAMPP).
7. Access the app via `http://localhost/campus-marketplace`.

---

## 📅 Development Journal (13-Day Sprint)

### Phase 1: Foundation
- **Day 1:** Database design (`users`, `items`)
- **Day 2:** Database connection (`db_connect.php`)

### Phase 2: Authentication
- **Day 3:** User registration (`register.php`)
- **Day 4:** Login logic (`login.php`)
- **Day 5:** Session management & logout (`logout.php`)

### Phase 3: CRUD
- **Day 6:** Dashboard (`dashboard.php`)
- **Day 7:** Post items (`post_item.php`)
- **Day 8:** View all items (`items.php`)
- **Day 9:** Conditional logic for ownership
- **Day 10:** Edit items (`edit_item.php`)
- **Day 11:** Delete items (`delete_item.php`)

### Phase 4: Styling & Testing
- **Day 12:** Global styling with `mku fountain.jpg`
- **Day 13:** Final testing & deployment prep

---

## 📑 References
- Full project documentation: [Google Doc](https://docs.google.com/document/d/1Ds_0fyd8CmgHtw5vcAMED583IS2cVeXoMRGkhFt2bI4/edit?usp=sharing)

---

## 👩‍💻 Author
**Maysoon Abdinasir Osman**  
📧 meermiriam77@gmail.com

---

## ✅ License
This project is licensed under the MIT License.  
Feel free to use, modify, and distribute with attribution.
```

