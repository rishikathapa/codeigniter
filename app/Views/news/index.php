<?php if (! empty($news) && is_array($news)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 py-6" style="font-family: 'Mukta', sans-serif;">
        <?php foreach ($news as $news_item): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 flex flex-col group">
                
                <div class="h-52 w-full overflow-hidden bg-gray-200 relative">
                    <?php if (!empty($news_item['image'])): ?>
                        <img src="<?= base_url('uploads/' . $news_item['image']) ?>" 
                             alt="<?= esc($news_item['title']) ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <?php else: ?>
                        <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                            <i class="fa-solid fa-image text-5xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-red-700 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase shadow-lg">
                            <?= esc($news_item['category'] ?? 'समाचार') ?>
                        </span>
                    </div>
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-gray-400 text-[11px] font-bold">
                            <i class="fa-regular fa-calendar-check mr-1 text-red-600"></i>
                            <?= date('M d, Y', strtotime($news_item['created_at'])) ?>
                        </span>
                        <span class="text-gray-400 text-[11px] font-bold">
                            <i class="fa-solid fa-eye mr-1 text-blue-500"></i>
                            <?= number_format($news_item['views'] ?? 0) ?>
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 leading-tight mb-3 group-hover:text-red-700 transition">
                        <a href="<?= base_url('news/' . $news_item['id']) ?>">
                            <?= esc($news_item['title']) ?>
                        </a>
                    </h3>

                    <div class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                        <?= word_limiter(strip_tags($news_item['body']), 25) ?>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-500 italic">
                            <i class="fa-solid fa-user-pen mr-1 text-red-700"></i> <?= esc($news_item['author'] ?? 'Admin') ?>
                        </span>
                        
                        <a href="<?= base_url('news/' . $news_item['id']) ?>" class="text-red-700 font-black text-sm hover:text-black transition flex items-center gap-1">
                            थप पढ्नुहोस् <i class="fa-solid fa-circle-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php else: ?>
    <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-dashed border-gray-300">
        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-face-frown text-5xl text-gray-200"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-400">कुनै समाचार भेटिएन</h3>
        <p class="text-gray-400 font-semibold">कृपया केही समयपछि पुन: प्रयास गर्नुहोस्।</p>
    </div>
<?php endif ?>
