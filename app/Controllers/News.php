<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    /**
     * १. एडमिन ड्यासबोर्ड (Admin Dashboard)
     * सबै समाचारको सूची र भ्यु काउन्ट यहाँ देखिन्छ।
     */
    public function admin()
    {
        // Admin Authentication
        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'Muskan@2084') {
            header('WWW-Authenticate: Basic realm="News Admin"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'पहुँच अस्विकृत!';
            exit;
        }

        $model = model(NewsModel::class);
        helper(['url', 'text']);

        $data = [
            'news'  => $model->orderBy('id', 'DESC')->findAll(),
            'title' => 'प्रशासकीय ड्यासबोर्ड - नेपाल न्यूज एक्सप्रेस',
        ];

        return view('templates/header', $data)
            . view('news/admin', $data)
            . view('templates/footer');
    }

    /**
     * २. सबै समाचार देखाउने (Public Index View)
     */
    public function index()
    {
        $model = model(NewsModel::class);
        helper(['form', 'url', 'text']); 

        $data = [
            'news'  => $model->orderBy('id', 'DESC')->findAll(),
            'title' => 'समाचार संग्रह - नेपाल न्यूज एक्सप्रेस',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    /**
     * ३. समाचारको विस्तृत विवरण (Single View)
     * अब यसले URL बाट ID लिन्छ र समाचार खोज्छ।
     */
    public function view($id = null)
    {
        $model = model(NewsModel::class);
        helper(['text', 'url']);

        // ID को आधारमा समाचार तान्ने (पर्मालिङ्क सच्याउन)
        $news = $model->find($id);

        if (!$news) {
            throw new PageNotFoundException('समाचार भेटिएन। आईडी: ' . $id);
        }

        // भ्यु काउन्ट १ ले बढाउने लोजिक
        $model->update($id, [
            'views' => ($news['views'] ?? 0) + 1
        ]);

        $data = [
            'news' => $news,
            'latest_news' => $model->orderBy('id', 'DESC')
                                   ->where('id !=', $id)
                                   ->limit(6)
                                   ->findAll(),
            'title' => $news['title']
        ];

        return view('templates/header', $data)
            . view('news/view', $data)
            . view('templates/footer');
    }

    /**
     * ४. नयाँ समाचार थप्ने फर्म
     */
    public function create()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== 'admin' || $_SERVER['PHP_AUTH_PW'] !== 'Muskan@2084') {
            header('WWW-Authenticate: Basic realm="News Admin"');
            header('HTTP/1.0 401 Unauthorized');
            exit;
        }

        helper(['form', 'url']);

        return view('templates/header', ['title' => 'नयाँ समाचार थप्नुहोस्'])
            . view('news/create')
            . view('templates/footer');
    }

    /**
     * ५. समाचार सुरक्षित गर्ने
     */
    public function store()
    {
        helper(['form', 'url', 'text']);
        $model = model(NewsModel::class);

        $rules = [
            'title'    => 'required|min_length[3]',
            'body'     => 'required',
            'category' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'कृपया विवरणहरू सहीसँग भर्नुहोस्।');
        }

        $img = $this->request->getFile('image');
        $imageName = null;

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move(FCPATH . 'uploads', $imageName);
        }

        $model->insert([
            'title'      => $this->request->getPost('title'),
            'slug'       => $this->request->getPost('slug'), // डाटाबेसमा स्लग राखिए पनि URL मा ID चल्नेछ
            'body'       => $this->request->getPost('body'),
            'category'   => $this->request->getPost('category'),
            'author'     => $this->request->getPost('author') ?: 'Admin',
            'status'     => $this->request->getPost('status'),
            'image'      => $imageName,
            'views'      => 0,
            'created_at' => ($this->request->getPost('post_date') ?: date('Y-m-d')) . ' ' . date('H:i:s'),
        ]);

        return redirect()->to('/admin/dashboard')->with('message', 'समाचार प्रकाशित भयो।');
    }

    /**
     * ६. समाचार सम्पादन गर्ने (Edit View)
     */
    public function edit($id)
    {
        $model = model(NewsModel::class);
        $data['news'] = $model->find($id);

        if (!$data['news']) {
            throw new PageNotFoundException('सम्पादनका लागि समाचार भेटिएन।');
        }

        $data['title'] = "सम्पादन: " . $data['news']['title'];

        return view('templates/header', $data)
            . view('news/edit', $data)
            . view('templates/footer');
    }

    /**
     * ७. अपडेट लोजिक
     */
    public function update($id)
    {
        helper(['form', 'url']);
        $model = model(NewsModel::class);
        $oldNews = $model->find($id);

        $img = $this->request->getFile('image');
        $imageName = $oldNews['image'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imageName = $img->getRandomName();
            $img->move(FCPATH . 'uploads', $imageName);
            if (!empty($oldNews['image']) && file_exists(FCPATH . 'uploads/' . $oldNews['image'])) {
                @unlink(FCPATH . 'uploads/' . $oldNews['image']);
            }
        }

        $model->update($id, [
            'title'    => $this->request->getPost('title'),
            'slug'     => $this->request->getPost('slug'),
            'body'     => $this->request->getPost('body'),
            'category' => $this->request->getPost('category'),
            'author'   => $this->request->getPost('author'),
            'status'   => $this->request->getPost('status'),
            'image'    => $imageName,
        ]);

        return redirect()->to('/admin/dashboard')->with('message', 'समाचार सफलतापूर्वक अपडेट भयो।');
    }

    /**
     * ८. समाचार हटाउने (Delete)
     */
    public function delete($id)
    {
        $model = model(NewsModel::class);
        $news = $model->find($id);
        
        if ($news && !empty($news['image'])) {
            $path = FCPATH . 'uploads/' . $news['image'];
            if (file_exists($path)) { @unlink($path); }
        }

        $model->delete($id);
        return redirect()->to('/admin/dashboard')->with('message', 'समाचार सफलतापूर्वक हटाइयो।');
    }
}
