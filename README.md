# Laravel Comment System  

A lightweight yet powerful **comment system for Laravel** that works seamlessly with **any type of post** — blog articles, videos, audios, or custom content.  

This package allows your users to engage with your content effortlessly, while giving you full flexibility and customization options. 🚀  

---

## ✨ Features  

- 📝 Add comments to **any model** (posts, videos, audios, or custom entities).  
- 🎨 Beautiful, ready-to-use **frontend UI** out of the box.  
- ⚡ Quick installation – just **one line of code** to show comments.  
- 🗂️ Configurable settings – publish the vendor file and tweak it your way.  
- 🛠️ Built with **Laravel + Livewire**, making it dynamic and reactive.  
- 🤝 Open for contributions – improve and extend together.  

---

## 📦 Installation  

Clone the package into your Laravel project:  

```bash
composer require fawad/laravel-comments
```

Or install directly from GitHub:  

```bash
git clone https://github.com/fadi06/comment-system.git
```

---

## ⚙️ Publish Vendor Files  

To customize the configuration, publish the vendor files:  

```bash
php artisan vendor:publish --tag="comment-config"
```

Next Step: 

```bash
php artisan vendor:publish --tag="comment-view"
```

---
## ⚙️ Run Migrations
To run migration run the below command
```bash
php artisan migrate
```

Next Step: 

> ```bash
> npm run build
> ```

---
## 🚀 Usage  

Adding the comment system to your project is **super simple**.  
Just drop this line into your Blade file (e.g., under your blog post):   

>```blade
><livewire:comments :model="$post" />
>```

That’s it! 🎉  
Now every post will have its own **dynamic comment section**.  

---

## 🔧 Configuration  

Once published, you can edit the config file to:  

- Change table names  
- Customize views  
- Adjust behavior according to your needs  

---

## 💡 Example  

Add comments under your blog posts like this:  

```php
// Inside your controller
$post = Post::findOrFail($id);

return view('post.show', compact('post'));
```

```blade
{{-- Inside your Blade --}}
<livewire:comments :model="$post" />
```

Now your users can start commenting on posts instantly.  

---

## 🤝 Contributing  

Contributions are **warmly welcome!**  
If you’d like to add features, fix bugs, or improve documentation:  

1. Fork the repository  
2. Create your feature branch (`git checkout -b feature/YourFeature`)  
3. Commit your changes (`git commit -m 'Add some feature'`)  
4. Push to the branch (`git push origin feature/YourFeature`)  
5. Open a Pull Request  

---

## 🔔 Note  
If the preview view does not appear in your Blade file, publish the vendor views using:  

```bash
php artisan vendor:publish --tag=laravel-comments-views
```  

Then run the build command again:  

```bash
npm run build
```

