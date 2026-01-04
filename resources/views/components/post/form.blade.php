@props(['post' => ''])

<x-form {{ $attributes }}>
    <x-form_item>
        <x-label required>{{ 'Post name' }}</x-label>
        <x-input name="title" value="{{ $post->title ?? '' }}" autofocus />
        <x-error name="title" />
    </x-form_item>

    <x-form_item>
        <x-label required>{{ 'Post content ' }}</x-label>
        <x-trix name="content" value="{{ $post->content ?? '' }}"/>
        <x-error name="content" />
    </x-form_item>

    {{ $slot }}
</x-form>