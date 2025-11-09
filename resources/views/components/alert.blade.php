<!-- It is never too late to be what you might have been. - George Eliot -->
<div class="position-fixed toast-container bottom-0 end-0 p-1" style="z-index: 1000">
    @if (session('status'))
        <div aria-atomic="true" aria-live="polite" class="toast fade show" data-bs-autohide="false" data-bs-delay="15000"
            role="alert">
            <div aria-atomic="true" aria-live="polite" role="status">
                <x-alert.header title="Status">
                    <small class="text-800">{{ now()->format('H:i A') }}</small>
                </x-alert.header>

                <x-alert.body>{{ session('status') }}</x-alert.body>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div aria-atomic="true" aria-live="assertive" class="toast fade show" data-bs-autohide="false"
            data-bs-delay="15000" role="alert">
            <x-alert.header title="Whoops! Something went wrong." class="text-danger" />

            <x-alert.body>{{ session('error') }}</x-alert.body>
        </div>
    @endif

    @if ($errors->any())
        <div aria-atomic="true" aria-live="assertive" class="toast fade show" data-bs-autohide="true" data-bs-delay="15"
            role="alert">
            <x-alert.header title="Whoops! Something went wrong." class="text-danger" />

            <x-alert.body class="bg-light text-dark">
                <ul class="m-0 ps-2 list-inside list-disc text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert.body>
        </div>
    @endif
</div>
