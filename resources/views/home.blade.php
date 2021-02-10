@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <main class="relative flex-1 overflow-y-auto focus:outline-none" tabindex="-1" x-data="" x-init="$el.focus()">
        <div class="py-8 xl:py-10">
            <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8 xl:max-w-5xl xl:grid xl:grid-cols-3">
                <div class="xl:col-span-2 xl:pr-8 xl:border-r xl:border-gray-200">
                    <div>
                        <div>
                            <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Lorem ipsum dolor sit</h1>
                                    <p class="mt-2 text-sm text-gray-500">
                                        posted by
                                        <a href="#" class="font-medium text-gray-900">John Doe</a>
                                    </p>
                                </div>
                            </div>
                            <aside class="mt-8 xl:hidden">
                                <h2 class="sr-only">Details</h2>
                                <div class="space-y-5">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400" x-description="Heroicon name: solid/chat-alt" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">4 comments</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-400" x-description="Heroicon name: solid/calendar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900">Created on <time datetime="2020-12-02">Dec 2, 2020</time></span>
                                    </div>
                                </div>
                            </aside>
                            <div class="py-3 xl:pt-6 xl:pb-0">
                                <h2 class="sr-only">Description</h2>
                                <div class="prose max-w-none">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, hic? Commodi cumque similique id tempora molestiae deserunt at suscipit, dolor voluptatem, numquam, harum consequatur laboriosam voluptas tempore aut voluptatum alias?
                                    </p>
                                    <ul>
                                        <li>
                                            Tempor ultrices proin nunc fames nunc ut auctor vitae sed. Eget massa parturient vulputate fermentum id facilisis nam pharetra. Aliquet leo tellus.
                                        </li>
                                        <li>
                                            Turpis ac nunc adipiscing adipiscing metus tincidunt senectus tellus.
                                        </li>
                                        <li>
                                            Semper interdum porta sit tincidunt. Dui suspendisse scelerisque amet metus eget sed. Ut tellus in sed dignissim.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section aria-labelledby="activity-title" class="mt-8 xl:mt-10">
                        <div id="app">
                            <div class="divide-y divide-gray-200">
                                <div class="pb-4">
                                    <h2 id="activity-title" class="text-lg font-medium text-gray-900">Comments</h2>
                                </div>
                                <div class="pt-6">
                                    <comment-feed />
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <aside class="hidden xl:block xl:pl-8">
                    <h2 class="sr-only">Details</h2>
                    <div class="space-y-5">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" x-description="Heroicon name: solid/calendar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Created on <time datetime="2020-12-02">Dec 2, 2020</time></span>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
</div>
@endsection