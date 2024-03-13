{{-- <x-filament-panels::page>
        {{ $this->form }}
</x-filament-panels::page> --}}

<x-filament::page>
    <form wire:submit.prevent='submit' >
        {{ $this->form }}
        @if (isset($this->user))
            @if ($this->users->is_declined == true)
            <button wire:loading.class.delay="opacity-70 cursor-wait" wire:loading.attr="disabled" style="margin-top: 20px"
                class="filament-button mt-3 filament-button-size-sm inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
                type="submit">Re-Submit</button>
            @else
            <button wire:loading.class.delay="opacity-70 cursor-wait" wire:loading.attr="disabled" style="margin-top: 20px"
                class="filament-button mt-3 filament-button-size-sm inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
                type="submit">Submit</button>
            @endif
        @else
        <button wire:loading.class.delay="opacity-70 cursor-wait" wire:loading.attr="disabled" style="margin-top: 20px"
            class="filament-button mt-3 filament-button-size-sm inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2rem] px-3 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700"
            type="submit">Submit</button>

        @endif

    </form>
</x-filament::page>

