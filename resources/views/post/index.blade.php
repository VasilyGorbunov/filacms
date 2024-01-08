<x-app-layout>

    @section('title', $post->title)
    @section('meta_description', $post->meta_description)

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-2xl format format-blue">
                <div class="mb-5">
                    <img src="{{ $post->getFirstMediaUrl() }}" class="w-full"/>
                </div>
                <div>
                    @foreach($post->categories as $category)
                        <a href="#"
                            wire:navigate
                        >
                            <span
                                style="background-color: {{ $category->bg_color ?? '' }}; color: {{ $category->text_color ?? '' }}"
                                class="text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                            >
                            {{ $category->title }}
                        </span>
                        </a>
                    @endforeach
                </div>
                <header class="mb-4 lg:mb-6 non-format">
                    <address class="flex items-center mb-6 non-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900">
                            <img class="mr-4 w-16 h-16 rounded-full" src="{{ $post->user->profile_photo_url }}"/>
                            <div>
                                <a href="#" rel="author" class="text-xl font-bold text-gray-900">{{ $post->user->name }}</a>
                                <p class="text-base text-gray-500">
                                    <time datetime="{{ $post->created_at }}" title="{{\Carbon\Carbon::parse($post->created_at)->format('F jS, Y')}}">
                                        {{ \Carbon\Carbon::parse($post->created_at)->format('F jS, Y') }}
                                    </time>
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900">{{ $post->title }}</h1>
                </header>
                {!! tiptap_converter()->asHTML($post->content) !!}
            </article>
        </div>
    </main>
</x-app-layout>
