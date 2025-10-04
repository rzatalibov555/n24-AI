<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewsController extends CRUD_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/NewsModel");
        $this->load->model("admin/CategoriesModel");
        $this->load->library('openai'); // SEO generasiyası üçün lazım olacaq

    }

    public function index()
    {
        $context = [
            "page_title" => $this->lang->line("all_news"),
        ];

       
        $this->load->view("admin/news/list", $context);
    }

    public function show($id)
    {
        $context["news"] = $this->NewsModel->with_author_category($id);

        if (!empty($context["news"])) {
            $news_title = $context["news"]["title_{$this->get_admin_language()}"];
            $context["page_title"] = $this->lang->line("view") . " • $news_title";
            $this->load->view("admin/news/detail", $context);
        } else {
            $this->notifier("notifier", "info", [
                "title" => $this->lang->line("notifier_info"),
                "description" => $this->lang->line("notifier_invalid_id")
            ]);

            redirect(base_url("admin/news"));
        }
    }

    public function create()
    {
        $context["page_title"] = $this->lang->line("create_news");
        $context["categories_collection"] = $this->CategoriesModel->all();
        $this->load->view("admin/news/create", $context);
    }

    public function store()
    {
        $title_az = trim($this->input->post("title_az", true));
        $title_en = trim($this->input->post("title_en", true));
        $title_ru = trim($this->input->post("title_ru", true));
        $short_description_az = trim($this->input->post("short_description_az", true));
        $short_description_en = trim($this->input->post("short_description_en", true));
        $short_description_ru = trim($this->input->post("short_description_ru", true));
        $long_description_az = $this->input->post("long_description_az", false);
        $long_description_en = $this->input->post("long_description_en", false);
        $long_description_ru = $this->input->post("long_description_ru", false);
        $video_link = $this->input->post("video_link", true);
        $category_id = $this->input->post("category_id", true);

        $admin_auth_session_key = $this->config->item("admin_auth_session_key");
        $author_id = $this->session->userdata($admin_auth_session_key)["id"];

        $type = $this->input->post("type", true);
        $status = $this->input->post("status", true);
        $categories_collection = $this->CategoriesModel->all();
        $categories_ids = array_column($categories_collection, "id");
        $types_allowed = ["daily_news", "important_news", "general_news"];

        if (!in_array($category_id, $categories_ids) || !in_array($type, $types_allowed)) {
            $this->notifier("notifier", "danger", [
                "title" => $this->lang->line("notifier_danger"),
                "description" => $this->lang->line("notifier_hacking_data")
            ]);

            redirect(base_url("admin/news/create"));
        }

        $upload_path = "./public/uploads/news/";
        $data = [];

        if (!empty($_FILES["multi_img"]["name"][0])) {
            $multi_images = [];
            $upload_result = $this->filemanager->upload_media("multi_img", $upload_path, "jpg|jpeg|png|gif|webp");

            if ($upload_result["success"]) {
                foreach ($upload_result["data"] as $file_data) {
                    $multi_images[] = $file_data["file_name"];
                }

                $data["multi_img"] = json_encode($multi_images);
            } else {
                $this->notifier("notifier", "warning", [
                    "title" => $this->lang->line("notifier_warning"),
                    "description" => $this->lang->line("notifier_invalid_img_format")
                ]);

                redirect(base_url("admin/news/create"));
            }
        }

        $upload_result = $this->filemanager->upload_media("img", $upload_path, "jpg|jpeg|png|gif|webp");
        if ($upload_result["success"]) {
            $uploaded_img_data = $upload_result["data"];
            $data['img'] = $uploaded_img_data["file_name"];
        } else {
            $this->notifier("notifier", "warning", [
                "title" => $this->lang->line("notifier_warning"),
                "description" => $this->lang->line("notifier_invalid_img_format")
            ]);

            redirect(base_url("admin/news/create"));
            return;
        }

        if (
            !empty($title_az)
            && !empty($title_en)
            && !empty($title_ru)
            && !empty($short_description_az)
            && !empty($short_description_en)
            && !empty($short_description_ru)
            && !empty($long_description_az)
            && !empty($long_description_en)
            && !empty($long_description_ru)
        ) {

            // ============================================
            // ✅ SEO məlumatlarını avtomatik yaratmaq üçün OpenAI çağırışı
            $seo_prompt = "Mənim üçün aşağıdakı xəbərə SEO məlumatları yarat:
            
            Başlıq: $title_az
            Mətn: $long_description_az

            JSON formatında cavab ver:
            {
              \"seo_title\": \"... (qısa və cəlbedici)\",
              \"seo_description\": \"... (150-160 simvol)\",
              \"seo_keywords\": \"söz1, söz2, söz3 ... (8-12 söz)\"
            }";

            $seo_json = $this->openai->ask($seo_prompt, "openai/gpt-3.5-turbo");
            $seo_data = json_decode($seo_json, true);

            // Əgər düzgün JSON gəlməsə fallback et
            if (!$seo_data || !isset($seo_data['seo_title'])) {
                $seo_data = [
                    'seo_title' => $title_az,
                    'seo_description' => mb_substr(strip_tags($long_description_az), 0, 160),
                    'seo_keywords' => implode(", ", array_slice(explode(" ", $title_az), 0, 10))
                ];
            }
            // ============================================






            $data = array_merge($data, [
                "title_az" => $title_az,
                "title_en" => $title_en,
                "title_ru" => $title_ru,
                "short_description_az" => $short_description_az,
                "short_description_en" => $short_description_en,
                "short_description_ru" => $short_description_ru,
                "long_description_az" => $long_description_az,
                "long_description_en" => $long_description_en,
                "long_description_ru" => $long_description_ru,
                "video" => $video_link,
                "category_id" => $category_id,
                "author_id" => $author_id,
                "type" => $type,
                "status" => $status === "on",

                // SEO sahələri
                "seo_title"       => $seo_data['seo_title'],
                "seo_description" => $seo_data['seo_description'],
                "seo_keywords"    => $seo_data['seo_keywords'],
            ]);


            // ============================================
            // ✅ Embedding yaratmaq mentiqi axtaris ucun
            $text_for_embedding = $title_az . " " . $short_description_az . " " . strip_tags($long_description_az);
            $embedding = $this->openai->embed($text_for_embedding);

            if ($embedding) {
                $data["embedding"] = json_encode($embedding);
            }
            // ============================================

            $this->NewsModel->create($data);

            $this->notifier("notifier", "success", [
                "title" => $this->lang->line("notifier_success"),
                "description" => $this->lang->line("notifier_success_added")
            ]);

            redirect(base_url("admin/news"));
        } else {
            $this->notifier("notifier", "warning", [
                "title" => $this->lang->line("notifier_warning"),
                "description" => $this->lang->line("notifier_empty_fields")
            ]);

            redirect(base_url("admin/news/create"));
        }
    }

    public function edit($id)
    {
        $context["news"] = $this->NewsModel->find($id);
        $context["categories_collection"] = $this->CategoriesModel->all();
        if (!empty($context["news"])) {
            $news_title = $context["news"]["title_{$this->get_admin_language()}"];
            $context["page_title"] = $this->lang->line("edit_news") . " • $news_title";
            $this->load->view("admin/news/edit", $context);
        } else {
            $this->notifier("notifier", "info", [
                "title" => $this->lang->line("notifier_info"),
                "description" => $this->lang->line("notifier_invalid_id")
            ]);
            redirect(base_url("admin/news"));
        }
    }

    public function update($id)
    {
        $context["news"] = $this->NewsModel->find($id);

        if (empty($context["news"])) {
            $this->notifier("notifier", "info", [
                "title" => $this->lang->line("notifier_info"),
                "description" => $this->lang->line("notifier_invalid_id")
            ]);

            redirect(base_url("admin/news"));
        }

        $title_az = trim($this->input->post("title_az", true));
        $title_en = trim($this->input->post("title_en", true));
        $title_ru = trim($this->input->post("title_ru", true));
        $short_description_az = trim($this->input->post("short_description_az", true));
        $short_description_en = trim($this->input->post("short_description_en", true));
        $short_description_ru = trim($this->input->post("short_description_ru", true));
        $long_description_az = $this->input->post("long_description_az", false);
        $long_description_en = $this->input->post("long_description_en", false);
        $long_description_ru = $this->input->post("long_description_ru", false);
        $video_link = $this->input->post("video_link", true);
        $category_id = $this->input->post("category_id", true);

        $admin_auth_session_key = $this->config->item("admin_auth_session_key");
        $author_id = $this->session->userdata($admin_auth_session_key)["id"];

        $type = $this->input->post("type", true);
        $status = $this->input->post("status", true);

        $categories_collection = $this->CategoriesModel->all();
        $categories_ids = array_column($categories_collection, "id");
        $types_allowed = ["daily_news", "important_news", "general_news"];

        if (!in_array($category_id, $categories_ids) || !in_array($type, $types_allowed)) {
            $this->notifier("notifier", "danger", [
                "title" => $this->lang->line("notifier_danger"),
                "description" => $this->lang->line("notifier_hacking_data")
            ]);

            redirect(base_url("admin/news/$id/edit"));
        }

        if (
            !empty($title_az)
            && !empty($title_en)
            && !empty($title_ru)
            && !empty($short_description_az)
            && !empty($short_description_en)
            && !empty($short_description_ru)
            && !empty($long_description_az)
            && !empty($long_description_en)
            && !empty($long_description_ru)
        ) {
            $upload_path = "./public/uploads/news/";




            if (!empty($_FILES["multi_img"]["name"][0])) {
                $multi_images = [];
                $upload_result = $this->filemanager->upload_media("multi_img", $upload_path, "jpg|png|jpeg|webp");

                if ($upload_result["success"]) {
                    foreach ($upload_result["data"] as $file_data) {
                        $multi_images[] = $file_data["file_name"];
                    }

                    $data["multi_img"] = json_encode($multi_images);
                } else {
                    $this->notifier("notifier", "warning", [
                        "title" => $this->lang->line("notifier_warning"),
                        "description" => $this->lang->line("notifier_invalid_img_format")
                    ]);

                    redirect(base_url("admin/news/$id/edit"));
                }
            }

            $current_img_name = $context["news"]["img"];
            if (!empty($_FILES["img"]["name"])) {
                $upload_result = $this->filemanager->upload_media("img", $upload_path, "jpg|png|jpeg|webp");

                if ($upload_result["success"]) {
                    $uploaded_img_data = $upload_result["data"];
                    $current_img_name = $uploaded_img_data["file_name"];
                    $old_image_path = $upload_path . $context["news"]["img"];
                    $this->filemanager->delete_file($old_image_path);
                } else {
                    $this->notifier("notifier", "warning", [
                        "title" => $this->lang->line("notifier_warning"),
                        "description" => $this->lang->line("notifier_invalid_img_format")
                    ]);

                    redirect(base_url("admin/news/$id/edit"));
                    return;
                }
            }


            // ====================================
            // ✅ SEO update də əlavə olunur
            $seo_prompt = "Mənim üçün aşağıdakı xəbərə SEO məlumatları yarat:
            
            Başlıq: $title_az
            Mətn: $long_description_az

            JSON formatında cavab ver:
            {
              \"seo_title\": \"... (qısa və cəlbedici)\",
              \"seo_description\": \"... (150-160 simvol)\",
              \"seo_keywords\": \"söz1, söz2, söz3 ... (8-12 söz)\"
            }";

            $seo_json = $this->openai->ask($seo_prompt, "openai/gpt-3.5-turbo");
            $seo_data = json_decode($seo_json, true);

            if (!$seo_data || !isset($seo_data['seo_title'])) {
                $seo_data = [
                    'seo_title' => $title_az,
                    'seo_description' => mb_substr(strip_tags($long_description_az), 0, 160),
                    'seo_keywords' => implode(", ", array_slice(explode(" ", $title_az), 0, 10))
                ];
            }
            // ====================================


            $data = [
                "title_az" => $title_az,
                "title_en" => $title_en,
                "title_ru" => $title_ru,
                "short_description_az" => $short_description_az,
                "short_description_en" => $short_description_en,
                "short_description_ru" => $short_description_ru,
                "long_description_az" => $long_description_az,
                "long_description_en" => $long_description_en,
                "long_description_ru" => $long_description_ru,
                "video" => $video_link,
                "category_id" => $category_id,
                "author_id" => $author_id,
                "type" => $type,
                "status" => $status === "on",
                "img" => $current_img_name,

                // SEO sahələri
                "seo_title"       => $seo_data['seo_title'],
                "seo_description" => $seo_data['seo_description'],
                "seo_keywords"    => $seo_data['seo_keywords'],
            ];

            // ============================================
            // ✅ Embedding yeniləmək
            $text_for_embedding = $title_az . " " . $short_description_az . " " . strip_tags($long_description_az);
            $embedding = $this->openai->embed($text_for_embedding);

            if ($embedding) {
                $data["embedding"] = json_encode($embedding);
            }
            // ============================================

            $this->NewsModel->update($id, $data);

            $this->notifier("notifier", "success", [
                "title" => $this->lang->line("notifier_success"),
                "description" => $this->lang->line("notifier_success_update")
            ]);

            redirect(base_url("admin/news/$id/edit"));
        } else {
            $this->notifier("notifier", "warning", [
                "title" => $this->lang->line("notifier_warning"),
                "description" => $this->lang->line("notifier_empty_fields")
            ]);

            redirect(base_url("admin/news/$id/edit"));
        }
    }

    public function destroy($id)
    {
        $context["news"] = $this->NewsModel->find($id);

        if (empty($context["news"])) {
            $this->notifier("notifier", "info", [
                "title" => $this->lang->line("notifier_info"),
                "description" => $this->lang->line("notifier_invalid_id")
            ]);

            redirect(base_url("admin/news"));
        }

        $upload_path = "./public/uploads/news/";
        $current_img_path = $upload_path . $context["news"]["img"];
        $this->filemanager->delete_file($current_img_path);

        $multi_images = json_decode($context["news"]["multi_img"], true);
        if (!empty($multi_images)) {
            foreach ($multi_images as $image) {
                $this->filemanager->delete_file($upload_path . $image);
            }
        }

        $this->NewsModel->delete($id);

        $this->notifier("notifier", "success", [
            "title" => $this->lang->line("notifier_sucess"),
            "description" => $this->lang->line("notifier_success_delete")
        ]);

        redirect(base_url("admin/news"));
    }

    public function status($id)
    {
        $status = $this->input->post("status");
        $data = [
            "status" => $status === "on"
        ];
        $this->NewsModel->update($id, $data);
        $this->notifier("notifier", "success", [
            "title" => $this->lang->line("notifier_success"),
            "description" => $this->lang->line("notifier_success_update")
        ]);
        redirect($_SERVER["HTTP_REFERER"] ?? base_url("admin/news"));
    }

    public function json()
    {
        $this->db
            ->select("news.*,
            admins.first_name as author_first_name,
            admins.last_name as author_last_name,
            admins.img as author_img,
            admins.role as author_role,
            categories.name_az as category_name_az,
            categories.name_en as category_name_en,
            categories.name_ru as category_name_ru")
            ->join("admins", "news.author_id = admins.id", "left")
            ->join("categories", "news.category_id = categories.id", "left");

        $columns = [
            "id",
            "title_az",
            "title_en",
            "title_ru",
            "img",
            "category_id",
            "author_id",
            "type",
            "status",
            "author_first_name",
            "author_last_name",
            "author_img",
            "author_role",
            "category_name_az",
            "category_name_en",
            "category_name_ru"
        ];

        $searchable_columns = [
            "title_az",
            "title_en",
            "title_ru",
            "category_id",
            "author_id",
            "type",
            "status",
            "author_first_name",
            "author_last_name",
            "author_role",
            "category_name_az",
            "category_name_en",
            "category_name_ru"
        ];

        $this->datatable_json("news", $columns, $searchable_columns);
    }


    // cosine_similarity (axtarisda istifadə edəcəyik) Vektor
    private function cosine_similarity($vec1, $vec2)
    {
        $dot = 0.0;
        $norm1 = 0.0;
        $norm2 = 0.0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dot += $vec1[$i] * $vec2[$i];
            $norm1 += $vec1[$i] ** 2;
            $norm2 += $vec2[$i] ** 2;
        }

        return $dot / (sqrt($norm1) * sqrt($norm2));
    }


    public function semantic_search($query, $limit = 10)
    {
        $this->load->library('openai');

        // 1. Sorğunu embedding et
        $query_embedding = $this->openai->embed($query);
        if (!$query_embedding) return [];

        // 2. Xəbərləri götür
        $news = $this->db->get('news')->result();
        $results = [];

        // 3. Similarity hesabla
        foreach ($news as $n) {
            if (!$n->embedding) continue;
            $embedding = json_decode($n->embedding, true);
            $similarity = $this->cosine_similarity($query_embedding, $embedding);
            $results[] = [
                "news" => $n,
                "score" => $similarity
            ];
        }

        // 4. Oxşarlığa görə sırala
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return array_slice($results, 0, $limit);
    }

    /**
     * ChatGPT axtarış üçün view
     */
    // public function chatgpt_search()
    // {
    //     $context = [
    //         "page_title" => "ChatGPT Axtarış"
    //     ];
    //     //  $all_news = $this->NewsModel->with_author_category();
    //     // print_r("<pre>")
    //     // print_r($all_news);

    //     $this->load->view("admin/news/chatgpt_search", $context);
    // }


    // public function ajax_search()
    // {
    //     header('Content-Type: application/json; charset=utf-8');

    //     $query = trim($this->input->get("q", true));
    //     if (empty($query)) {
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "Axtarış sözü boş ola bilməz."
    //         ]);
    //         exit;
    //     }

    //     // Mövcud xəbərləri çək (model dəyişmir)
    //     $all_news = $this->NewsModel->with_author_category();

    //     // Local filter
    //     $local_results = [];
    //     foreach ($all_news as $news) {
    //         if (
    //             stripos($news['title_az'], $query) !== false ||
    //             stripos($news['title_en'], $query) !== false
    //         ) {
    //             $local_results[] = [
    //                 "id" => $news['id'],
    //                 "title_az" => $news['title_az'],
    //                 "title_en" => $news['title_en'],
    //                 "short_description_az" => $news['short_description_az'],
    //                 "short_description_en" => $news['short_description_en'],
    //                 "img" => $news['img'],
    //                 "category_id" => $news['category_id'],
    //                 "author_id" => $news['author_id'],
    //                 "type" => $news['type'],
    //                 "status" => $news['status'],
    //             ];
    //         }
    //     }

    //     // ChatGPT ağıllı sıralama
    //     if (!empty($local_results)) {
    //         $prompt = "Sən CodeIgniter3 admin panel köməkçisisən. ".
    //             "Aşağıdakı xəbərləri sorğuya görə sıralayıb JSON formatında ver.\n".
    //             "Sorğu: \"$query\"\n".
    //             "Xəbərlər: " . json_encode($local_results) . "\n".
    //             "Cavab formatı:\n".
    //             "[{\"id\": 1, \"title_az\": \"...\", \"title_en\": \"...\", \"short_description_az\": \"...\", \"short_description_en\": \"...\"}]";

    //         $ai_response = $this->openai->ask($prompt, "openai/gpt-3.5-turbo");

    //         // Regex ilə JSON çıxar
    //         $matches = [];
    //         if (preg_match('/\[(.*?)\]/s', $ai_response, $matches)) {
    //             $ai_parsed = json_decode($matches[0], true);
    //             if ($ai_parsed) $local_results = $ai_parsed;
    //         }
    //     }

    //     echo json_encode([
    //         "status" => "success",
    //         "results" => $local_results
    //     ]);
    //     exit;
    // }




    // public function ajax_search()
    // {
    //     header('Content-Type: application/json; charset=utf-8');

    //     $query = trim($this->input->get("q", true));
    //     if (empty($query)) {
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "Axtarış sözü boş ola bilməz."
    //         ]);
    //         exit;
    //     }

    //     // 1️⃣ Mövcud xəbərləri çək
    //     $all_news = $this->NewsModel->with_author_category();

    //     // 2️⃣ Local PHP filter
    //     $local_results = [];
    //     foreach ($all_news as $news) {
    //         if (
    //             stripos($news['title_az'], $query) !== false ||
    //             stripos($news['title_en'], $query) !== false
    //         ) {
    //             $local_results[] = [
    //                 "id" => $news['id'],
    //                 "title_az" => $news['title_az'],
    //                 "title_en" => $news['title_en']
    //             ];
    //         }
    //     }

    //     // 3️⃣ OpenAI ChatGPT ağıllı sıralama
    //     if (!empty($local_results)) {
    //         $prompt = "Sən CodeIgniter3 admin panel köməkçisisən. ".
    //             "Aşağıdakı xəbərləri sorğuya görə sıralayıb JSON formatında ver.\n".
    //             "Sorğu: \"$query\"\n".
    //             "Xəbərlər: " . json_encode($local_results) . "\n".
    //             "Cavab formatı:\n".
    //             "[{\"id\": 1, \"title_az\": \"...\", \"title_en\": \"...\"}]";

    //         $ai_response = $this->openai->ask($prompt, "openai/gpt-3.5-turbo");

    //         // Regex ilə JSON çıxar
    //         $matches = [];
    //         if (preg_match('/\[(.*?)\]/s', $ai_response, $matches)) {
    //             $ai_parsed = json_decode($matches[0], true);
    //             if ($ai_parsed) $local_results = $ai_parsed; // AI nəticə override edir
    //         }
    //     }

    //     // 4️⃣ JSON cavab göndər
    //     echo json_encode([
    //         "status" => "success",
    //         "results" => $local_results
    //     ]);
    //     exit;
    // }


    // public function ajax_search()
    // {
    //     header('Content-Type: application/json; charset=utf-8');

    //     // 1️⃣ Sorğu al
    //     $query = trim($this->input->get("q", true));
    //     if (empty($query)) {
    //         echo json_encode([
    //             "status" => "error",
    //             "message" => "Axtarış sözü boş ola bilməz."
    //         ]);
    //         exit;
    //     }

    //     // 2️⃣ Mövcud xəbərləri çək
    //     $all_news = $this->NewsModel->with_author_category();

    //     // 3️⃣ Local PHP filter (modeli dəyişmirik)
    //     $results = [];
    //     foreach ($all_news as $news) {
    //         if (
    //             stripos($news['title_az'], $query) !== false ||
    //             stripos($news['title_en'], $query) !== false
    //         ) {
    //             $results[] = [
    //                 "id" => $news['id'],
    //                 "title_az" => $news['title_az'],
    //                 "title_en" => $news['title_en']
    //             ];
    //         }
    //     }

    //     // 4️⃣ OpenAI ChatGPT ilə də sorğu göndər (opsional)
    //     // Əgər AI cavab istəmirsə, bu hissəni silə bilərsən
    //     if (!empty($results)) {
    //         $prompt = "Sən CodeIgniter3 admin panel köməkçisisən. ".
    //             "Aşağıdakı sorğuya uyğun xəbərlərin ID və başlıqlarını JSON formatında ver:\n".
    //             "Sorğu: \"$query\"\n".
    //             "Mövcud xəbərlər: " . json_encode($results) . "\n".
    //             "JSON formatında cavab ver:\n".
    //             "[{\"id\": 1, \"title_az\": \"...\", \"title_en\": \"...\"}]";

    //         $ai_response = $this->openai->ask($prompt, "openai/gpt-3.5-turbo");

    //         // Regex ilə JSON çıxar
    //         $matches = [];
    //         if (preg_match('/\[(.*?)\]/s', $ai_response, $matches)) {
    //             $ai_parsed = json_decode($matches[0], true);
    //             if ($ai_parsed) $results = $ai_parsed; // AI nəticə override edir
    //         }
    //     }

    //     // 5️⃣ JSON cavab göndər
    //     echo json_encode([
    //         "status" => "success",
    //         "results" => $results
    //     ]);
    //     exit;
    // }



}
