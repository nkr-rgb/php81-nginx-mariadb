{{-- ユーザー登録後のメール --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ようこそ</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            max-width: 600px;
            margin: 24px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(31, 45, 61, .1);
            overflow: hidden;
        }
        .hero {
            background: linear-gradient(135deg, #ff7a18, #af002d 70%);
            padding: 32px;
            color: #ffffff;
            text-align: center;
        }
        .hero h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 32px;
            color: #2f3542;
            line-height: 1.8;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 16px;
            background-color: #ff7a18;
            color: #ffffff;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
        }
        .features {
            list-style: none;
            padding-left: 0;
            margin: 24px 0;
        }
        .features li {
            margin-bottom: 12px;
            padding-left: 20px;
            position: relative;
        }
        .features li::before {
            content: '•';
            color: #ff7a18;
            position: absolute;
            left: 0;
        }
        .footer {
            font-size: 12px;
            color: #8a94a6;
            text-align: center;
            padding: 16px 32px 32px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="hero">
            <h1>{{ $user->name }} さん、ようこそ！</h1>
            <p>インスタ風写真投稿アプリへのご登録ありがとうございます。</p>
        </div>
        <div class="content">
            <p>
                この度はアカウントを作成していただきありがとうございます。<br>
                写真を投稿したり、他のユーザーをフォローしたり、あなたの世界観を共有する準備はできていますか？
            </p>
            <ul class="features">
                <li>こだわりの写真をフィードに投稿</li>
                <li>気になるユーザーをフォローして最新の投稿をチェック</li>
                <li>ハッシュタグで話題のトレンドを探索</li>
            </ul>
            <p>まずはプロフィールを整えて、最初の一歩を踏み出しましょう。</p>
            <a href="{{ url('/') }}" class="button">アプリを開く</a>
            <p style="margin-top: 24px;">
                ご不明点がございましたら、このメールに返信するか<br>
                サポートチームまでお気軽にお問い合わせください。
            </p>
        </div>
        <div class="footer">
            このメールは {{ config('app.name') }} から自動送信されています。<br>
            心当たりがない場合は破棄してください。
        </div>
    </div>
</body>
</html>