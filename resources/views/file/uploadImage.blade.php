<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        <script src="/tailwind.js"></script>
    </head>
    <body class="font-sans antialiased ">
        {{ csrf_field() }}
      
        <div class="flex items-center justify-center ">
            <div class=" text-center mx-10">
                <form class="my-10" action="{{ route('uploadImage') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" id="image">
                    <button type="submit">Upload</button>
                </form>
                @foreach ($files as $file)
                <div>
                    <h3 class="text-black">{{ $file->image }}</h3>
                    <img src="{{ $file->image  }}" alt="">
                </div>
                @endforeach
                
            </div>
        </div>
        
    </body>
</html>
