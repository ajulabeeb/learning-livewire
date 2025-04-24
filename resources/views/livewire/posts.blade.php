
<section class="container w-full">
    <div>

        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}" class="my-6 w-full space-y-6">
            <flux:input wire:model="title" :label="__('Title')" type="text" required autofocus autocomplete="title" />

            <div>
                <flux:textarea wire:model="content" :label="__('Content')" type="textarea" />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">
                        {{-- {{ __('Save') }} --}}
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="">
                    {{ $isEditing ? 'Updated' : 'New post was created successfully' }}
                    {{-- {{ __('Saved.') }} --}}
                </x-action-message>
            </div>
        </form>

    </div>

    <div class="grid grid-cols-1 gap-1">
        @foreach($posts as $post)
            <h2 class="text-lg font-bold">{{ $post->title }}</h2>
            <p class="mt-4 text-base text-jus">{{ $post->content }}</p>

            <div class="mt-4 flex gap-4">
                <flux:button wire:click="edit({{ $post->id }})" variant="primary" class="w-half">
                    {{ __('Edit') }}
                </flux:button>

                <flux:button wire:click="delete({{ $post->id }})" variant="danger" class="w-half hover:bg-red-700">
                    {{ __('Delete') }}
                </flux:button>
            </div>
        @endforeach
    </div>
</section>
