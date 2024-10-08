@if (session()->has('message'))
    {{ session('message') }}
@endif

@if ($message = flash()->get())
    <div class="{{ $message->class() }} p-5">
        {{ $message->message() }}
    </div>
@endif