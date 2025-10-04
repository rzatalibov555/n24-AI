<?php $this->load->view("admin/partials/_head"); ?>
<?php $this->load->view("admin/partials/_sidebar"); ?>
<?php $this->load->view("admin/partials/_navbar"); ?>

<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"><?= $this->lang->line("all_news"); ?></h6>

                    <div class="mb-3 d-flex">
                        <input type="text" id="search_query" class="form-control me-2" placeholder="<?= $this->lang->line("search"); ?>">
                        <button id="search_btn" class="btn btn-primary"><?= $this->lang->line("search"); ?></button>
                    </div>

                    <div class="table-responsive">
                        <table id="newsDataTable" class="table">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line("id"); ?></th>
                                    <th><?= $this->lang->line("image"); ?></th>
                                    <th><?= $this->lang->line("title"); ?></th>
                                    <th><?= $this->lang->line("category"); ?></th>
                                    <th><?= $this->lang->line("author"); ?></th>
                                    <th><?= $this->lang->line("type"); ?></th>
                                    <th><?= $this->lang->line("status"); ?></th>
                                    <th><i class="icon-lg text-secondary pb-3px" data-feather="menu"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle">
                    <?= $this->lang->line("modal_confirm_delete_title"); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <?= $this->lang->line("modal_confirm_delete_description"); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <?= $this->lang->line("close"); ?>
                </button>
                <a href="javascript:void(0);" id="deleteButton" class="btn btn-outline-danger">
                    <?= $this->lang->line("delete"); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view("admin/partials/_footer"); ?>
<?php $this->load->view("admin/partials/_scripts"); ?>

<script>
$(document).ready(function(){

    const ACTIONS_LANG = {
        "view": "<?= $this->lang->line('view') ?>",
        "edit": "<?= $this->lang->line('edit') ?>",
        "delete": "<?= $this->lang->line('delete') ?>",
        "daily_news": "<?= $this->lang->line('daily_news') ?>",
        "general_news": "<?= $this->lang->line('general_news') ?>",
        "important_news": "<?= $this->lang->line('important_news') ?>"
    };

    // DataTable yarat
    var table = $("#newsDataTable").DataTable({
        serverSide: false,
        processing: true,
        autoWidth: false,
        columns: [
            { data: "id", title: "ID" },
            { data: "img", orderable: false, searchable: false, title: "Şəkil" },
            { data: "title", title: "Başlıq" },
            { data: "category_name_az", title: "Kateqoriya" },
            { data: "author_first_name", title: "Müəllif" },
            { data: "type", title: "Tip" },
            { data: "status", orderable: false, searchable: false, title: "Status" },
            { data: "actions", orderable: false, searchable: false, title: "" }
        ]
    });

    function searchNews(){
        var query = $("#search_query").val().trim();
        if(query.length === 0){
            alert("Axtarış boş ola bilməz!");
            return;
        }

        $.ajax({
            url: "<?= base_url('admin/news/ajax_search') ?>",
            method: "GET",
            data: { q: query },
            dataType: "json",
            success: function(response){
                table.clear();
                if(response.status === "success" && response.results.length > 0){
                    response.results.forEach(function(news){
                        const img_src = news.img
                            ? "<?= base_url('public/uploads/news/') ?>" + news.img
                            : "<?= base_url('public/admin/assets/images/others/placeholder.jpg') ?>";

                        const type_badge = news.type === 'daily_news' ? 
                            '<span class="badge border border-info text-info">' + ACTIONS_LANG.daily_news + '</span>' :
                            news.type === 'general_news' ?
                            '<span class="badge border border-primary text-primary">' + ACTIONS_LANG.general_news + '</span>' :
                            '<span class="badge border border-danger text-danger">' + ACTIONS_LANG.important_news + '</span>';

                        const status_form = `
                            <form method="post" action="<?= base_url('admin/news/') ?>${news.id}/status">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <div class="form-check form-switch mb-0">
                                    <input type="checkbox" class="form-check-input" name="status" onchange="this.form.submit();" ${news.status == 1 ? "checked" : ""}>
                                    <label class="form-check-label"></label>
                                </div>
                            </form>`;

                        table.row.add({
                            id: news.id,
                            img: `<a data-fancybox="gallery" href="${img_src}"><img src="${img_src}" alt="News" height="50"></a>`,
                            title: `<a href="<?= base_url('admin/news/') ?>${news.id}">${news.title_az || ""}</a>`,
                            category_name: category_name_az || "",
                            author_name: (author_first_name || "") + " " + (author_last_name || ""),
                            type: type_badge,
                            status: status_form,
                            actions: `
                                <div class="dropdown mb-2">
                                    <a type="button" data-bs-toggle="dropdown">
                                        <i class="icon-lg text-primary pb-3px" data-feather="command"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/news/') ?>${news.id}">
                                            <i data-feather="eye" class="icon-sm text-info me-2"></i> <span class="text-info">${ACTIONS_LANG.view}</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/news/') ?>${news.id}/edit">
                                            <i data-feather="edit-2" class="icon-sm text-warning me-2"></i> <span class="text-warning">${ACTIONS_LANG.edit}</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('admin/news/') ?>${news.id}/delete">
                                            <i data-feather="trash" class="icon-sm text-danger me-2"></i> <span class="text-danger">${ACTIONS_LANG.delete}</span>
                                        </a>
                                    </div>
                                </div>`
                        }).draw(false);
                    });
                    feather.replace();
                    Fancybox.bind("[data-fancybox='gallery']", {});
                } else {
                    table.row.add({
                        id: "",
                        img: "",
                        title: "<em>Nəticə tapılmadı.</em>",
                        category_name: "",
                        author_name: "",
                        type: "",
                        status: "",
                        actions: ""
                    }).draw();
                }
            },
            error: function(){
                table.clear().draw();
                table.row.add({
                    id: "",
                    img: "",
                    title: "<em>Xəta baş verdi!</em>",
                    category_name: "",
                    author_name: "",
                    type: "",
                    status: "",
                    actions: ""
                }).draw();
            }
        });
    }

    $("#search_btn").click(searchNews);
    $("#search_query").keypress(function(e){
        if(e.which == 13) searchNews();
    });

    $("#newsDataTable").on("click", "[data-bs-toggle='modal']", function(){
        const url = $(this).data("url");
        $("#deleteButton").attr("href", url);
    });

});
</script>

