<?php $this->load->view('front/partials/headerStyle.php'); ?>
<?php $this->load->view('front/partials/loader.php'); ?>


<?php $this->load->view('front/partials/header.php'); ?>
<?php $this->load->view('front/partials/sideMenu.php'); ?>
<?php $this->load->view('front/partials/search.php'); ?>
<?php // $this->load->view('front/partials/breakingNews.php'); 
?>

<style>
  .im {
    width: 120px;
    height: 90px;
    /* background: red; */
    float: left;
    margin: 5px;
    object-fit: cover;
    object-position: top;
  }

  
</style>

<!-- container and reklam -->
<?php $this->load->view('front/partials/site_container/site_container_start.php'); ?>
<!-- container and reklam -->


<!--=================================
    Inner Header -->
<section class="inner-header border_radius_st">
  <div class="container">
    <div class="row ">
      <div class="col-md-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home me-1"></i>Ana səhifə</a></li>
          <li class="breadcrumb-item active"><i class="fa-solid fa-chevron-right me-2"></i><span>Xəbərin adı</span></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!--=================================
    Inner Header -->

<!--=================================
    Blog -->
<section class="space-ptb">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-xl-8 blog-single">
        <div class="blog-post-info">
          <div class="blog-content pb-0">
            <div class="blog-post-image mb-4">
              <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/politician/01.jpg" alt="">
            </div>
            <div class="blog-post-title">
              <h3 class="mb-0"><a href="#">Does your life lack meaning</a></h3>
            </div>
            <div class="blog-post post-style-07 border-0 py-4 px-0">
              <div class="blog-post-details">
                <div class="blog-post-meta p-0">

                  <div class="blog-post-time">
                    <a href="#"><i class="fa-solid fa-calendar-days"></i>Jan 21 2022</a>
                  </div>


                </div>
              </div>
            </div>
            <p class="mb-3">Success isn’t really that difficult. There is a significant portion of the population here in North America, that actually want and need success to be hard! Why? So they then have a built-in excuse when things don’t go their way! Pretty sad situation, to say the least. For those of you who are serious about having more, doing more, giving more and being more, success is achievable with some understanding of what to do, some discipline around planning and execution of those plans and belief that you can achieve your desires.</p>
            <b class="my-3 d-block">Let success motivate you. Find a picture of what epitomizes success to you and then pull it out when you are in need of motivation.</b>
            <p>The first thing to remember about success is that it is a process – nothing more, nothing less. There is really no magic to it and it’s not reserved only for a select few people.</p>


            <div class="popup-video my-4">
              <img class="img-fluid border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/02.jpg" alt="">
            </div>


            <div class="row">
              <div class="col-sm-12">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
                <img class="img-fluid im border-radius" src="<?php echo base_url('public/front/'); ?>images/blog/politician/04.jpg" alt="">
              </div>

            </div>




            <div class="blog-post-share-box d-flex flex-wrap justify-content-between align-items-center mt-4">
              <div class="blog-post post-style-07 border-0 ps-0">
                <div class="blog-post-details">
                  <div class="blog-post-meta p-0">
                    <div class="blog-post-share">
                      <div class="share-box">
                        <a href="#"><i class="fa-solid fa-share-nodes"></i>Share</a>
                        <ul class="list-unstyled share-box-social">
                          <li> <a href="#"><i class="fab fa-facebook-f"></i></a> </li>
                          <li> <a href="#"><i class="fab fa-twitter"></i></a> </li>
                          <li> <a href="#"><i class="fa-brands fa-linkedin-in"></i></a> </li>
                          <li> <a href="#"><i class="fab fa-instagram"></i></a> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="badges">

                <a href="#" class="btn-primary  btn">İQTİSADİYYAT</a>
              </div>
            </div>


            <div class="bg-white mt-4">
              <div class="section-title">
                <h2 class="mb-0" style="text-transform: none;"><i class="fa-solid fa-list" style="color: #30c96a;"></i>Xəbər lenti</h2>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="owl-carousel arrow-styel-02 owl-loaded owl-drag" data-nav-dots="false" data-nav-arrow="true" data-items="3" data-xl-items="3" data-lg-items="2" data-md-items="2" data-sm-items="2" data-xs-items="1" data-xx-items="1" data-autoheight="true">
                    <!-- item-01 -->
                    <div class="item">
                      <div class="blog-post post-style-02">
                        <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/01.jpg" alt=""> </div> <span class="badge badge-large bg-red">Photography</span>
                        <div class="blog-post-details">
                          <h6 class="blog-title"><a href="#">Photography is about simplicity</a></h6>
                          <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Jan 17 2022</a> </div>
                        </div>
                      </div>
                    </div>
                    <!-- item-02 -->
                    <div class="item">
                      <div class="blog-post post-style-02">
                        <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/02.jpg" alt=""> </div> <span class="badge badge-large bg-skyblue">Comic</span>
                        <div class="blog-post-details">
                          <h6 class="blog-title"><a href="#">You'll believe a man can fly</a></h6>
                          <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Feb 2 2022</a> </div>
                        </div>
                      </div>
                    </div>
                    <!-- item-03 -->
                    <div class="item">
                      <div class="blog-post post-style-02">
                        <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/03.jpg" alt=""> </div> <span class="badge badge-large bg-blue">Painting</span>
                        <div class="blog-post-details">
                          <h6 class="blog-title"><a href="#">Painting makes us feel alive</a></h6>
                          <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 19 2022</a> </div>
                        </div>
                      </div>
                    </div>
                    <!-- item-04 -->
                    <div class="item">
                      <div class="blog-post post-style-02">
                        <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/04.jpg" alt=""> </div> <span class="badge badge-large bg-pink">Lifestyle</span>
                        <div class="blog-post-details">
                          <h6 class="blog-title"><a href="#">A lifestyle that you will love</a></h6>
                          <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Apr 20 2022</a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-xl-4">
        <div class="sidebar mt-lg-0">
          <div class="widget post-widget">
            <h6 class="widget-title" style="text-transform: none;">Oxşar xəbərlər</h6>
            <div class="news-tab">
              <!-- <ul class="nav nav-pills" id="pills-tab03" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-latest-tab" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="true"></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false" tabindex="-1"></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab" aria-controls="pills-videos" aria-selected="false" tabindex="-1"></button>
                  </li>
                </ul> -->
              <div class="tab-content" id="pills-tabContent03">
                <div class="tab-pane fade show active" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab" tabindex="0">
                  <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/01.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Show</span>
                      <h6 class="blog-title"><a href="#">Reach out to the show</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Jan 12 2022</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/02.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Photography</span>
                      <h6 class="blog-title"><a href="#">Photography is the art of moments frozen in time</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Feb 17 2022</a> </div>
                      </div>
                    </div>
                  </div>
                  <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>

                     <div class="blog-post post-style-04">
                    <!-- <div class="blog-image"> <img class="img-fluid" src="<?php echo base_url('public/front/'); ?>images/blog/latest/03.jpg" alt=""> </div> -->
                    <div class="blog-post-details"> <span class="badge text-primary">Food</span>
                      <h6 class="blog-title"><a href="#">Don’t be rude, donate some food</a></h6>
                      <div class="blog-post-meta">
                        <div class="blog-post-time"> <a href="#"><i class="fa-solid fa-calendar-days"></i>Mar 15 2022</a> </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
         
          
          <div class="widget widget-tag mb-0">
            <h6 class="widget-title">Kateqoriyalar</h6>
            <ul class="list-unstyled font_s11">
              <li><a href="#">SİYASƏT</a></li>
              <li><a href="#">İQTİSADİYYAT</a></li>
              <li><a href="#">ELM VƏ TƏHSİL</a></li>
              <li><a href="#">İDMAN</a></li>
              <li><a href="#">TEXNOLOGİYA</a></li>
              <li><a href="#">MƏDƏNİYYƏT</a></li>
              <li><a href="#">MALİYYƏ</a></li>
              <li><a href="#">TURİZM</a></li>
              <li><a href="#">SOSİUM</a></li>
              <li><a href="#">RƏY</a></li>
              <li><a href="#">KÖŞƏ</a></li>
              <li><a href="#">TƏHLİL</a></li>
              <li><a href="#">VAKANSİYA</a></li>
              <li><a href="#">MÜSAHİBƏ</a></li>
              <li><a href="#">XARİCİ XƏBƏRLƏR</a></li>
              <li><a href="#">MƏQALƏLƏR</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--=================================
    Blog -->




<!-- container and reklam -->
<?php $this->load->view('front/partials/site_container/site_container_end.php'); ?>
<!-- container and reklam -->


<?php $this->load->view("front/partials/footer"); ?>
<?php $this->load->view("front/partials/footerStyle"); ?>