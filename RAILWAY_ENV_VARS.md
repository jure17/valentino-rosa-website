# Railway Environment Variables - Complete Setup

## 🚨 CRITICAL - These MUST be set first:

```
APP_NAME="Valentino Rosa"
APP_ENV=production
APP_KEY=base64:v96MqgN4NVN5f+P0PTJhkGan9TmPyCiyd/jZgZb80m8=
APP_DEBUG=false
APP_URL=https://web-production-e5cb4.up.railway.app
```

## 🗄️ Database Variables (SQLite - No Setup Required):

```
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
```

## 📧 Mail Variables (Optional - Set to log for now):

```
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@valentino-rosa.ch
MAIL_FROM_NAME="Valentino Rosa"
```

## 🔧 Additional Laravel Variables:

```
LOG_CHANNEL=stack
LOG_LEVEL=debug
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
```

## 📱 Vite Variables (for asset compilation):

```
VITE_APP_NAME="Valentino Rosa"
```

## 🚀 How to Set These in Railway:

1. Go to your Railway project
2. Click on the "web" service
3. Go to "Variables" tab
4. Add each variable one by one
5. Click "Add Variable" after each one
6. Save changes

## 🔍 Troubleshooting:

If you still get errors after setting these:

1. **Check Railway Logs** - Look for specific error messages
2. **Verify APP_KEY** - Make sure it's exactly: `base64:v96MqgN4NVN5f+P0PTJhkGan9TmPyCiyd/jZgZb80m8=`
3. **Check APP_URL** - Should match your Railway URL exactly
4. **Database** - Make sure DB_CONNECTION=sqlite

## 📋 Complete Variable List (Copy & Paste):

```
APP_NAME="Valentino Rosa"
APP_ENV=production
APP_KEY=base64:v96MqgN4NVN5f+P0PTJhkGan9TmPyCiyd/jZgZb80m8=
APP_DEBUG=false
APP_URL=https://web-production-e5cb4.up.railway.app
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@valentino-rosa.ch
MAIL_FROM_NAME="Valentino Rosa"
LOG_CHANNEL=stack
LOG_LEVEL=debug
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
VITE_APP_NAME="Valentino Rosa"
```
