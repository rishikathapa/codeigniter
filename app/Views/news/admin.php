<div class="bg-gray-50 min-h-screen py-10" style="font-family: 'Mukta', sans-serif;">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-black text-gray-800 tracking-tight">समाचार व्यवस्थापन</h1>
                <p class="text-gray-500 font-semibold mt-1">तपाईँको न्यूज पोर्टलको सम्पूर्ण नियन्त्रण यहाँबाट गर्नुहोस् ।</p>
            </div>
            <a href="<?= base_url('news/create') ?>" class="bg-red-700 hover:bg-black text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg flex items-center gap-2">
                <i class="fa-solid fa-plus text-yellow-400"></i> नयाँ समाचार थप्नुहोस्
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl shadow-inner">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">कुल समाचार</p>
                    <h2 class="text-3xl font-black text-gray-800"><?= count($news) ?></h2>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5 border-l-4 border-l-blue-600">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">कुल भ्युज</p>
                    <h2 class="text-3xl font-black text-gray-800">
                        <?php 
                            $totalViews = array_sum(array_column($news, 'views'));
                            echo number_format($totalViews);
                        ?>
                    </h2>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5 border-l-4 border-l-red-600">
                <div class="w-14 h-14 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">आजको ताजा</p>
                    <h2 class="text-3xl font-black text-gray-800">सक्रिय</h2>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600 uppercase tracking-wider">समाचारको शीर्षक</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600 uppercase tracking-wider">भ्युज</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600 uppercase tracking-wider">क्याटगरी</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600 uppercase tracking-wider">मिति</th>
                            <th class="px-6 py-5 text-sm font-bold text-gray-600 uppercase tracking-wider text-right">व्यवस्थापन</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($news as $item): ?>
                        <tr class="hover:bg-blue-50/30 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-12 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100 shadow-inner">
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="<?= base_url('uploads/' . $item['image']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition">
                                        <?php else: ?>
                                            <div class="flex items-center justify-center h-full text-gray-300"><i class="fa-solid fa-image"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="max-w-md">
                                        <a href="<?= base_url('news/' . $item['id']) ?>" target="_blank" class="text-gray-800 font-bold hover:text-red-700 transition leading-tight block mb-1">
                                            <?= esc($item['title']) ?>
                                        </a>
                                        <span class="text-[11px] text-gray-400 flex items-center gap-1">
                                            <i class="fa-solid fa-user-edit"></i> <?= esc($item['author']) ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-700 rounded-full w-fit font-bold text-sm">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                    <?= number_format($item['views'] ?? 0) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-xs font-bold uppercase">
                                    <?= esc($item['category']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-semibold text-gray-400">
                                <i class="fa-regular fa-calendar-check mr-1"></i>
                                <?= date('Y-m-d', strtotime($item['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="<?= base_url('news/edit/' . $item['id']) ?>" class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition shadow-sm" title="सम्पादन गर्नुहोस्">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <a href="<?= base_url('news/delete/' . $item['id']) ?>" onclick="return confirm('के तपाईँ यो समाचार सधैँका लागि हटाउन चाहनुहुन्छ?')" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition shadow-sm" title="डिलिट गर्नुहोस्">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <p class="text-center text-gray-400 text-xs mt-10 uppercase tracking-widest font-bold">
            &copy; 2026 नेपाल न्यूज एक्सप्रेस - एडमिन प्यानल
        </p>
    </div>
</div>
