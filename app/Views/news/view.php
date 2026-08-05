<script src='https://educationnepal.eu.org/counter-postview.js'></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6971f5f4d5e63d288d7299f6&product=sop' async='async'></script>

<div class="bg-gray-100 min-h-screen py-6 px-4" style="font-family: 'Mukta', sans-serif;">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="lg:w-2/3 bg-white p-5 md:p-10 rounded-xl shadow-sm border border-gray-200">
                
                <div class="mb-4">
                    <span class="text-red-700 font-bold text-lg border-b-2 border-red-700 pb-1 italic uppercase">
                        <?= esc($news['category']) ?>
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-black text-gray-900 leading-tight mb-6">
                    <?= esc($news['title']) ?>
                </h1>

                <div class="flex flex-wrap items-center justify-between gap-y-4 border-y border-gray-100 py-4 mb-8">
                    
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-red-700 text-white rounded-full flex items-center justify-center text-sm shadow-md">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 leading-none"><?= esc($news['author']) ?></p>
                                <p class="text-[10px] uppercase text-gray-400 mt-1">सम्वाददाता</p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-500 flex items-center border-l border-gray-200 pl-4 h-8">
                            <i class="fa-regular fa-calendar-days mr-2 text-red-600"></i> 
                            <?= date('M d, Y', strtotime($news['created_at'])) ?>
                        </div>

                        <div class="text-sm text-gray-500 flex items-center border-l border-gray-200 pl-4 h-8">
                            <div id="visitor-count"></div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="sharethis-inline-share-buttons"></div>
                    </div>
                </div>

                <?php if (!empty($news['image'])): ?>
                    <div class="mb-8 group">
                        <img src="<?= base_url('uploads/' . $news['image']) ?>" 
                             alt="<?= esc($news['title']) ?>" 
                             class="w-full h-auto rounded-2xl shadow-lg border border-gray-100">
                    </div>
                <?php endif; ?>

                <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-xl news-body">
                    <?= $news['body'] ?>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 flex gap-4 items-center">
                    <span class="font-bold text-gray-500 italic">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>" target="_blank" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </div>
            </div>

            <div class="lg:w-1/3 space-y-8">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-red-700 px-4 py-3 border-b-4 border-yellow-400">
                        <h3 class="text-white font-bold text-lg flex items-center uppercase tracking-tighter">
                            <i class="fa-solid fa-bolt mr-2 text-yellow-300"></i> ताजा समाचार
                        </h3>
                    </div>
                    <div class="p-2">
                        <?php if (!empty($latest_news)): ?>
                            <?php foreach ($latest_news as $item): ?>
                                <a href="<?= base_url('news/' . $item['slug']) ?>" class="group flex gap-3 p-3 border-b border-gray-50 last:border-0 hover:bg-red-50 transition rounded-lg">
                                    <div class="w-24 h-16 flex-shrink-0 overflow-hidden rounded-md bg-gray-100 shadow-inner">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/' . $item['image']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-md font-bold text-gray-800 leading-tight group-hover:text-red-700 transition line-clamp-2">
                                            <?= esc($item['title']) ?>
                                        </h4>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="space-y-4 sticky top-4">
                    <div class="bg-white p-3 rounded-xl border border-gray-200 shadow-sm text-center">
                        <span class="text-[10px] text-gray-400 uppercase font-bold tracking-widest block mb-2">- ADVERTISEMENT -</span>
                        <div class="bg-gray-50 border-2 border-dashed border-gray-200 h-[250px] flex items-center justify-center rounded-lg overflow-hidden">
                            <p class="text-gray-300 italic text-sm">आफ्नो विज्ञापन यहाँ राख्नुहोस्</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .news-body p { margin-bottom: 1.8rem; line-height: 1.9; }
    .news-body img { border-radius: 12px; margin: 2rem 0; width: 100%; height: auto; }
    
    /* ShareThis र Visitor Count मिलाउन सानो CSS */
    #visitor-count i { color: #2563eb; margin-right: 5px; } /* भ्यु आइकन नीलो बनाउन */
    .sharethis-inline-share-buttons { zoom: 0.9; }
</style>
