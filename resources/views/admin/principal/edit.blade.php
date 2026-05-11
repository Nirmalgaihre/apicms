@extends('layouts.admin')

@section('title', 'Principal Message')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-xl font-bold text-[#1d0647] uppercase tracking-tight">Edit Principal Message</h2>
        @if(session('success'))
            <span class="text-xs font-bold text-green-600 bg-green-50 px-4 py-2 rounded-lg shadow-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('success') }}
            </span>
        @endif
    </div>

    <form action="{{ route('principal.update') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        @csrf
        <div class="p-8">
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-3 tracking-widest">Message Content</label>
            
            <textarea id="editor" name="description">
                {{ $data->description ?? '' }}
            </textarea>
        </div>

        <div class="bg-slate-50 px-8 py-4 flex justify-end">
            <button type="submit" class="bg-[#fbbf24] hover:bg-yellow-500 text-[#1d0647] px-10 py-3 rounded-xl font-black uppercase text-xs tracking-widest transition shadow-md">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
        })
        .catch(error => { console.error(error); });
</script>

<style>
    .ck-editor__editable { min-height: 400px; }
    .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) { border-color: #e2e8f0; }
</style>
@endsection