<x-layouts.guest.simple :description="$description ?? ''" :keywords="$keywords ?? ''" :title="$title ?? ''">
    {{ $slot }}
</x-layouts.guest.simple>
