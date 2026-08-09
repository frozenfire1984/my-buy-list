@extends("layouts.main")

@section("title", "Edit Category")

@section("content")
    <form method="POST" action="/categories/{{ $category->id }}">
        @method('PUT')
        <div class="app-fieldset">
            <div class="app-fieldset__title">Edit Category</div>
            @csrf
            
            <x-form.input
                label="Name"
                name="name"
                :value="old('name', $category->name ?? '')">
            </x-form.input>
            
            <x-form.textarea
                    label="Description"
                    name="description"
                    class="app-textarea_tale"
                    :value="old('description', $category->description ?? '')">
            </x-form.textarea>
            
            @if (auth()->user()->is_super_admin)
                <label>
                    <input type="checkbox" name="is_secret" value="1" {{ old('is_secret', $category->is_secret) ? 'checked' : '' }}> Secret
                </label>
            @endif
            <hr>
            <button class="app-btn" type="submit">Update</button>
        </div>
    </form>
    
    @include('partials.errors')
@endsection
