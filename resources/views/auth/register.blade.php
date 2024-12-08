<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DaylyQuest</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<style>
    * {
        box-sizing: border-box;
    }

    img {
        display: block;
        width: 100%;
    }

    body {
        max-width: 500px;
        background-image: linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px),
            linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px);
        background-size: 120px 120px;
        background-position: center;
    }

    .input-field,
    .submit-btn {
        border-radius: 16px;
        padding-top: 16px;
        padding-bottom: 16px;
    }
</style>

<body class="bg-bg_black mx-auto px-5 sm:px-10">
    <section class="flex flex-col h-screen justify-center">
        <div class="text-3xl font-semibold flex items-center gap-[16px]">
            <span class="w-[8px] h-[40px] bg-secondary inline-block rounded"></span>
            <span class="font-poppins font-bold text-white text-4xl">Create Account</span>
        </div>
        <form action="/register" method="POST" class="flex flex-col items-center gap-5 w-full mt-8">
            @csrf
            <input type="text" placeholder="Your Name" name="name" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
            <input type="text" placeholder="Nickname" name="nickname" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
            <input type="email" placeholder="E-mail" name="email" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
            <div class="flex gap-5">
                <input type="password" placeholder="Password" name="password" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
                <input type="password" placeholder="Confirm Password" name="password_confirmation" class="input-field font-roboto bg-bg_gray border border-2 border-detail px-6 w-full text-white" required>
            </div>
            <button type="submit" class="submit-btn font-poppins text-lg font-semibold bg-primary px-6 w-full hover:bg-[#A772E8] hover:scale-105 transition-all duration-200 ease-in-out">
                Create Account
            </button>

            @if($errors->any())
            <ul class="self-start">
                @foreach($errors->all() as $error)
                <li class="text-sm text-error font-semibold mt-1">
                    {{ $error }}
                </li>
                @endforeach
            </ul>
            @endif
        </form>
        <div class="mt-8 text-center text-text_gray text-lg">
            <span>Already have an account? <a href="/login" class="inline-block text-white underline">Login</a></span>
        </div>
        <div class="text-center text-text_gray text-base" style="margin-top: 8px;">
            <a href="/" class="inline-block underline">Go Back</a>
        </div>
    </section>
</body>

</html>