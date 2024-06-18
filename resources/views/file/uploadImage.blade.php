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
                <div class="m-20">
                    <div>
                        <h3 class="text-black ">{{ $file->id }}</h3> 
                        <form class="my-10" action="{{ route('deleteImage', $file->id) }}" method="DELETE" >
                            @csrf
                            <button type="submit">delete</button>
                        </form>
                    </div>
                    <img class="h-[200px]" src="{{ $file->image  }}" alt="sample">
                </div>
                @endforeach
                
            </div>
        </div>
        
    </body>
</html>
