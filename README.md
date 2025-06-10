# Kavenegar Notifications Channel for Laravel 12+

این پکیج کار ارسال آسان پیامک با استفاده از سرویس کاوه‌نگار را در Laravel 12 و بالاتر فراهم می‌کند.

## فهرست مطالب

- [نصب](#installation)
    - [راه‌اندازی حساب کاربری کاوه‌نگار](#setting-up-your-kavenegar-account)
- [نحوه استفاده](#usage)
- [مشارکت در توسعه](#contributing)

---

## Installation

می‌توانید پکیج را با استفاده از کامپوزر نصب کنید:

```bash
composer require kavenegar/laravel-notification
```

در لاراول 12+ دیگر نیازی به اضافه کردن دستی سرویس‌پرووایدر در config/app.php نیست، چون سرویس‌پرووایدر به صورت خودکار (با توجه به extra.laravel.providers در composer.json) ثبت می‌شود.

فقط کافی است تنظیمات زیر را انجام دهید.


### راه‌اندازی حساب کاربری کاوه‌نگار


کلید API و شماره فرستنده خود را در فایل config/services.php اضافه کنید:
`config/services.php`:

```php
// config/services.php

'kavenegar' => [
    'key' => env('KAVENEGAR_API_KEY'),
    'sender' => env('KAVENEGAR_SENDER'),
],

```

و در فایل .env مقداردهی کنید:
```php
KAVENEGAR_API_KEY=your_api_key_here
KAVENEGAR_SENDER=your_sender_number_here
```

## Usage

برای استفاده از کانال در نوتیفیکیشن خود، در متد via() آن کانال را معرفی کنید:


``` php
use Kavenegar\LaravelNotification\KavenegarChannel;
use Illuminate\Notifications\Notification;

class HappyNewYear extends Notification
{
    public function via($notifiable)
    {
        return [KavenegarChannel::class];
    }

    public function toSMS($notifiable)
    {
        return 'Happy new year :D';
    }
}

```

### تنظیم شماره موبایل گیرنده
برای اینکه نوتیفیکیشن بداند پیامک را به کدام شماره ارسال کند، در مدل قابل نوتیفیکیشن (مثلاً مدل User) متد زیر را اضافه کنید:
```php
public function routeNotificationForSms()
{
    return $this->phone; // فرض بر این است که شماره موبایل در فیلد phone ذخیره شده است
}
```


## Contributing

Bug fixes, docs, and enhancements welcome! Please let us know <a href="mailto:support@kavenegar.com?Subject=SDK" target="_top">support@kavenegar.com</a>

<hr> 
<div dir='rtl'>
	
## راهنما

### معرفی سرویس کاوه نگار

کاوه نگار یک وب سرویس ارسال و دریافت پیامک و تماس صوتی است که به راحتی میتوانید از آن استفاده نمایید.

### ساخت حساب کاربری

اگر در وب سرویس کاوه نگار عضو نیستید میتوانید از [لینک عضویت](http://panel.kavenegar.com/client/membership/register) ثبت نام  و اکانت آزمایشی برای تست API دریافت نمایید.

### مستندات

برای مشاهده اطلاعات کامل مستندات [وب سرویس پیامک](http://kavenegar.com/وب-سرویس-پیامک.html)  به صفحه [مستندات وب سرویس](http://kavenegar.com/rest.html) مراجعه نمایید.

### راهنمای فارسی

در صورتی که مایل هستید راهنمای فارسی کیت توسعه کاوه نگار را مطالعه کنید به صفحه [کد ارسال پیامک](http://kavenegar.com/sdk.html) مراجعه نمایید.

### اطالاعات بیشتر
برای مطالعه بیشتر به صفحه معرفی
[وب سرویس اس ام اس ](http://kavenegar.com)
کاوه نگار
مراجعه نمایید .

 اگر در استفاده از کیت های سرویس کاوه نگار مشکلی یا پیشنهادی  داشتید ما را با یک Pull Request  یا  ارسال ایمیل به support@kavenegar.com  خوشحال کنید.
 
##
![http://kavenegar.com](http://kavenegar.com/public/images/logo.png)		

[http://kavenegar.com](http://kavenegar.com)	

</div>


