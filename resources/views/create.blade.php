@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20 px-6 md:px-0">
    <p class="text-blue-darkest text-sm md:text-base text-center mt-8 mb-3">
        Paste the URL to a Gist here to create a GistLog
    </p>

    <form method="POST" action="{{ route('post.create') }}" class="flex flex-1 shadow mb-8">
        {{ csrf_field() }}

        <label for="gistUrl" class="hidden"></label>
        <input
            type="text"
            id="gistUrl"
            name="gistUrl"
            class="bg-white w-4/5 py-3 rounded-tl rounded-bl text-grey text-sm px-4 focus:outline-none" placeholder="https://gist.github.com/username/gist-id"
        >

        <button
            class="bg-blue-darkest flex-1 py-3 text-white rounded-tr rounded-br text-sm sm:text-base focus:outline-none"
        >Create</button>
    </form>

    <div class="bg-grey-lighter rounded p-4">
        <p class="text-blue-darkest pt-1">Just want to test drive?</p>

        <p class="text-sm my-4 w-5/6 text-grey-darkest text-center w-full leading-normal">
            Try this gist (just copy the URL, paste it above) to see how GistLog works and also to learn a little bit more about what GistLog is:
        </p>

        <label for="example-snippet" class="hidden"></label>
        <input
            type="text"
            name="gist-example"
            id="example-snippet"
            class="bg-white w-full py-3 text-grey text-sm px-4 rounded border border-grey-light focus:border-grey focus:outline-none"
            value="https://gist.github.com/mattstauffer/1c76d40371b295184845"
        >
        <div class="flex justify-between my-1">
            <small
                class="inline-block text-left text-blue-darker font-bold cursor-pointer"
                onclick="copyToClipboard()"
            >Copy</small>

            <small
                id="copy-successful"
                class="inline-block invisible text-grey-darker text-right"
            >Copied to clipboard</small>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyToClipboard(element) {
        let snippet = document.getElementById('example-snippet');
        let successMessage = document.getElementById('copy-successful');

        snippet.select();
        document.execCommand('copy');

        if (successMessage.classList.contains('invisible')) {
            document.getElementById('copy-successful').classList.toggle('invisible');
        }
    }
</script>
@endpush
