<?php
// ───── عداد الزيارات باستخدام ملف visits.txt ─────
$counterFile = 'visits.txt';

// التأكد من وجود الملف، وإنشائه بالقيمة 0 إذا لم يكن موجودًا
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, '0', LOCK_EX);
}

// فتح الملف للقراءة والكتابة بطريقة آمنة
$handle = fopen($counterFile, 'c+');
if ($handle) {
    // قفل الملف لمنع التضارب
    if (flock($handle, LOCK_EX)) {
        // قراءة العدد الحالي
        $currentCount = (int)fread($handle, filesize($counterFile) ?: 1);
        // زيادته بواحد
        $currentCount++;
        // العودة إلى بداية الملف وتفريغه
        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, (string)$currentCount);
        // تحرير القفل
        flock($handle, LOCK_UN);
    } else {
        // فشل القفل، نقرأ فقط
        $currentCount = (int)file_get_contents($counterFile);
    }
    fclose($handle);
} else {
    // فشل فتح الملف، نقرأ فقط
    $currentCount = (int)file_get_contents($counterFile);
}

// تنسيق العدد ليكون مناسبًا للعرض بالعربية
$formattedCount = number_format($currentCount, 0, '', ',');
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta name="google-site-verification" content="S6eFf4rdfJPWkfB8PyrvPL72x-1gnlEp-bRPXKeIrOQ" />
    <meta name="yandex-verification" content="b4837034f5b3785a" />
    <meta charset="utf-8">
    <meta name="Description" content="اذكار، أذكار، الأذكار، دعاء، ادعية، أدعية، ذكر، تسبيح، تسابيح، سبحة، سبح، اذكار الصباح، اذكار المساء، اذكار الصباح والمساء اليومية، الأذكار، اذكار المسلم، اذكار الصلاة، اذكار الوضوء، اذكار النوم، اذكار الاستيقاظ، اذكار الطعام، اذكار التشهد، اذكار الخلاء، اذكار المسجد، اذكار الآذان، اذكار المنزل، دعاء ختم القرآن الكريم، اذكار عظيمة، أذكار الحج والعمرة، أدعية نبوية، الأدعية القرآنية، فضل الدعاء، فضل الذكر، فضائل السور، جوامع الدعاء،أذكار بعد الصلاة، أسماء الله الحسنى، الرُّقية الشرعية، الرُّقية الشرعية من القرآن والسن، أدعية للميّت، أدعية للمتوفى، أدعية للمتوفية، أزهر، الأزهر،إفتاء،دار الإفتاء، Azkar, Athkar, Alathkar, Doaa, Muslim daily blessings. Azkar Al Muslim. Athkar Al Muslim">
    <meta name="Keywords" content="اذكار، أذكار، الأذكار، دعاء، ادعية، أدعية، ذكر، تسبيح، تسابيح، سبحة، سبح، اذكار الصباح، اذكار المساء، اذكار الصباح والمساء اليومية، الأذكار، اذكار المسلم، اذكار الصلاة، اذكار الوضوء، اذكار النوم، اذكار الاستيقاظ، اذكار الطعام، اذكار التشهد، اذكار الخلاء، اذكار المسجد، اذكار الآذان، اذكار المنزل، دعاء ختم القرآن الكريم، اذكار عظيمة، أذكار الحج والعمرة، أدعية نبوية، الأدعية القرآنية، فضل الدعاء، فضل الذكر، فضائل السور، جوامع الدعاء،أذكار بعد الصلاة، أسماء الله الحسنى، الرُّقية الشرعية، الرُّقية الشرعية من القرآن والسن، أدعية للميّت، أدعية للمتوفى، أدعية للمتوفية، أزهر، الأزهر،إفتاء،دار الإفتاء، Azkar, Athkar, Alathkar, Doaa, Muslim daily blessings. Azkar Al Muslim. Athkar Al Muslim">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7JVJW1RTYK"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-7JVJW1RTYK');
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>اذكاري</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&amp;family=Tajawal:wght@300;500;700&amp;display=swap">
    
    <style>
        :root {
            --primary-green: #1f4e3d;
            --accent-gold: #d4af37;
            --bg-light: #fdfbf7;
            --card-bg: #ffffff;
            --text-dark: #2c3e50;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-light);
            background-image: radial-gradient(#d4af3733 1px, transparent 1px);
            background-size: 20px 20px;
            font-family: 'Tajawal', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .donate-corner {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 100;
        }

        .donate-link {
            background: rgba(212, 175, 55, 0.2);
            border: 1px solid var(--accent-gold);
            color: var(--accent-gold);
            padding: 8px 15px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .donate-link:hover {
            background: var(--accent-gold);
            color: white;
            transform: scale(1.05);
        }

        header {
            padding: 3rem 1rem 4rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green), #14362a);
            color: white;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-family: 'Amiri', serif;
            font-size: 3.2rem;
            color: var(--accent-gold);
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        header span {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        main {
            flex: 1;
            max-width: 800px;
            margin: -3rem auto 2rem; 
            width: 95%;
            position: relative;
            z-index: 10;
        }

        .container-box {
            background: var(--card-bg);
            box-shadow: 0 10px 30px rgba(31, 78, 61, 0.08);
            border-radius: 25px;
            padding: 2rem;
            border: 1px solid rgba(0,0,0,0.03);
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .btn {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            color: var(--primary-green);
            padding: 20px 10px;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .btn:hover {
            background: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(31, 78, 61, 0.2);
        }

        .btn-full {
            grid-column: span 3;
            background: rgba(212, 175, 55, 0.1);
            border-color: var(--accent-gold);
            color: #b5952f;
            margin-top: 10px;
            font-size: 1.2rem;
        }

        .btn-full:hover {
            background: var(--accent-gold);
            color: white;
            border-color: var(--accent-gold);
        }

        .visit-counter-wrapper {
            text-align: center;
            margin-top: 2rem;
            padding-bottom: 1.5rem;
        }

        .visit-counter {
            display: inline-block;
            background: var(--card-bg);
            border: 2px solid var(--accent-gold);
            border-radius: 50px;
            padding: 12px 28px;
            box-shadow: 0 6px 20px rgba(31, 78, 61, 0.08);
            font-family: 'Tajawal', sans-serif;
            color: var(--primary-green);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .visit-counter .count-number {
            color: var(--accent-gold);
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0 6px;
            font-family: 'Amiri', serif;
        }

        .visit-counter .count-icon {
            margin-left: 6px;
            font-size: 1.1rem;
        }

        @media (max-width: 600px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr); 
                gap: 12px;
            }
            .btn-full {
                grid-column: span 2;
            }
            .btn {
                font-size: 1rem;
                padding: 15px 5px;
            }
            header {
                padding: 2rem 1rem 3rem;
            }
            .donate-corner {
                top: 10px;
                left: 10px;
            }
            .donate-link {
                padding: 5px 12px;
                font-size: 0.8rem;
            }
            .visit-counter {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            .visit-counter .count-number {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <div class="donate-corner">
        <a href="pages/تبرع.html" class="donate-link">
            <span>❤</span> دعم الموقع
        </a>
    </div>

    <header>
        <h1>اذكاري</h1>
        <span>حِصْنُ الْمُسْلِمِ</span>
    </header>

    <main>
        <div class="container-box">
            <div class="grid-container">
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A7%D9%84%D8%B5%D8%A8%D8%A7%D8%AD.html" class="btn">أذكار الصباح</a>
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A7%D9%84%D9%85%D8%B3%D8%A7%D8%A1.html" class="btn">أذكار المساء</a>
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A8%D8%B9%D8%AF_%D8%A7%D9%84%D8%B5%D9%84%D8%A7%D8%A9.html" class="btn">بعد الصلاة</a>
                <a href="https://adkari.uk/pages/%D8%AA%D8%B3%D8%A7%D8%A8%D9%8A%D8%AD.html" class="btn">تسابيح</a>
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A7%D9%84%D9%86%D9%88%D9%85.html" class="btn">أذكار النوم</a>
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A7%D9%84%D8%A7%D8%B3%D8%AA%D9%8A%D9%82%D8%A7%D8%B8.html" class="btn">الاستيقاظ</a>
                <a href="https://adkari.uk/pages/%D8%A7%D8%B0%D9%83%D8%A7%D8%B1_%D8%A7%D9%84%D9%88%D8%B6%D9%88%D8%A1.html" class="btn btn-full">أذكار الوضوء</a>
            </div>
        </div>

        <!-- ── عداد الزيارات يظهر العدد من ملف visits.txt ── -->
        <div class="visit-counter-wrapper">
            <div class="visit-counter">
                <span class="count-icon">👁️</span>
                عدد الزيارات:
                <span class="count-number"><?php echo $formattedCount; ?></span>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('click', function() {
            const randomNumber = Math.floor(Math.random() * 11) + 1; 
            const resultDisplay = document.getElementById('result');
            if (resultDisplay) {
                resultDisplay.innerText = randomNumber;
            }

            if (randomNumber === 10) {
                const urls = [
                    'https://www.google.com/search?q=site%3Ahttps%3A%2F%2Fadkari.uk&oq=site%3Ahttps&gs_lcrp=EgZjaHJvbWUqBggBEEUYOzIGCAAQRRg7MgYIARBFGDsyBggCEEUYOTIGCAMQRRg60gEINzkyNmowajeoAhSwAgHxBfC6A1ccOHYf8QXwugNXHDh2Hw&client=ms-android-motorola-rvo3&sourceid=chrome-mobile&ie=UTF-8#sbfbu=1&pi=site:https://adkari.uk',
                ];
                const randomUrl = urls[Math.floor(Math.random() * urls.length)];
                window.open(randomUrl, '_blank');
            }
        }, { once: true });
    </script>

</body>
</html>
