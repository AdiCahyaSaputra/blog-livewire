# Run In Your Computer

```bash
git clone https://github.com/AdiCahyaSaputra/blog-livewire
cd blog-livewire

composer install
npm install

# Setup Your Database
cp -r .env.example .env
php artisan migrate:fresh --seed

nvim # Go Check My Code Using Neovim 😎
```
