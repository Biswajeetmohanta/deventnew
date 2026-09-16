@extends('admin.layouts.admin')

@section('title', 'Edit Blog Post')
@section('page_title', 'Edit: ' . $post->title)

@section('content')
<div class="glass p-8 rounded-3xl max-w-5xl mx-auto">
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $post->title) }}">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label>Current Image</label>
                @if($post->image)
                    <div class="relative group w-48 h-28 mb-4">
                        <img id="currentImageDisplay" src="{{ asset('storage/' . $post->image) }}" class="w-full h-full rounded-xl object-cover border border-slate-200 shadow-sm" alt="Current Image">
                    </div>
                @else
                    <div id="noImageDisplay" class="w-48 h-28 mb-4 bg-slate-50 border border-slate-200 border-dashed rounded-xl flex items-center justify-center text-slate-400 italic text-xs">
                        No image uploaded
                    </div>
                @endif
                
                <label for="image" class="text-xs text-slate-500 font-semibold mb-2">Change Image <span class="text-slate-400 font-normal">(Max: 50MB)</span></label>
                <input type="file" name="image" id="image" accept="image/*" class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-sm w-full cursor-pointer hover:border-amber-400 transition-colors">
                
                <!-- Instant Error Alert Message -->
                <div id="imageErrorAlert" class="hidden mt-3 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm flex items-start space-x-2 shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-semibold" id="imageErrorTitle">Image too large!</p>
                        <p class="text-xs mt-0.5" id="imageErrorMessage">The selected image exceeds the maximum allowed size of 50 MB.</p>
                    </div>
                </div>

                <!-- New Selected Image Preview -->
                <div id="imagePreviewContainer" class="hidden mt-3 p-3 bg-slate-50 border border-slate-200 rounded-2xl">
                    <p class="text-xs font-semibold text-slate-600 mb-2">New Image Selected:</p>
                    <div class="relative w-full h-36 rounded-xl overflow-hidden border border-slate-200 bg-white shadow-inner mb-2">
                        <img id="imagePreview" src="" alt="New Preview" class="w-full h-full object-cover">
                        <button type="button" id="removeImageBtn" class="absolute top-2 right-2 bg-rose-500 hover:bg-rose-600 text-white w-7 h-7 rounded-full flex items-center justify-center shadow-lg transition-all active:scale-95" title="Remove Selection">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    </div>
                    <div class="text-xs text-slate-500 font-medium flex items-center justify-between px-1">
                        <span id="fileName" class="truncate max-w-[200px]"></span>
                        <span id="fileSize" class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded-md font-semibold"></span>
                    </div>
                </div>
            </div>

            <div>
                <label for="status">Publication Status</label>
                <select name="status" id="status" required>
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <p class="mt-3 text-xs text-slate-500 bg-slate-50 p-3 rounded-lg border border-slate-100">
                    <i class="fa-solid fa-circle-info mr-1 text-amber-500"></i> Published posts will appear immediately on the website.
                </p>

                <!-- Social Auto-Post Toggle -->
                <div class="mt-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 rounded-2xl">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="auto_social_share" value="1" {{ $post->status === 'draft' ? 'checked' : '' }} class="rounded border-purple-300 text-purple-600 shadow-sm focus:ring-purple-500 mt-1">
                        <div>
                            <span class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-share-nodes text-purple-600"></i>
                                Re-sync to Social Media (LinkedIn & Instagram)
                            </span>
                            <p class="text-[11px] text-slate-500 mt-0.5">Send updated post details to Make.com Webhook on save</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="15" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const errorAlert = document.getElementById('imageErrorAlert');
        const errorMessage = document.getElementById('imageErrorMessage');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');

        const MAX_SIZE_MB = 50;
        const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024; // 52,428,800 bytes

        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }

        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) {
                previewContainer.classList.add('hidden');
                return;
            }

            // Real-time Size Check (Immediate error if > 50MB)
            if (file.size > MAX_SIZE_BYTES) {
                const actualSize = formatBytes(file.size);
                errorMessage.textContent = `Selected file is ${actualSize}. Maximum allowed size is ${MAX_SIZE_MB} MB. Please choose a smaller image.`;
                errorAlert.classList.remove('hidden');
                
                // Clear the input
                imageInput.value = '';
                
                // Reset preview
                previewContainer.classList.add('hidden');
                return;
            }

            // Check if valid image type
            if (!file.type.startsWith('image/')) {
                errorMessage.textContent = 'Please select a valid image file (JPG, PNG, GIF, WEBP).';
                errorAlert.classList.remove('hidden');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                return;
            }

            // If valid: Clear error and show preview
            errorAlert.classList.add('hidden');
            fileName.textContent = file.name;
            fileSize.textContent = formatBytes(file.size);

            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        removeImageBtn.addEventListener('click', function () {
            imageInput.value = '';
            previewContainer.classList.add('hidden');
            errorAlert.classList.add('hidden');
        });
    });
</script>
@endsection
