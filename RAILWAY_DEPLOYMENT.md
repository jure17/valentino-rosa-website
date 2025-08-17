# Railway Deployment Guide for Valentino Rosa Website

## Prerequisites
1. A GitHub account
2. Your Laravel project pushed to GitHub
3. A Railway account (sign up at [railway.app](https://railway.app))

## Step 1: Prepare Your Repository

Make sure your Laravel project is pushed to GitHub with these files:
- `Procfile` ✅
- `railway.json` ✅
- `.railwayignore` ✅
- `env.example` ✅

## Step 2: Sign Up for Railway

1. Go to [railway.app](https://railway.app)
2. Click "Sign Up" and choose "Continue with GitHub"
3. Authorize Railway to access your GitHub account

## Step 3: Create a New Project

1. Click "New Project"
2. Select "Deploy from GitHub repo"
3. Choose your Laravel repository
4. Click "Deploy Now"

## Step 4: Configure Environment Variables

After deployment starts, go to the "Variables" tab and add:

### Required Variables:
```
APP_NAME="Valentino Rosa"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-app-name.railway.app
```

### Database Variables (if using Railway MySQL):
```
DB_CONNECTION=mysql
DB_HOST=YOUR_RAILWAY_MYSQL_HOST
DB_PORT=3306
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_DATABASE_USER
DB_PASSWORD=YOUR_DATABASE_PASSWORD
```

### Mail Variables:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Valentino Rosa"
```

## Step 5: Generate Application Key

1. Go to the "Deployments" tab
2. Click on the latest deployment
3. Click "View Logs"
4. Run this command in the terminal:
   ```bash
   php artisan key:generate
   ```

## Step 6: Run Database Migrations

In the same terminal, run:
```bash
php artisan migrate
```

## Step 7: Set Up Custom Domain (Optional)

1. Go to the "Settings" tab
2. Click "Custom Domains"
3. Add your domain (e.g., `valentino-rosa.ch`)
4. Update your DNS settings as instructed

## Step 8: Test Your Deployment

1. Visit your Railway URL: `https://your-app-name.railway.app`
2. Test all functionality:
   - Home page
   - Fratelli Rosa page
   - Valentino Rosa page
   - Story page
   - Contact forms
   - Admin panel

## Troubleshooting

### Common Issues:

1. **500 Error**: Check logs in Railway dashboard
2. **Database Connection**: Verify database variables
3. **File Permissions**: Railway handles this automatically
4. **App Key Missing**: Generate with `php artisan key:generate`

### Check Logs:
- Go to your project in Railway
- Click "Deployments" → Latest deployment → "View Logs"

## Cost Information

- **Free Tier**: $5 credit monthly (usually enough for small sites)
- **Paid Plans**: Start at $5/month for more resources

## Support

- Railway Documentation: [docs.railway.app](https://docs.railway.app)
- Railway Discord: [discord.gg/railway](https://discord.gg/railway)

## Next Steps After Deployment

1. Set up monitoring and alerts
2. Configure backup strategies
3. Set up CI/CD for automatic deployments
4. Monitor performance and optimize
