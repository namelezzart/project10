@props(['post' => ''])

<x-form {{ $attributes }}>
    <x-form_item>
        <x-label required>{{ __('Post name') }}</x-label>
        <x-input name="title" value="{{ $post->title ?? '' }}" autofocus />
        <x-error name="title" />
    </x-form_item>

    <x-form_item>
        <x-label required>{{ __('Post content') }}</x-label>
        <x-trix name="content" value="{{ $post->content ?? '' }}" />
        <x-error name="content" />
    </x-form_item>

    <x-form_item>
        <x-label required>{{ __('Published at') }}</x-label>
        <x-input name="published_at" placeholder="dd.mm.yyyy"/>
        <x-error name="published_at" />
    </x-form_item>

    <x-form_item>
        <x-checkbox name="published">
            Published
        </x-checkbox>
    </x-form_item>

    {{ $slot }}
</x-form>