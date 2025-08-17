# Email Setup Guide

## Current Configuration
The contact form is now fully functional! Currently, emails are being logged to the Laravel log file for development purposes.

## How to Change Email Recipient
To change the email recipient, edit the `ContactController.php` file:

```php
// In app/Http/Controllers/ContactController.php, line 47
Mail::to('your-email@example.com')->send(new PropertyInquiry($inquiryData));
```

## How to Send Real Emails (Production)

### Option 1: Gmail SMTP
Add these lines to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-gmail@gmail.com
MAIL_FROM_NAME="Valentino Rosa SA"
```

**Note:** For Gmail, you need to use an "App Password" instead of your regular password.

### Option 2: Mailgun
Add these lines to your `.env` file:

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Valentino Rosa SA"
```

### Option 3: SendGrid
Add these lines to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Valentino Rosa SA"
```

## Testing
- For development: Emails are logged to `storage/logs/laravel.log`
- For production: Emails will be sent to the configured email address

## Email Template
The email template is located at `resources/views/emails/property-inquiry.blade.php` and includes:
- Property details
- Contact information
- Message content
- Timestamp and IP address
- Beautiful styling with Valentino Rosa branding 