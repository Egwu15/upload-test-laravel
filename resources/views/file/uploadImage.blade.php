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
    @if (session('error'))
        <div class="bg-red-500 text-white w-[50%] flex">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="flex justify-center w-full text-center">
            <div class="py-5 m-4 text-white bg-green-600 rounded-lg px-9">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class=" md:mx-32">
        <div class="text-center ">
            <h2 class="text-2xl font-extrabold text-pink-700 mt-7">Upload Images</h2>
            <form class="my-10" action="{{ route('uploadImage') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" id="image"
                    class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100" />
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full type="submit"">
                    <div class="flex">
                        <img src="/icons/upload.svg" class="mr-2" />
                        Upload
                    </div>
                </button>
            </form>

            <div class="gap-3 md:grid md:grid-cols-3 ">
                @foreach ($files as $file)
                    <div class=" py-5  border-gray-600 shadow-md w-[80%] md:w-[90%] mx-auto">

                        {{-- <img class="h-[200px] w-full" src="{{ $file->image }}" alt="sample"> --}}
                        <a href="{{ $file->image }}">{{ $file->created_at }}</a>
                        <div>

                            <form action="{{ route('deleteImage', $file->id) }}" method="DELETE">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 my-2 text-white bg-red-500 rounded-md shadow-lg">delete</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

</body>

</html>
