@extends('admin.layouts.admin')

@section('title', 'Create New Post')
@section('page_title', 'New Blog Post')

@section('content')
<div class="glass p-8 rounded-3xl max-w-5xl mx-auto">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div>
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="Enter an engaging title...">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="image">Featured Image <span class="text-xs text-slate-400 font-normal">(Max: 50MB)</span></label>
                <div class="mt-1 relative flex flex-col items-center justify-center p-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50 hover:bg-slate-100/50 transition-colors">
                    <div id="uploadPlaceholder" class="space-y-2 text-center">
                        <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-3xl"></i>
                        <div class="flex text-sm text-slate-600 justify-center">
                            <input type="file" name="image" id="image" accept="image/*" class="sr-only">
                            <label for="image" class="relative cursor-pointer bg-white px-4 py-2 rounded-xl border border-slate-200 font-semibold text-amber-600 hover:text-amber-500 shadow-sm transition-all hover:border-amber-400">
                                <span>Browse Image</span>
                            </label>
                        </div>
                        <p class="text-xs text-slate-400">JPG, PNG, WEBP, GIF (Max size: 50 MB)</p>
                    </div>

                    <!-- Image Preview Box -->
                    <div id="imagePreviewContainer" class="hidden w-full flex-col items-center space-y-3">
                        <div class="relative w-full h-48 rounded-xl overflow-hidden border border-slate-200 bg-white shadow-inner">
                            <img id="imagePreview" src="" alt="Preview" class="w-full h-full object-cover">
                            <button type="button" id="removeImageBtn" class="absolute top-2 right-2 bg-rose-500 hover:bg-rose-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg transition-all active:scale-95" title="Remove Image">
                                <i class="fa-solid fa-xmark text-sm"></i>
                            </button>
                        </div>
                        <div class="text-xs text-slate-500 font-medium flex items-center justify-between w-full px-2">
                            <span id="fileName" class="truncate max-w-[200px]"></span>
                            <span id="fileSize" class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded-md font-semibold"></span>
                        </div>
                    </div>
                </div>

                <!-- Instant Error Alert Message -->
                <div id="imageErrorAlert" class="hidden mt-3 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl text-sm flex items-start space-x-2 animate-shake shadow-sm">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-semibold" id="imageErrorTitle">Image too large!</p>
                        <p class="text-xs mt-0.5" id="imageErrorMessage">The selected image exceeds the maximum allowed size of 50 MB.</p>
                    </div>
                </div>
            </div>

            <div>
                <label for="status">Publication Status</label>
                <select name="status" id="status" required>
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
                <p class="mt-3 text-xs text-slate-500 bg-slate-50 p-3 rounded-lg border border-slate-100">
                    <i class="fa-solid fa-circle-info mr-1 text-amber-500"></i> Published posts will appear immediately on the website.
                </p>

                <!-- Social Auto-Post Toggle -->
                <div class="mt-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 rounded-2xl">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="auto_social_share" value="1" checked class="rounded border-purple-300 text-purple-600 shadow-sm focus:ring-purple-500 mt-1">
                        <div>
                            <span class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-share-nodes text-purple-600"></i>
                                Auto-post to Social Media (LinkedIn & Instagram)
                            </span>
                            <p class="text-[11px] text-slate-500 mt-0.5">Automatically trigger Make.com webhook upon publishing</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div>
            <label for="content">Post Content</label>
            <textarea name="content" id="content" rows="15" required placeholder="Write your post content here (HTML supported)...">{{ old('content') }}</textarea>
            <p class="text-xs text-slate-400 mt-2 italic flex items-center">
                <i class="fa-solid fa-code mr-1"></i> Tip: You can use HTML tags for rich content formatting.
            </p>
        </div>

        <div class="flex justify-end space-x-4 pt-8 border-t border-slate-100">
            <a href="{{ route('admin.posts.index') }}" class="px-6 py-3 text-slate-600 font-semibold hover:bg-slate-100 rounded-xl transition-all">Cancel</a>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                Save Post
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
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
                uploadPlaceholder.classList.remove('hidden');
                return;
            }

            // Check if valid image type
            if (!file.type.startsWith('image/')) {
                errorMessage.textContent = 'Please select a valid image file (JPG, PNG, GIF, WEBP).';
                errorAlert.classList.remove('hidden');
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                uploadPlaceholder.classList.remove('hidden');
                return;
            }

            // If valid: Clear any error and show preview
            errorAlert.classList.add('hidden');
            fileName.textContent = file.name;
            fileSize.textContent = formatBytes(file.size);

            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                uploadPlaceholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        removeImageBtn.addEventListener('click', function () {
            imageInput.value = '';
            previewContainer.classList.add('hidden');
            uploadPlaceholder.classList.remove('hidden');
            errorAlert.classList.add('hidden');
        });
    });
</script>
@endsection
