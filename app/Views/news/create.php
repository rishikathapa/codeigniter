<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;600;700;800&display=swap" rel="stylesheet">
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' rel='stylesheet'/>
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-gray-50 py-8 px-4" style="font-family: 'Mukta', sans-serif;">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 border-b-2 border-red-700 pb-4">
            <h2 class="text-3xl font-black text-gray-800 uppercase tracking-tighter">
                <i class="fa-solid fa-file-pen text-red-700 mr-2"></i> समाचार व्यवस्थापन
            </h2>
            <div class="flex gap-2">
                <a href="<?= base_url('admin/dashboard') ?>" class="bg-gray-800 text-white px-4 py-2 rounded-lg font-bold hover:bg-black transition">
                    <i class="fa-solid fa-gauge mr-1"></i> ड्यासबोर्ड
                </a>
                <a href="<?= base_url('news') ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold hover:bg-gray-300 transition">
                    <i class="fa-solid fa-list mr-1"></i> सबै समाचार
                </a>
            </div>
        </div>

        <form action="<?= base_url('news/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="flex flex-col lg:flex-row gap-8">
                
                <div class="flex-1 space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-100">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1 italic">समाचारको शीर्षक</label>
                        <input type="text" name="title" id="title" 
                               class="w-full border-2 border-gray-100 p-4 rounded-xl focus:border-red-500 outline-none text-2xl font-bold text-gray-800 transition" 
                               placeholder="यहाँ हेडलाइन लेख्नुहोस्..." required>
                        </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 italic">मुख्य समाचार (Body Content)</label>
                        <textarea id="news_editor" name="body"></textarea>
                    </div>
                </div>

                <div class="w-full lg:w-80 space-y-6">
                    
                    <div class="bg-white p-5 rounded-xl shadow-md border-t-4 border-red-700">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fa-solid fa-paper-plane mr-2 text-red-700"></i> पब्लिस अप्सन
                        </h3>
                        <div class="space-y-3">
                            <button type="submit" name="status" value="publish" class="w-full bg-red-700 hover:bg-red-800 text-white font-black py-3 rounded-xl shadow-lg transition transform active:scale-95">
                                पब्लिस (Publish)
                            </button>
                            <button type="submit" name="status" value="draft" class="w-full bg-gray-800 hover:bg-black text-white font-bold py-2 rounded-xl transition">
                                ड्राफ्ट (Draft)
                            </button>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-3 border-b pb-2 italic">मुख्य फोटो (Feature Image)</h3>
                        <div class="relative group border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-red-500 transition cursor-pointer bg-gray-50" 
                             onclick="document.getElementById('imageInput').click()">
                            <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(event)">
                            <div id="upload_ui">
                                <i class="fa-solid fa-image text-4xl text-gray-300 group-hover:text-red-300 transition"></i>
                                <p class="text-[11px] text-gray-400 mt-2">फोटो अपलोड गर्न क्लिक गर्नुहोस्</p>
                            </div>
                            <img id="img_preview" class="hidden w-full h-auto rounded-lg shadow-inner border border-gray-200">
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-3 border-b pb-2 italic">समाचार विधा (Category)</h3>
                        <select name="category" class="w-full border p-3 rounded-xl bg-gray-50 outline-none focus:ring-2 focus:ring-red-500 text-sm font-semibold">
                            <option value="politics">राजनीति</option>
                            <option value="economy">अर्थतन्त्र</option>
                            <option value="society">समाज</option>
                            <option value="province">प्रदेश</option>
                            <option value="sports">खेलकुद</option>
                            <option value="entertainment">मनोरञ्जन</option>
                            <option value="opinion">विचार / ब्लग</option>
                        </select>
                    </div>

                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-3 border-b pb-2 italic">लेखक र मिति</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">लेखकको नाम</label>
                                <input type="text" name="author" class="w-full py-2 border-b-2 border-gray-100 outline-none text-sm font-bold text-gray-700 focus:border-red-500" value="मुकेश बस्नेत">
                            </div>
                            <div>
                                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">प्रकाशन मिति</label>
                                <input type="date" name="post_date" class="w-full py-2 border-b-2 border-gray-100 outline-none text-sm font-bold text-gray-700 focus:border-red-500" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" name="slug" value="auto-id-<?= time() ?>">
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<script>
    // CKEditor 5 Initialization
    ClassicEditor
        .create(document.querySelector('#news_editor'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ],
            language: 'ne'
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error(error);
        });

    // Feature Image Preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('img_preview');
            const ui = document.getElementById('upload_ui');
            output.src = reader.result;
            output.classList.remove('hidden');
            ui.classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    /* CKEditor Custom Styles */
    .ck-editor__editable {
        min-height: 400px !important;
        border-radius: 0 0 12px 12px !important;
        font-family: 'Mukta', sans-serif !important;
        font-size: 18px !important;
    }
    .ck-toolbar {
        border-radius: 12px 12px 0 0 !important;
        background: #f9fafb !important;
        border: 1px solid #f3f4f6 !important;
    }
</style>
