# student-management
# 1. Clone the repository
git clone https://github.com/pradeepvalia/student-management.git
cd student-management

# 2. Install PHP dependencies
composer install

# 3. Set up the environment configuration
cp .env.example .env

# 4. Run migrations and seed the database
php artisan migrate --seed

# 5. Install frontend dependencies
npm install

# 6. Compile frontend assets
npm run dev

# 7. Start the development server
php artisan serve

# 8. (Optional) Update GitHub remote to use SSH (if needed)
git remote set-url origin git@github.com:pradeepvalia/student-management.git

# 9. Push to GitHub
git add .
git commit -m "Your commit message"
git push origin main


