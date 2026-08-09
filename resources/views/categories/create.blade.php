@extends("layouts.main")

@section("title", "Create Category")

@section("content")
    <form method="POST" action="/categories">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Category</div>
            @csrf

            <x-form.input
                label="Name"
                name="name"
                wrapper-class="form-item_hh"
                :value="old('name')">
            </x-form.input>
            
            <x-form.textarea
                    label="Description"
                    name="description"
                    class="app-textarea_tale"
                    :value="old('description')">
            </x-form.textarea>
            
            @if (auth()->user()->is_super_admin)
                <label>
                    <input type="checkbox" name="is_secret" value="1"> Secret
                </label>
            @endif
            <hr>
            <button class="app-btn" type="submit">Create</button>
        </div>
    </form>
    @include('partials.errors')
@endsection
