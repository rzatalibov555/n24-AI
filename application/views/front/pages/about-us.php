<?php $this->load->view('front/partials/headerStyle.php'); ?>
<?php $this->load->view('front/partials/loader.php'); ?>


<?php $this->load->view('front/partials/header.php'); ?>
<?php $this->load->view('front/partials/sideMenu.php'); ?>
<?php $this->load->view('front/partials/search.php'); ?>
<?php // $this->load->view('front/partials/breakingNews.php'); 
?>

<style>
  
  
  .padding_social{
        padding: 2px 5px!important;
  }

  .padding_box_social{
    padding: 12px!important;
  }

  .follow-style-01 .social-box .social:before {
    content: none!important;
    
  }

  .follow-style-01 .social-box .social{
        justify-content: center;
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
          <li class="breadcrumb-item active"><i class="fa-solid fa-chevron-right me-2"></i><span>Haqqımızda</span></li>
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
      <div class="col-lg-7 col-xl-8">
        <div class="row">
          <div class="col-sm-12 mb-4 mb-sm-0">
            <img class="img-fluid border-radius" src="<?php echo base_url('public/front/'); ?>images/about/01.jpg" alt="">
          </div>
          <!-- <div class="col-sm-4">
            <img class="img-fluid border-radius" src="<?php // echo base_url('public/front/'); ?>images/about/02.jpg" alt="">
          </div> -->
        </div>
        <div class="row mt-5">
          <div class="col-12">
            <h3>A Brief History</h3>
            <p class="mb-0">Was this just another little prank, courtesy of a mischievous Universe? Or is it possible to get good things coming your way with only mild desire — maybe even a calm indifference? Many inspirational writers, including Napoleon Hill, have assured us that a burning desire is one of the prerequisites of acquiring a fortune.</p>
          </div>
          <div class="col-md-6 col-lg-12 col-xl-6 ">
            <p class="my-4 my-md-5 my-lg-4 mb-lg-0 my-xl-5 "> <span class="dropcap">W</span>e all carry a lot of baggage, thanks to our upbringing. The majority of people carry with them, an entire series of self-limiting beliefs that will absolutely stop, and hold them back from, success. Things like “I’m not good enough”, “I’m not smart enough”, “I’m not lucky enough”, and the worst, “I’m not worthy” are but a few of the self-limiting beliefs I have encountered. We carry them with us like rocks in a knapsack, and then use them to sabotage our success. So, how twisted is that?</p>
          </div>
          <div class="col-md-6 col-lg-12 col-xl-6">
            <p class="my-4 my-md-5 my-lg-4 my-xl-5 ">Along with your plans, you should consider developing an action orientation that will keep you motivated to move forward at all times. This requires a little self-discipline, but is a crucial component to achievement of any kind. Before starting any new activity, ask yourself if that activity will move you closer to your goals. If the answer is no, you may want to reconsider doing it at that time.</p>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-lg-12">
            <blockquote class="blockquote d-flex">
              <i class="fas fa-quote-left me-4 text-primary"></i>
              <p>The best way is to develop and follow a plan. Start with your goals in mind and then work backwards to develop the plan. What steps are required to get you to the goals? Make the plan as detailed as possible. Try to visualize and then plan for, every possible setback. Commit the plan to paper and then keep it with you at all times. Review it regularly and ensure that every step takes you closer to your Vision and Goals. If the plan doesn’t support the vision then change it!</p>
            </blockquote>
          </div>
        </div> -->
        
      </div>
      <div class="col-lg-5 col-xl-4">
        <div class="sidebar">
          <div class="widget sidebar-category">
            <!-- <h6 class="widget-title">Media</h6> -->
            <div class="row">
              <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-6">
                <div class="follow-style-01">
                  <div class="facebook-fans social-box padding_box_social">
                    <div class="social">
                      <a class="fans-icon" href="#"><i class="fa-brands fa-facebook-square"></i></a>
                     
                    </div>
                    <div class="fans follower-btn">
                      <a href="#" class="padding_social">Facebook</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-6 mb-xl-3 mb-0">
                <div class="follow-style-01">
                  <div class="twitter-follower social-box padding_box_social">
                    <div class="social">
                      <a class="twitter-icon" href="#"><i style="font-family: emoji;" class="fa-brands fa-x"></i></a>
                      
                    </div>
                    <div class="follower follower-btn">
                      <a href="#" class="padding_social">X</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-6">
                <div class="follow-style-01">
                  <div class="you-tube social-box padding_box_social">
                    <div class="social">
                      <a class="tube-icon" href="#"><i class="fa-brands fa-youtube"></i></a>
                      
                    </div>
                    <div class="subscriber follower-btn">
                      <a href="#" class="padding_social">YouTube</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-6">
                <div class="follow-style-01">
                  <div class="instagram-Follower social-box padding_box_social">
                    <div class="social">
                      <a class="instagram-icon" href="#"><i class="fa-brands fa-instagram"></i></a>
                     
                    </div>
                    <div class="instagrams follower-btn">
                      <a href="#" class="padding_social">Instagram</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

         

          <div class="widget widget-tag mb-0">
            <h6 class="widget-title">Kateqoriyalar</h6>
            <ul class="list-unstyled font_s11">
              <li><a href="#"> SİYASƏT</a></li>
              <li><a href="#"> İQTİSADİYYAT</a></li>
              <li><a href="#"> ELM VƏ TƏHSİL</a></li>
              <li><a href="#"> İDMAN</a></li>
              <li><a href="#"> TEXNOLOGİYA</a></li>
              <li><a href="#"> MƏDƏNİYYƏT</a></li>
              <li><a href="#"> MALİYYƏ</a></li>
              <li><a href="#"> TURİZM</a></li>
              <li><a href="#"> SOSİUM</a></li>
              <li><a href="#"> RƏY</a></li>
              <li><a href="#"> KÖŞƏ</a></li>
              <li><a href="#"> TƏHLİL</a></li>
              <li><a href="#"> VAKANSİYA</a></li>
              <li><a href="#"> MÜSAHİBƏ</a></li>
              <li><a href="#"> XARİCİ XƏBƏRLƏR</a></li>
              <li><a href="#"> MƏQALƏLƏR</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--=================================
    Blog -->

<!--=================================
    Blog -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <hr class="m-0">
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