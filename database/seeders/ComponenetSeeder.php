<?php

namespace Database\Seeders;

use App\Models\Central\Component;
use Illuminate\Database\Seeder;

class ComponenetSeeder extends Seeder
{
    public function run()
    {
        Component::insert([
            ['id' => '1', 'title_ar' => 'First Footer', 'title_en' => 'First Footer', 'link' => 'footer1', 'preview' => '<footer class="py-2">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-12 col-md-4 col-lg-3">
                          <div class="my-4">
                              <h3 class="pt-4 pb-2 fw-bold main_color">عن متجر</h3>
                              <p class="my-3 tiny_font">ربما ترغب فى دخول عالم التجارة الالكترونية ولكن لا تعرف من اين تبدأ, ولا انواع المنتجات التى ينبغى عليك بيعها, ربما ستساعدك قائمة اكثر</p>
                              <div class="d-flex align-items-center justify-content-start">
                                  <div class="icon_foot point">
                                      <i class="icon-facebook1"></i>
                                  </div>
                                  <div class="icon_foot point">
                                      <i class="icon-instagram"></i>
                                  </div>
                                  <div class="icon_foot point">
                                      <i class="icon-pinterest2"></i>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-8 col-lg-6">
                          <div class="my-4">
                              <div class="row">
                                  <div class="col-12 col-md px-0">
                                      <h5 class="pt-4 pb-2 fw-bold">اكترونيات</h5>
                                      <div class="">
                                          <ul class="list-unstyled px-0">
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">حواسيب</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">موبيلات</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شواحن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">بلايستيشن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شاشات تى فى</a></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md px-0">
                                      <h5 class="pt-4 pb-2 fw-bold">عطور وبرفان</h5>
                                      <div class="">
                                          <ul class="list-unstyled px-0">
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">حواسيب</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">موبيلات</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شواحن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">بلايستيشن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شاشات تى فى</a></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md px-0">
                                      <h5 class="pt-4 pb-2 fw-bold">ملابس واحذية</h5>
                                      <div class="">
                                          <ul class="list-unstyled px-0">
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">حواسيب</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">موبيلات</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شواحن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">بلايستيشن</a></li>
                                              <li class="my-3"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شاشات تى فى</a></li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-4 col-lg-3">
                          <div class="my-4">
                              <h5 class="pt-4 pb-2 fw-bold">تواصل معنا</h5>
                              <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-3">
                                  <i class="icon-mobile ms-1 h5 mb-0"></i>
                                  <span>999 8751 54138</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-3">
                                  <i class="icon-envelope-o ms-1 h5 mb-0"></i>
                                  <span>email@example.com</span>
                              </div>
                              <ul class="list-unstyled d-flex align-items-center justify-content-between px-0">
                                  <li class="my-3">
                                      <a href="#" class="text-decoration-none">
                                          <img src="/assets/img/-e-JCB_logo.svg.jpg" class="img-fluid" alt="image">
                                      </a>
                                  </li>
                                  <li class="my-3">
                                      <a href="#" class="text-decoration-none">
                                          <img src="/assets/img/-e-visa.jpg" class="img-fluid" alt="image">
                                      </a>
                                  </li>
                                  <li class="my-3">
                                      <a href="#" class="text-decoration-none">
                                          <img src="/assets/img/-e-58482354cef1014c0b5e49c0.jpg" class="img-fluid" alt="image">
                                      </a>
                                  </li>
                                  <li class="my-3">
                                      <a href="#" class="text-decoration-none">
                                          <img src="/assets/img/-e-Layer 1110.jpg" class="img-fluid" alt="image">
                                      </a>
                                  </li>
                                  <li class="my-3">
                                      <a href="#" class="text-decoration-none">
                                          <img src="/assets/img/-e-money.jpg" class="img-fluid" alt="image">
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </footer>
          ', 'type' => 'Footer', 'row_id' => '10.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '2', 'title_ar' => 'Second Footer', 'title_en' => 'Second Footer', 'link' => 'footer2', 'preview' => '<footer>
              <div class="top_header">
                  <section>
                      <span><i class="fa fa-map-marker"></i></span>
                      <span>Street, full address, state/province, country</span>
                  </section>
                  <section>
                      <span><i class="fa fa-phone"></i></span>
                      <span>89794 546 (09+) </span>
                  </section>
                  <section>
                      <span><i class="fa fa-envelope"></i></span>
                      <span>info@websitename.com</span>
                  </section>
              </div>
              <span class="border-shape"></span>
              <div class="bottom_content">
                  <section>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-instagram"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-telegram"></i></a>
                  </section>
                  <section>
                      <a href="#">Home</a>
                      <a href="#">About us</a>
                      <a href="#">Order</a>
                      <a href="#">Retail</a>
                      <a href="#">Member</a>
                      <a href="#">Contact Us</a>
                  </section>
              </div>
          </footer>
          ', 'type' => 'Footer', 'row_id' => '10.00', 'path' => '', 'created_at' => '2022-08-22 10:48:55', 'updated_at' => '2022-08-22 10:48:55'],
            ['id' => '3', 'title_ar' => 'Third Footer', 'title_en' => 'Third Footer', 'link' => 'footer3', 'preview' => '<footer class="py-4 third_bg">
              <div class="container">
                  <div class="row">
                      <div class="col-12 col-6 col-lg-4">
                          <div class="my-4 text-center">
                              <h3 class="pb-4 fw-bold second_color">عن متجر</h3>
                              <div class="d-flex justify-content-center">
                                  <div class="new_logo point">
                                      <input type="file" name="logo" value="">
                                      <h3 class="fw-bold position-absolute text-secondary text-center">Logo</h3>
                                  </div>
                              </div>
                              <p class="tiny_font second_color my-4">حتى هاربر موسكو ثم, وتقهقر المنتصرة حدة عل, التي فهرست واشتدّت أن أسر. كانت المتاخمة التغييرات أم وفي. ان وانتهاءً باستحداث قهر. ان ضمنها للأراضي الأوروبية ذات.</p>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my-4 text-center">
                              <h3 class="pb-2 fw-bold second_color">الروابط السريعة</h3>
                              <div class="d-flex align-items-center justify-content-center">
                                  <ul class="list-unstyled">
                                      <li class="my-4"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">حواسيب</a></li>
                                      <li class="my-4"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">موبيلات</a></li>
                                      <li class="my-4"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شواحن</a></li>
                                  </ul>
                                  <ul class="list-unstyled">
                                      <li class="my-4"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">بلايستيشن</a></li>
                                      <li class="my-4"><a href="#" class="text-decoration-none my_foot_link_1 h6 mb-0 fw-bold transition_me">شاشات تى فى</a></li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my-4 text-center">
                              <h3 class="pb-4 fw-bold second_color">تواصل معنا</h3>
                              <div class="d-flex align-items-center justify-content-center mb-3">
                                  <i class="icon-mobile ms-1 h5 mb-0 second_color"></i>
                                  <span class="second_color">999 8751 54138</span>
                              </div>
                              <div class="d-flex align-items-center justify-content-center mb-3">
                                  <i class="icon-envelope-o ms-1 h5 mb-0 second_color"></i>
                                  <span class="second_color">email@example.com</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </footer>
          ', 'type' => 'Footer', 'row_id' => '10.00', 'path' => '', 'created_at' => '2022-08-22 10:49:24', 'updated_at' => '2022-08-22 10:49:24'],
            ['id' => '4', 'title_ar' => 'First Navbar', 'title_en' => 'First Navbar', 'link' => 'navbar1', 'preview' => '<div class="them_1 py-2">
              <div class="container">
                  <div class="my_nav">
                      <div class="row align-items-center">
                          <div class="col-12 col-md-6 col-lg-3">
                              <div class="my-3">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                      <div class="new_logo point">
                                          <input type="file" name="logo" value="">
                                          <h3 class="fw-bold position-absolute main_color text-center">Logo</h3>
                                      </div>
                                      <div class="me-3">
                                          <h6 class="fw-bold mb-0">ثيم البحرين</h6>
                                          <span class="fw-bold more_small our_opacity">متعة التسوق</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-6 d-block d-md-none d-lg-block">
                              <div class="my-3">
                                  <div class="position-relative med_them my-3">
                                      <input type="text" name="search" value="" class="little_back border-0 rounded-pill w-100 px-5 py-3" placeholder="ابحث عن ما تريد">
                                      <button class="rounded-pill border-0 main_bt transition_me py-3 px-5 h5">بحث</button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-3">
                              <div class="my-3">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                      <div class="in_in">
                                          <a href="#" class="notification d-flex align-items-center justify-content-center">
                                              <i class="icon-heart-o"></i>
                                          </a>
                                      </div>
                                      <div class="in_in">
                                          <a href="#" class="notification">
                                              <i class="icon-bag"></i>
                                              <span class="badge">3</span>
                                          </a>
                                          <span class="fw-bold h6 mb-0 tiny_font">200.00 BHD</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 d-none d-md-block d-lg-none">
                              <div class="my-3">
                                  <div class="position-relative med_them my-3">
                                      <input type="text" name="search" value="" class="little_back border-0 rounded-pill w-100 px-5 py-3" placeholder="ابحث عن ما تريد">
                                      <button class="rounded-pill border-0 main_bt transition_me py-3 px-5 h5">بحث</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Navbar', 'row_id' => '1.50', 'path' => '', 'created_at' => '2022-08-22 10:50:13', 'updated_at' => '2022-08-22 10:50:13'],
            ['id' => '5', 'title_ar' => 'Second Navbar', 'title_en' => 'Second Navbar', 'link' => 'navbar2', 'preview' => '<div class="them_2 py-2">
              <div class="container">
                  <div class="my_nav">
                      <div class="row align-items-center">
                          <div class="col-12 col-md-6 col-lg">
                              <div class="my-3">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                      <div class="new_logo point">
                                          <input type="file" name="logo" value="">
                                          <h3 class="fw-bold position-absolute text-secondary text-center">Logo</h3>
                                      </div>
                                      <div class="me-3">
                                          <h6 class="fw-bold mb-0">ثيم البحرين</h6>
                                          <span class="fw-bold more_small our_opacity">متعة التسوق</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-lg-5 d-block d-md-none d-lg-block">
                              <div class="my-3">
                                  <div class="position-relative med_them my-3">
                                      <input type="text" name="search" value="" class="bg-light shadow border-0 rounded-pill w-100 px-5 py-3" placeholder="ابحث عن ما تريد">
                                      <button class="rounded-pill border-0 bg-secondary second_color transition_me py-3 px-5 h5">بحث</button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg">
                              <div class="my-3">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                                      <div class="in_in">
                                          <a href="#" class="notification d-flex align-items-center justify-content-center">
                                              <i class="icon-user-circle"></i>
                                          </a>
                                      </div>
                                      <div class="in_in">
                                          <a href="#" class="notification d-flex align-items-center justify-content-center">
                                              <i class="icon-heart-o"></i>
                                          </a>
                                      </div>
                                      <div class="in_in">
                                          <a href="#" class="notification">
                                              <i class="icon-bag"></i>
                                              <span class="badge">3</span>
                                          </a>
                                          <span class="fw-bold h6 mb-0 tiny_font">200.00 BHD</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12 d-none d-md-block d-lg-none">
                              <div class="my-3">
                                  <div class="position-relative med_them my-3">
                                      <input type="text" name="search" value="" class="little_back border-0 rounded-pill w-100 px-5 py-3" placeholder="ابحث عن ما تريد">
                                      <button class="rounded-pill border-0 secondary-bg second_color transition_me py-3 px-5 h5">بحث</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Navbar', 'row_id' => '1.50', 'path' => '', 'created_at' => '2022-08-22 10:50:37', 'updated_at' => '2022-08-22 10:50:37'],
            ['id' => '6', 'title_ar' => 'Third Navbar', 'title_en' => 'Third Navbar', 'link' => 'navbar3', 'preview' => '<style>
              /*start navbar*/
              .hover_in {
                  position: absolute;
                  width: 250px;
                  top: 40px;
                  background: var(--main--color);
                  box-shadow: 0 0.5rem 3rem rgba(0, 0, 0, 0.4) !important;
              }

              .nav_line_link {
                  color: #FFF;
                  font-weight: 700;
                  transition: 0.5s;
              }

              .nav_line_link:hover {
                  color: #000;
                  transition: 0.5s;
              }

              .hover_block {
                  display: none
              }

              .new_logo {
                  width: 70px;
                  height: 70px;
                  background-color: var(--back--color);
                  border-radius: 50%;
                  overflow: hidden;
                  display: flex;
                  cursor: pointer;
                  align-items: center;
                  justify-content: center;
              }

              .new_logo {
                  background-color: #DDD;
              }

              .new_logo input {
                  opacity: 0;
                  z-index: 5;
                  height: 100%;
                  cursor: pointer;
              }
          </style>
          <div class="nav_bar py-2 main_bg">

              <div class="container">

                  <div class="row align-items-center">
                      <div class="col-12 col-md-12 col-lg-4">
                          <div class="d-flex justify-content-between align-items-center my-3">

                              <div class="position-relative">

                                  <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out">متجر</a>

                                  <div class="hover_in p-2 index_over hover_block">
                                      <ul class="list-unstyled p-0">
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">جميع المنتجات</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">العناية بالأظافر</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">طلاء الأظافر</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">أدوات مانيكير</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">العناية باليدين</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">العناية بالعيون</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">جمال العيون</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">عناية بالجلد</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">بشرة</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">الشعر والجسم</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">طقم هدايا</a></li>
                                      </ul>
                                  </div>

                              </div>
                              <div class="position-relative">

                                  <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out">نصائح</a>

                                  <div class="hover_in p-2 index_over hover_block">
                                      <ul class="list-unstyled p-0">
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">فئات التشريح</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">وكالة الجمال</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">تقنيات التجميل</a></li>
                                          <li class="p-2"><a href="#" class="text-decoration-none nav_line_link transition-me w-100">مباراة اللون</a></li>
                                      </ul>
                                  </div>

                              </div>

                              <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out">مقالات</a>


                          </div>
                      </div>
                      <div class="col-12 col-md-12 col-lg-4">
                          <div class="d-flex align-items-center justify-content-center my-3">
                              <div class="new_logo point">
                                  <input type="file" name="logo" value="">
                                  <h3 class="fw-bold position-absolute main_color text-center">Logo</h3>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-12 col-lg-4">
                          <div class="d-flex justify-content-between align-items-center my-3">
                              <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out">موقع المتجر</a>
                              <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out">بحث</a>
                              <a href="#" class="text-decoration-none nav_line_link transition-me font-weight-bold hover_out my_account">حسابي</a>
                          </div>
                      </div>
                  </div>

              </div>

          </div>
          ', 'type' => 'Navbar', 'row_id' => '1.50', 'path' => '', 'created_at' => '2022-08-22 10:51:07', 'updated_at' => '2022-08-22 10:51:07'],
            ['id' => '7', 'title_ar' => 'First Slider', 'title_en' => 'First Slider', 'link' => 'slider1', 'preview' => '<div class="slider_one">
              <div class="container">
                  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                      </div>
                      <div class="carousel-inner">
                          <div class="carousel-item">
                              <div class="row align-items-center landing">
                                  <div class="col-12 col-md-6">
                                      <div class="text text-center py-4 point">
                                          <h1 class="second_color fw-bold">اقوى عروض الصيف</h1>
                                          <h2 class="second_color my-3">خصومات تصل حتى </h2>
                                          <h1 class="second_color display-4 fw-bold">% 40</h1>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 d-none d-md-block">
                                      <div class="image">
                                          <img src="/assets/img/Layer 4.png" class="img-fluid" alt="image">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="carousel-item active">
                              <div class="row align-items-center landing">
                                  <div class="col-12 col-md-6">
                                      <div class="text text-center py-4">
                                          <h1 class="second_color fw-bold">اقوى عروض الصيف</h1>
                                          <h2 class="second_color my-3">خصومات تصل حتى </h2>
                                          <h1 class="second_color display-4 fw-bold">% 40</h1>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 d-none d-md-block">
                                      <div class="image">
                                          <img src="/assets/img/Layer 4.png" class="img-fluid" alt="image">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Slider', 'row_id' => '2.00', 'path' => '', 'created_at' => '2022-08-22 10:51:45', 'updated_at' => '2022-08-22 10:51:45'],
            ['id' => '8', 'title_ar' => 'Second Slider', 'title_en' => 'Second Slider', 'link' => 'slider2', 'preview' => '<div class="container">
              <div class="slider_one">
                  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
                      </div>
                      <div class="carousel-inner">
                          <div class="carousel-item">
                              <div class="row align-items-center landing">
                                  <div class="col-12 col-md-6">
                                      <div class="text text-center py-4 point">
                                          <h1 class="second_color fw-bold">اقوى عروض الصيف</h1>
                                          <h2 class="second_color my-3">خصومات تصل حتى </h2>
                                          <h1 class="second_color display-4 fw-bold">% 40</h1>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 d-none d-md-block">
                                      <div class="image">
                                          <img src="/assets/img/Layer 4.png" class="img-fluid" alt="image">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="carousel-item active">
                              <div class="row align-items-center landing">
                                  <div class="col-12 col-md-6">
                                      <div class="text text-center py-4">
                                          <h1 class="second_color fw-bold">اقوى عروض الصيف</h1>
                                          <h2 class="second_color my-3">خصومات تصل حتى </h2>
                                          <h1 class="second_color display-4 fw-bold">% 40</h1>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 d-none d-md-block">
                                      <div class="image">
                                          <img src="/assets/img/Layer 4.png" class="img-fluid" alt="image">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Slider', 'row_id' => '2.00', 'path' => '', 'created_at' => '2022-08-22 10:52:07', 'updated_at' => '2022-08-22 10:52:07'],
            ['id' => '9', 'title_ar' => 'Third Slider', 'title_en' => 'Third Slider', 'link' => 'slider3', 'preview' => '<div class="slider_three my-5">
              <div class="container">
                  <div class="options">
                      <div class="option active" style="Background:url(\'/assets/img/blue-background.webp\'); background-size: cover;">
                          <div class="shadow"></div>
                          <div class="label">
                              <div class="info">
                                  <div class="main">Blonkisoaz</div>
                                  <div class="sub">Omuke trughte a otufta</div>
                              </div>
                          </div>
                      </div>
                      <div class="option" style="Background:url(\'/assets/img/blue-background_2.webp\'); background-size: cover;">
                          <div class="shadow"></div>
                          <div class="label">
                              <div class="info">
                                  <div class="main h2 mb-0">Oretemauw</div>
                                  <div class="sub">Omuke trughte a otufta</div>
                              </div>
                          </div>
                      </div>
                      <div class="option" style="--optionBackground:url(https://66.media.tumblr.com/5af3f8303456e376ceda1517553ba786/tumblr_o4986gakjh1qho82wo1_1280.jpg);">
                          <div class="shadow"></div>
                          <div class="label">
                              <div class="info">
                                  <div class="main">Iteresuselle</div>
                                  <div class="sub">Omuke trughte a otufta</div>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          ', 'type' => 'Slider', 'row_id' => '2.00', 'path' => '', 'created_at' => '2022-08-22 10:52:33', 'updated_at' => '2022-08-22 10:52:33'],
            ['id' => '10', 'title_ar' => 'First Upperbar', 'title_en' => 'First Upperbar', 'link' => 'upperbar1', 'preview' => '<div class="upper_1 py-3">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-12 col-md-6">
                          <div class="row align-items-center justify-content-center justify-content-md-between justify-content-lg-start my-2">
                              <div class="col-12 col-md-6 px-0">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start my-1">
                                      <i class="icon-envelope-o ms-1 h5 mb-0"></i>
                                      <span>email@example.com</span>
                                  </div>
                              </div>
                              <div class="col-12 col-md-6 px-0">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start my-1">
                                      <i class="icon-mobile ms-1 h5 mb-0"></i>
                                      <span>999 8751 54138</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          <div class="d-flex align-items-center justify-content-center justify-content-md-end my-2">
                              <div class="ms-4">
                                  <div class="dropdown">
                                      <button class="little_back border-0 rounded-pill dropdown-toggle px-3 py-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          <img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> BHD
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a class="dropdown-item d-flex align-items-center justify-content-around" href="#"><img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> <span>BHD</span></a></li>
                                          <li><a class="dropdown-item d-flex align-items-center justify-content-around" href="#"><img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> <span>BHD</span></a></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="">
                                  <button class="little_back rounded-pill border-0 px-3 d-flex align-items-center justify-content-around py-2"><i class="icon-user-circle main_color ms-2"></i><span class="fw-bold">تسجيل الدخول</span></button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Upperbar', 'row_id' => '1.00', 'path' => '', 'created_at' => '2022-08-22 10:53:32', 'updated_at' => '2022-08-22 10:53:32'],
            ['id' => '11', 'title_ar' => 'Second Upperbar', 'title_en' => 'Second Upperbar', 'link' => 'upperbar2', 'preview' => '<div class="upper_2 py-3 third_bg" style="display: block;">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-12 col-md-12 col-lg-4">
                          <ul class="mb-0 list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start pe-0">
                              <li class="ms-4 in_up">
                                  <a href="#" class="text-decoration-none transition_me h5 mb-0"><i class="icon-facebook1"></i></a>
                              </li>
                              <li class="ms-4 in_up">
                                  <a href="#" class="text-decoration-none transition_me h5 mb-0"><i class="icon-twitter"></i></a>
                              </li>
                              <li class="ms-4 in_up">
                                  <a href="#" class="text-decoration-none transition_me h5 mb-0"><i class="icon-instagram1"></i></a>
                              </li>
                              <li class="ms-4 in_up">
                                  <a href="#" class="text-decoration-none transition_me h5 mb-0"><i class="icon-pinterest-p"></i></a>
                              </li>
                          </ul>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="row align-items-center justify-content-center justify-content-md-between justify-content-lg-start my-2 second_color">
                              <div class="col-12 col-md-6 px-0">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start my-1">
                                      <i class="icon-envelope-o ms-1 h5 mb-0"></i>
                                      <span>email@example.com</span>
                                  </div>
                              </div>
                              <div class="col-12 col-md-6 px-0">
                                  <div class="d-flex align-items-center justify-content-center justify-content-md-start my-1">
                                      <i class="icon-mobile ms-1 h5 mb-0"></i>
                                      <span>999 8751 54138</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="d-flex align-items-center justify-content-center justify-content-md-end my-2">
                              <div class="ms-4">
                                  <div class="dropdown">
                                      <button class="second_bg border-0 rounded-pill dropdown-toggle px-3 py-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          <img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> BHD
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a class="dropdown-item d-flex align-items-center justify-content-around" href="#"><img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> <span>BHD</span></a></li>
                                          <li><a class="dropdown-item d-flex align-items-center justify-content-around" href="#"><img src="../assets/img/flag-for-flag-bahrain-svgrepo-com.jpg" class="img-fluid" alt="image"> <span>BHD</span></a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Upperbar', 'row_id' => '1.00', 'path' => '', 'created_at' => '2022-08-22 10:53:59', 'updated_at' => '2022-08-22 10:53:59'],
            ['id' => '12', 'title_ar' => 'First Copyright', 'title_en' => 'First Copyright', 'link' => 'copyright1', 'preview' => '<div class="copyright">
              Copyright © 2021 Matjr - All rights reserved
          </div>
          ', 'type' => 'Copyright', 'row_id' => '100.00', 'path' => '', 'created_at' => '2022-08-22 10:49:24', 'updated_at' => '2022-08-22 10:49:24'],
            ['id' => '13', 'title_ar' => 'First Category', 'title_en' => 'First Category', 'link' => 'category1', 'preview' => '<div class="categories my-4">
              <div class="container">
                  <div class="row">
                      <div class="col-12 col-md-4 col-lg-3">
                          <div class="">
                              <h4 class="main_bold py-3 main_color">الاقسام</h4>
                              <div class="row">
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>هواتف ذكية</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>اكسسوارات هواتف</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>مكياج واكسسوارات</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>احذية</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>العاب كمبيوتر</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>صبغات شعر</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>محافظ وشنط</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>ملابس</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>اطفال</label>
                                      </div>
                                  </div>
                              </div>
                              <h4 class="main_bold py-3">الاختيار حسب اللون</h4>
                              <div class="row">
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>ازرق</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>اخضر</label>
                                      </div>
                                  </div>
                                  <div class="col-6 col-md-12">
                                      <div class="my-3">
                                          <input class="form-check-input ms-3" type="checkbox" value="">
                                          <label>احمر</label>
                                      </div>
                                  </div>
                              </div>

                              <div class="my-4">
                                  <p>
                                      <label for="amount" class="main_bold h4">Sort by price</label>
                                      <input type="text" id="amount" readonly="" style="border:0; font-weight:bold;">
                                  </p>

                                  <div class="py-3">
                                      <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 24.5%; width: 38.8%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 24.5%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 63.3%;"></span></div>
                                  </div>

                              </div>

                          </div>
                      </div>
                      <div class="col-12 col-md-8 col-lg-9">
                          <div class="mt-4">
                              <div class="d-flex justify-content-end py-4">
                                  <div class="dropdown">
                                      <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                          الترتيب حسب
                                      </button>
                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a class="dropdown-item" href="#">الأقل سعرا</a></li>
                                          <li><a class="dropdown-item" href="#">الأكثر سعرا</a></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                                  <div class="col-12 col-md-6 col-lg-4">
                                      <div class="my_last_offer mb-4 in_offer">
                                          <div class="rival_2">
                                              <span>جديد<span>
                                          </span></span></div>
                                          <div class="text-center my-3">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                          </div>
                                          <div class="details">
                                              <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                              <span class="fw-bold main_color">60 <span>BHD</span></span>
                                          </div>
                                          <div class="mt-2 d-flex justify-content-center">
                                              <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                          </div>
                                          <span class="my_border one"></span>
                                          <span class="my_border two"></span>
                                          <span class="my_border three"></span>
                                          <span class="my_border four"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Category', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '14', 'title_ar' => 'Second Category', 'title_en' => 'Second Category', 'link' => 'category2', 'preview' => '<div class="special_offer_two course my-5" style="display: block;">
              <div class="container">
                  <div class="d-flex justify-content-end pb-4">
                      <div class="dropdown">
                          <button class="main_bt transition_me border-0 rounded py-2 fw-bold px-4 sort dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              الترتيب حسب
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                              <li><a class="dropdown-item" href="#">الأقل سعرا</a></li>
                              <li><a class="dropdown-item" href="#">الأكثر سعرا</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="our_more">
                      <ul class="nav nav-pills mb-4 px-0" id="pills-tab" role="tablist">
                          <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">هواتف ذكية</button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">اكسسوارات هواتف</button>
                          </li>
                          <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">مكياج واكسسوارات</button>
                          </li>
                      </ul>
                      <div class="tab-content" id="pills-tabContent">

                          <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <div class="special_offer_two my-3">
                                  <div class="row">
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                              <div class="special_offer_two my-3">
                                  <div class="row">
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                              <div class="special_offer_two my-3">
                                  <div class="row">
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-4 col-lg-3">
                                          <div class="my_last_offer mb-4 in_offer">
                                              <div class="rival_2">
                                                  <span>جديد<span>
                                              </span></span></div>
                                              <div class="text-center my-3">
                                                  <img src="/assets/img/iPhone-13-PNG-HD.png" class="" alt="image">
                                              </div>
                                              <div class="details">
                                                  <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                  <span class="fw-bold main_color">60 <span>BHD</span></span>
                                              </div>
                                              <div class="mt-2 d-flex justify-content-center">
                                                  <button class="main_bt border-0 rounded-pill h5 w-100 transition_me py-2 m-2">Add to Cart</button>
                                              </div>
                                              <span class="my_border one"></span>
                                              <span class="my_border two"></span>
                                              <span class="my_border three"></span>
                                              <span class="my_border four"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Category', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '15', 'title_ar' => 'Third Category', 'title_en' => 'Third Category', 'link' => 'category3', 'preview' => '<div class="category_three">
              <div class="container">
                  <div class="title_top py-5">
                      <h2>الأقسام</h2>
                  </div>
                  <div class="row py-3 top_cat_bt">
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="all" class="bt_cat">كل المنتجات</button>
                          </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="phone" class="bt_cat">هواتف</button>
                          </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="makeup" class="bt_cat">مكياج</button>
                          </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="games" class="bt_cat">العاب</button>
                          </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="bags" class="bt_cat">حقائب</button>
                          </div>
                      </div>
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="my-3">
                              <button id="shoes" class="bt_cat">احذية</button>
                          </div>
                      </div>
                  </div>
                  <div class="row posts">
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post phone" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post makeup" style="">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post phone" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post games" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post phone" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post phone" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post bags" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4 post bags" style="display: none;">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Category', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '16', 'title_ar' => 'Third Category Page', 'title_en' => 'Third Category Page', 'link' => 'category3', 'preview' => '<div class="department my-5">
              <div class="container">
                  <div class="title_top py-4">
                      <h2>اقسام المتجر</h2>
                  </div>

                  <div class="offers my-5">
                      <div class="">
                          <div class="row">
                              <div class="col-12 col-md-6 p-0">
                                  <div class="cart_offer point position-relative">
                                      <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (11).png" class="img-fluid w-100 transition-me" alt="offers">
                                      <div class="layout h-100 w-100 position-absolute p-3">
                                          <h1 class="text-white p-3 font-weight-bold display-2">
                                              <span class="d-block">Nail</span>
                                              <span class="d-block">Care</span>
                                          </h1>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12 col-md-6 p-0">
                                  <div class="row h-100">
                                      <div class="col-6 p-0">
                                          <div class="cart_offer point position-relative">
                                              <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (12).png" class="img-fluid transition-me" alt="offers">
                                              <div class="layout h-100 w-100 position-absolute p-3">
                                                  <h2 class="text-white p-3 font-weight-bold">
                                                      <span class="d-block">Eye</span>
                                                      <span class="d-block">Care</span>
                                                  </h2>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-6 p-0">
                                          <div class="cart_offer point position-relative">
                                              <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (13).png" class="img-fluid transition-me" alt="offers">
                                              <div class="layout h-100 w-100 position-absolute p-3">
                                                  <h2 class="text-white p-3 font-weight-bold">
                                                      <span class="d-block">Lips</span>
                                                      <span class="d-block">Care</span>
                                                  </h2>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-6 p-0">
                                          <div class="cart_offer point position-relative">
                                              <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (14).png" class="img-fluid transition-me" alt="offers">
                                              <div class="layout h-100 w-100 position-absolute p-3">
                                                  <h2 class="text-white p-3 font-weight-bold">
                                                      <span class="d-block">Skin</span>
                                                      <span class="d-block">Care</span>
                                                  </h2>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-6 p-0">
                                          <div class="cart_offer point position-relative">
                                              <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (16).png" class="img-fluid transition-me" alt="offers">
                                              <div class="layout h-100 w-100 position-absolute p-3">
                                                  <h2 class="text-white p-3 font-weight-bold">
                                                      <span class="d-block">Feets &amp; Legs</span>
                                                      <span class="d-block">Care</span>
                                                  </h2>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12 col-md-4 p-0">
                                  <div class="cart_offer point position-relative">
                                      <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (18).png" class="img-fluid w-100 transition-me" alt="offers">
                                      <div class="layout h-100 w-100 position-absolute p-3">
                                          <h2 class="text-white p-3 font-weight-bold">
                                              <span class="d-block">Makeup</span>
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12 col-md-4 p-0">
                                  <div class="cart_offer point position-relative">
                                      <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (15).png" class="img-fluid w-100 transition-me" alt="offers">
                                      <div class="layout h-100 w-100 position-absolute p-3">
                                          <h2 class="text-white p-3 font-weight-bold">
                                              <span class="d-block">Mavala Special Gift Bags</span>
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12 col-md-4 p-0">
                                  <div class="cart_offer point position-relative">
                                      <img src="/assets/img/urn_aaid_sc_US_043bf700-aa6d-4414-9c17-f78ece221c72 (17).png" class="img-fluid w-100 transition-me" alt="offers">
                                      <div class="layout h-100 w-100 position-absolute p-3">
                                          <h2 class="text-white p-3 font-weight-bold">
                                              <span class="d-block">Hands</span>
                                              <span class="d-block">Care</span>
                                          </h2>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>
          ', 'type' => 'HomeCategory', 'row_id' => '5.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '17', 'title_ar' => 'Second Category Page', 'title_en' => 'Second Category Page', 'link' => 'category2', 'preview' => '<div class="store_department my-5" style="display: block;">
              <div class="container">
                  <div class="py-4">
                      <h5 class="fw-bold">اقسام المتجر</h5>
                  </div>
                  <div class="store_them_one">
                      <div class="row">
                          <div class="col-12 col-md-6 col-lg-4">
                              <div class="store my-4">
                                  <img src="/assets/img/affordable-shoe-brands-for-women-282829-1570474111839-main.700x0c.jpg" class="img-fluid w-100" alt="image">
                                  <div class="in_store">
                                      <h5>احذية</h5>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4">
                              <div class="store my-4">
                                  <img src="/assets/img/intro.jpg" class="img-fluid w-100" alt="image">
                                  <div class="in_store">
                                      <h5>ملابس</h5>
                                  </div>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-4">
                              <div class="store my-4">
                                  <img src="/assets/img/cee1724ec698f7bc0a9dfb53d0bcadf9.jpg" class="img-fluid w-100" alt="image">
                                  <div class="in_store">
                                      <h5>اكسسوارات</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'HomeCategory', 'row_id' => '5.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '18', 'title_ar' => 'First Category Page', 'title_en' => 'First Category Page', 'link' => 'category1', 'preview' => '<div class="store_department my-5">
              <div class="container">
                  <div class="py-4">
                      <h5 class="fw-bold">اقسام المتجر</h5>
                  </div>
                  <div class="store_them_two">
                      <div class="row">
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/mobile-app.png" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">هواتف</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/monitor.png" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">لابتوب</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/dress.png" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">ملابس</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/running-shoes.png" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">احذية</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/pijama (2ng" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">أطفال</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-2">
                              <div class="store">
                                  <img src="/assets/img/handbag.png" class="img-fluid" alt="image">
                                  <h5 class="fw-bold">حقائب</h5>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'HomeCategory', 'row_id' => '5.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '19', 'title_ar' => 'First Login Page', 'title_en' => 'First Login Page', 'link' => 'login1', 'preview' => '<div class="sign_login" style="direction: ltr;">
              <div class="container right-panel-active">
                  <!-- Sign Up -->
                  <div class="container__form container--signup">
                      <form action="#" class="form" id="form1">
                          <h2 class="form__title">Sign Up</h2>
                          <input type="text" placeholder="User" class="input">
                          <input type="email" placeholder="Email" class="input">
                          <input type="password" placeholder="Password" class="input">
                          <button class="btn">Sign Up</button>
                      </form>
                  </div>

                  <!-- Sign In -->
                  <div class="container__form container--signin">
                      <form action="#" class="form" id="form2">
                          <h2 class="form__title">Sign In</h2>
                          <input type="email" placeholder="Email" class="input">
                          <input type="password" placeholder="Password" class="input">
                          <a href="#" class="link">Forgot your password?</a>
                          <button class="btn">Sign In</button>
                      </form>
                  </div>

                  <!-- Overlay -->
                  <div class="container__overlay">
                      <div class="overlay">
                          <div class="overlay__panel overlay--left">
                              <button class="btn" id="signIn">Sign In</button>
                          </div>
                          <div class="overlay__panel overlay--right">
                              <button class="btn" id="signUp">Sign Up</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Login', 'row_id' => '4.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '20', 'title_ar' => 'Second Login Page', 'title_en' => 'Second Login Page', 'link' => 'login2', 'preview' => '<div class="container py-5">
              <div class="d-flex justify-content-around">
                  <div class="my-4">
                      <button class="main_bt transition_me border-0 px-5 py-2 login">login</button>
                      <div class="popup" id="log_in" style="display: none;">
                          <div class="d-flex justify-content-center align-items-center h-100">
                              <div class="insert_2 text-center bg-white d-flex justify-content-center align-items-center p-4">
                                  <div class="text-center w-100 h-100">
                                      <img src="/assets/img/Mask Group 4.png" class="img-fluid" alt="image">
                                      <h5 class="my-3">LOG IN TO YOUR PROFILE</h5>
                                      <div class="my-4">
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="Mobile">
                                              <i class="icon-mobile main_color h3 position-absolute"></i>
                                          </div>
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="Password">
                                              <i class="icon-lock main_color h3 position-absolute"></i>
                                          </div>
                                      </div>
                                      <a href="#" class="text-decoration-none main_link fw-bold transition_me">? Forget Password</a>
                                      <div class="d-flex justify-content-center my-3">
                                          <button class="main_bt main_border main_bold py-2 px-5 rounded transition_me main_bold">Log In</button>
                                      </div>
                                      <p>Dont have an account yet ? <a href="#" class="text-decoration-none main_link transition_me mx-2">Sign Up</a></p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="my-4">
                      <button class="main_bt transition_me border-0 px-5 py-2 signup">sign up</button>
                      <div class="popup" id="sign_up" style="display: none;">
                          <div class="d-flex justify-content-center align-items-center h-100">
                              <div class="insert_2 text-center bg-white d-flex justify-content-center align-items-center p-4">
                                  <div class="text-center w-100 h-100">
                                      <img src="/assets/img/Mask Group 4.png" class="img-fluid" alt="image">
                                      <h5 class="my-3">SIGN UP TO YOUR PROFILE</h5>
                                      <div class="my-4">
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="Mobile">
                                              <i class="icon-mobile main_color h3 position-absolute"></i>
                                          </div>
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="First Name">
                                              <i class="icon-user main_color h3 position-absolute"></i>
                                          </div>
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="Last Name">
                                              <i class="icon-user main_color h3 position-absolute"></i>
                                          </div>
                                          <div class="position-relative">
                                              <input type="text" class="w-100 shadow my-2 px-5 py-3 border-0" placeholder="Password">
                                              <i class="icon-lock main_color h3 position-absolute"></i>
                                          </div>
                                      </div>
                                      <div class="d-flex justify-content-center my-3">
                                          <button class="main_bt main_border main_bold py-2 px-5 rounded transition_me main_bold">Sign Up</button>
                                      </div>
                                      <p>Dont have an account yet ? <a href="#" class="text-decoration-none main_link transition_me mx-2">Log In</a></p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Login', 'row_id' => '4.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '21', 'title_ar' => 'First Most Selling', 'title_en' => 'First Most Selling', 'link' => 'mostselling1', 'preview' => '<div class="_most__selling">
              <div class="container">
                  <div class="title_top py-4">
                      <h2>الأكثر مبيعا</h2>
                  </div>

                  <div class="row py-5">
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <figure class="snip1249 point my-4">
                              <div class="image text-center">
                                  <img src="/assets/img/iPhone-13-PNG-HD.png" alt="sample90"><i class="icon-price-tags h3 point"></i>
                              </div>
                              <figcaption>
                                  <h4 class="fw-bold">iPhone 13 pro</h4>
                                  <p>How many boards would the Mongols hoard if the Mongol hordes got bored?</p>
                                  <div class="price">
                                      <s>$19.00</s>$14.00
                                  </div>
                                  <a href="#" class="add-to-cart">Add to Cart</a>
                              </figcaption>
                          </figure>
                      </div>
                  </div>

              </div>
          </div>
          ', 'type' => 'MostSelling', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '22', 'title_ar' => 'Second Most Selling', 'title_en' => 'Second Most Selling', 'link' => 'mostselling2', 'preview' => '<div class="selling">
              <div class="container">

                  <!-- start section them two -->

                  <div class="section_them_two my-5">
                      <div class="row align-items-center justify-content-start py-4">
                          <div class="col-12 col-md-3 col-lg-3">
                              <div class="py-1 my_border_right my-4">
                                  <h5 class="fw-bold mb-0 pe-4 main_color">الأكثر مبيعا</h5>
                              </div>
                          </div>
                          <div class="col-12 col-md-9 col-lg-9 d-none d-lg-block">
                              <hr>
                          </div>
                      </div>

                      <!-- start in large screen -->
                      <div class="my-4 in_section d-none d-md-none d-lg-block">
                          <div id="carouselExampleControls_tow_lg" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <div class="row">
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="carousel-item">
                                      <div class="row">
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-12 col-md-6 col-lg-3">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_tow_lg" data-bs-slide="next">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-left"></i>
                                      </div>
                                  </button>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_tow_lg" data-bs-slide="prev">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-right"></i>
                                      </div>
                                  </button>
                              </div>
                          </div>
                      </div>

                      <!-- start in md screen -->
                      <div class="my-4 in_section d-none d-md-block d-lg-none">
                          <div id="carouselExampleControls_md_two" class="carousel slide px-4" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <div class="row">
                                          <div class="col-12 col-md-6">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_md_two" data-bs-slide="next">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-right"></i>
                                      </div>
                                  </button>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_md_two" data-bs-slide="prev">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-left"></i>
                                      </div>
                                  </button>
                              </div>
                          </div>
                      </div>

                      <!-- start in sm screen -->
                      <div class="my-4 in_section d-block d-md-none d-lg-none">
                          <div id="carouselExampleControls_sm_two" class="carousel slide px-5" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="carousel-item">
                                      <div class="row">
                                          <div class="col-12">
                                              <div class="my_last_offer mb-4 in_offer">
                                                  <div class="rival_2">
                                                      <span>جديد<span>
                                                  </span></span></div>
                                                  <div class="text-center my-3">
                                                      <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="image">
                                                  </div>
                                                  <div class="details">
                                                      <h6 class="fw-bolder">iPhone - ايفون 11</h6>
                                                      <div class="d-flex align-items-center justify-content-between">
                                                          <span class="fw-bold main_color">60 <span>BHD</span></span>
                                                          <span class="our_opacity text-secondary h5 mb-0">
                                                              | <i class="icon-cart point mx-2"></i>
                                                          </span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_sm_two" data-bs-slide="next">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-right"></i>
                                      </div>
                                  </button>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_sm_two" data-bs-slide="prev">
                                      <div class="my_arrow">
                                          <i class="icon-cheveron-left"></i>
                                      </div>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'MostSelling', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '23', 'title_ar' => 'Third Most Selling', 'title_en' => 'Third Most Selling', 'link' => 'mostselling3', 'preview' => '<div class="section_four" style="display: block;">
              <div class="container">
                  <div class="row align-items-center justify-content-center">
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="m-4">
                              <div class="py-1 my_border_right my-5">
                                  <h5 class="fw-bold mb-0 pe-4 main_color">مستحضرات تجميل</h5>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="m-4">
                              <div class="py-1 my_border_right my-5">
                                  <h5 class="fw-bold mb-0 pe-4 main_color">ملابس</h5>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="m-4">
                              <div class="py-1 my_border_right my-5">
                                  <h5 class="fw-bold mb-0 pe-4 main_color">لابتوب</h5>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="in_details d-flex align-items-center justify-content-around my-4 p-3">
                                  <img src="/assets/img/61F7c4q8TNL - Copy.png" class="img-fluid" alt="image">
                                  <div class="">
                                      <h6 class="fw-bold mb-0">شامبو لوريال</h6>
                                      <div class="d-flex align-items-center justify-content-between w-100">
                                          <span class="fw-bold main_color ms-3">60 <span>BHD</span></span>
                                          <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'MostSelling', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '27', 'title_ar' => 'Offer Component', 'title_en' => 'Offer Component', 'link' => 'offers1', 'preview' => '<div class="special_offer_two my-5" style="display: block;">
              <div class="container">
                  <div class="row py-1 my_border_right my-5">
                      <h5 class="fw-bold mb-0 pe-4 main_color">عروض خاصة</h5>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="my_last_offer my-4 in_offer">
                              <div class="rival">
                                  <span>خصم 20%</span>
                              </div>
                              <div class="pt-4">
                                  <img src="/assets/img/iPhone-13-PNG-HD.jpg" class="img-fluid d-block" alt="image">
                              </div>
                              <div class="details">
                                  <h6 class="fw-bolder main_color">iPhone - ايفون 11</h6>
                                  <div class="d-flex align-items-center justify-content-between my-3" style="width: 35%;">
                                      <span class="fw-bold main_color">60 <span>BHD</span></span>
                                      <span class="fw-bold text-decoration-through text-secondary our_opacity"><del>80 <span>BHD</span></del></span>
                                  </div>
                                  <div class="d-flex align-items-center justify-content-between py-1">
                                      <div class="time">
                                          <span>12 ثانية</span>
                                      </div>
                                      <div class="time">
                                          <span>01 دقيقة</span>
                                      </div>
                                      <div class="time">
                                          <span>52 ساعة</span>
                                      </div>
                                      <div class="time">
                                          <span>10 يوم</span>
                                      </div>
                                  </div>
                              </div>
                              <span class="my_border one"></span>
                              <span class="my_border two"></span>
                              <span class="my_border three"></span>
                              <span class="my_border four"></span>
                          </div>
                      </div>

                  </div>
              </div>
          </div>', 'type' => 'Offer', 'row_id' => '6.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '28', 'title_ar' => 'First Product', 'title_en' => 'First Product', 'link' => 'product1', 'preview' => '<style>
              /*start navbar*/
              .hover_in {
                  position: absolute;
                  width: 250px;
                  top: 40px;
                  background: var(--main--color);
                  box-shadow: 0 0.5rem 3rem rgba(0, 0, 0, 0.4) !important;
              }

              .nav_line_link {
                  color: #FFF;
                  font-weight: 700;
                  transition: 0.5s;
              }

              .nav_line_link:hover {
                  color: #000;
                  transition: 0.5s;
              }

              .hover_block {
                  display: none
              }

              .new_logo {
                  width: 70px;
                  height: 70px;
                  background-color: var(--back--color);
                  border-radius: 50%;
                  overflow: hidden;
                  display: flex;
                  cursor: pointer;
                  align-items: center;
                  justify-content: center;
              }

              .new_logo {
                  background-color: #DDD;
              }

              .new_logo input {
                  opacity: 0;
                  z-index: 5;
                  height: 100%;
                  cursor: pointer;
              }
          </style>

          <div class="details_three">

              <div class="wrap" data-pos="0">
                  <div class="wrap-clip"></div>
                  <div class="content">
                      <div class="bar">
                          <div class="cart">
                              <i class="icon-opencart"></i>
                              <div class="badge"><span>3</span></div>
                          </div>
                          <a href="javascript:void(0)">
                              <img src="https://dl.dropbox.com/s/5nhxsba4lsb1h3g/shoe-black.png" alt="shoe-black">
                          </a>
                          <a href="javascript:void(0)">
                              <img src="https://dl.dropbox.com/s/502qoc9qv6uqrve/shoe-red.png" alt="shoe-red">
                          </a>
                          <a href="javascript:void(0)">
                              <img src="https://dl.dropbox.com/s/znovc1vt9dvfskg/shoe-grey.png" alt="shoe-grey">
                          </a>
                      </div>
                      <div class="products">
                          <div class="products-wrap">
                              <div class="item">
                                  <div class="title">BLACK</div>
                                  <div class="image">
                                      <img src="https://dl.dropbox.com/s/5nhxsba4lsb1h3g/shoe-black.png" class="shoe">
                                  </div>
                                  <div class="info">
                                      <h2>BLACK SHOE</h2>
                                      <h3>$ 225</h3>
                                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor Aenean massa. </p>
                                      <p> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                      <button class="btn" type="button">
                                          <span><i class="icon-opencart me-5"></i> ADD TO CART</span>
                                      </button>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="title">RED</div>
                                  <div class="image">
                                      <img src="https://dl.dropbox.com/s/502qoc9qv6uqrve/shoe-red.png" class="shoe">
                                  </div>
                                  <div class="info">
                                      <h2>RED SHOE</h2>
                                      <h3>$ 235</h3>
                                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor Aenean massa. </p>
                                      <p> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                      <button class="btn" type="button">
                                          <span><i class="icon-opencart me-5"></i> ADD TO CART</span>
                                      </button>
                                  </div>
                              </div>
                              <div class="item">
                                  <div class="title">GRAY</div>
                                  <div class="image">
                                      <img src="https://dl.dropbox.com/s/znovc1vt9dvfskg/shoe-grey.png" class="shoe">
                                  </div>
                                  <div class="info">
                                      <h2>GRAY SHOE</h2>
                                      <h3>$ 200</h3>
                                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor Aenean massa. </p>
                                      <p> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                      <button class="btn" type="button">
                                          <span><i class="icon-opencart me-5"></i> ADD TO CART</span>
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
          ', 'type' => 'Product', 'row_id' => '7.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '29', 'title_ar' => 'Second Product', 'title_en' => 'Second Product', 'link' => 'product2', 'preview' => '<div class="sweat product_sweat my-4">
              <div class="container">

                  <div class="row">
                      <div class="col-12 col-md-2">
                          <div class="my-3">
                              <h4 class="more_bold pb-1">الاقسام</h4>
                              <div class="cate_change">
                                  <h6 class="my-3 more_bold main_link transition_me point active">الكل</h6>
                                  <h6 class="my-3 more_bold main_link transition_me point">الهواتف</h6>
                                  <h6 class="my-3 more_bold main_link transition_me point">الاحذية</h6>
                                  <h6 class="my-3 more_bold main_link transition_me point">الملابس</h6>
                                  <h6 class="my-3 more_bold main_link transition_me point">الميكب والاكييوار</h6>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-5">
                          <div class="">
                          <div class="gallery">
                                  <div class="container">
                                      <div class="master-img text-center little_back p-5">
                                          <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="coffee">
                                      </div>
                                      <div class="thumbnails d-flex justify-content-between py-3">
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-5">
                          <div class="">
                              <div class="d-flex justify-content-between my-3">
                                  <h5 class="more_bold point">IPhone 13 pro</h5>
                                  <i class="icon-heart-outlined main_color h2 font-weight-bold point"></i>
                              </div>
                              <div class="pb-2">
                                  <p class="teny_font">وعند موافقه العميل المبدئيه على التصميم يتم ازالة هذا النص من التصميم ويتم وضع النصوص النهائية المطلوبة للتصميم ويقول البعض ان وضع النصوص التجريبية بالتصميم قد تشغل المشاهد عن وضع الكثير من الملاحظات او الانتقادات للتصميم الاساسي</p>
                              </div>
                          </div>
                          <div class="my-4 d-flex align-items-center justify-content-center">
                              <h5 class="fw-bold">52.800 BHD
                          </h5></div>
                          <div class="my-4">
                              <div class="py-4 d-flex">
                                  <span class="p-2 ms-4">الكمية</span>
                                  <input type="text" class="border-0 shadow p-2 w-100">
                              </div>
                              <div class="py-4 d-flex">
                                  <span class="p-2 ms-4">اللون</span>
                                  <input type="text" class="border-0 shadow p-2 w-100">
                              </div>
                              <div class="my-3">
                                  <button class="main_bt transition-me px-4 py-3 rounded-pill border-0 transition_me w-100"><i class="icon-shopping-bag me-2"></i>Add to cart</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Product', 'row_id' => '7.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '30', 'title_ar' => 'Third Product', 'title_en' => 'Third Product', 'link' => 'product3', 'preview' => '<div class="nail my-4">
              <div class="container">

                  <div class="row">
                      <div class="col-12 col-md-6">
                          <div class="">
                              <div class="gallery">
                                  <div class="container">
                                      <div class="master-img text-center little_back p-5">
                                          <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid" alt="coffee">
                                      </div>
                                      <div class="thumbnails d-flex justify-content-between py-3">
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                          <div class="bg-light mx-1 text-center py-3 point">
                                              <img src="/assets/img/iPhone-13-PNG-HD.png" class="img-fluid w-75" alt="image">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12 col-md-6">
                          <div class="h-100">
                              <div class="d-flex justify-content-between my-4">
                                  <h2 class="main_bold point">TOMATO SAUCE</h2>
                                  <i class="icon-heart-outlined main_color h2 font-weight-bold point"></i>
                              </div>
                              <div class="my-4">
                                  <span class="h4">200.0 BHD</span>
                              </div>
                              <div class="my-4 d-flex align-items-center">
                                  <ul class="list-unstyled d-flex justify-content-center m-0 pe-0">
                                      <li class="ms-1"><i class="icon-star-full h4 text-warning"></i></li>
                                      <li class="ms-1"><i class="icon-star-full h4 text-warning"></i></li>
                                      <li class="ms-1"><i class="icon-star-full h4 text-warning"></i></li>
                                      <li class="ms-1"><i class="icon-star-full h4 text-warning"></i></li>
                                      <li class="ms-2"><i class="icon-star-full h4 text-warning"></i></li>
                                  </ul>
                                  <span style="font-size: 16px">(30 Reviews)</span>
                              </div>
                              <div class="py-4">
                                  <p class="h5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                              </div>

                              <div class="my-4">
                                  <div class="row justify-content-center justify-content-md-center justify-content-lg-between align-items-center">
                                      <div class="col-12 col-md-6 col-lg-5 count my-2">
                                          <div class="row border rounded-pill shadow count align-items-center justify-content-center justify-content-md-center justify-content-lg-start my-3">
                                              <div class="col-3 p-0">
                                                  <div class=" point quantity-plus text-center">
                                                      <i class="icon-plus"></i>
                                                  </div>
                                              </div>
                                              <div class="col-6">
                                                  <input type="text" value="1" class="border-0 h5 pt-2 input_number w-100 text-center">
                                              </div>
                                              <div class="col-3 p-0">
                                                  <div class="point quantity-minus text-center">
                                                  <i class="icon-minus"></i>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-12 col-lg-7">
                                          <div class="d-flex justify-content-center my-3">
                                              <button class="main_bt border-0 rounded-pill h5 transition_me py-2 px-4 my-2">Add to Cart</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Product', 'row_id' => '7.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '31', 'title_ar' => 'First Service', 'title_en' => 'First Service', 'link' => 'service1', 'preview' => '<div class="Features_one my-5" style="display: block;">
              <div class="container">
                  <div class="py-1 my_border_right my-5">
                      <h5 class="fw-bold mb-0 pe-4 main_color">مميزات متجرنا</h5>
                  </div>
                  <div class="row align-items-center justify-content-center">
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="in_features shadow p-3 my-4">
                              <div class="delivery one">
                                  <i class="icon-truck2"></i>
                              </div>
                              <h4 class="fw-bold my-3">توصيل امن وسريع</h4>
                              <p class="more_small">
                                  هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.
                              </p>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="in_features shadow p-3 my-4">
                              <div class="delivery two">
                                  <i class="icon-download6"></i>
                              </div>
                              <h4 class="fw-bold my-3">تنوع المنتجات</h4>
                              <p class="more_small">
                                  هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.
                              </p>
                          </div>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="in_features shadow p-3 my-4">
                              <div class="delivery three">
                                  <i class="icon-newspaper1"></i>
                              </div>
                              <h4 class="fw-bold my-3">سهولة الدفع</h4>
                              <p class="more_small">
                                  هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص.
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Service', 'row_id' => '7.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '32', 'title_ar' => 'First Sidebar', 'title_en' => 'First Sidebar', 'link' => 'sidebar1', 'preview' => '<div class="toolbar_one" style="display: block;">
              <div class="container">
                  <div class="d-flex justify-content-center">
                      <button class="toolbar_bt" onclick="openNav()"><i class="icon-product-hunt"></i></button>
                  </div>
              </div>

              <!-- start sidebar -->

              <div id="mySidenav" class="sidenav" style="width: 300px;">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                  <ul class="list-unstyled">
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">هواتف ذكية</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">اكسسوارات هواتف</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">مكياج واكسسوار</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">العاب كمبيوتر</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">صبغات شعر</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">محافظ وشنط</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">ملابس واحذية</a>
                      </li>
                  </ul>
              </div>

              <!-- end sidebar -->

              <script>
                  function openNav() {
                      document.getElementById("mySidenav").style.width = "300px";
                  }

                  function closeNav() {
                      document.getElementById("mySidenav").style.width = "0";
                  }
              </script>
          </div>
          ', 'type' => 'Sidebar', 'row_id' => '99.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '33', 'title_ar' => 'Second Sidebar', 'title_en' => 'Second Sidebar', 'link' => 'sidebar2', 'preview' => '<div class="toolbar_one" style="display: block;">
              <div class="container">
                  <div class="d-flex justify-content-center">
                      <button class="toolbar_bt" onclick="openNav()"><i class="icon-opencart"></i></button>
                  </div>
              </div>

              <!-- start sidebar -->

              <div id="mySidenav" class="sidenav" style="width: 330px;">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                  <ul class="list-unstyled">
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">هواتف ذكية</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">اكسسوارات هواتف</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">مكياج واكسسوار</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">العاب كمبيوتر</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">صبغات شعر</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">محافظ وشنط</a>
                      </li>
                      <li>
                          <a href="#" class="fw-bold text-decoration-none">ملابس واحذية</a>
                      </li>
                  </ul>
                  <div class="my-4 px-4">
                      <p>
                          <label for="amount" class="main_bold h4 second_color">Sort by price</label>
                          <input type="text" id="amount" readonly="" style="border:0; font-weight:bold;width: 100%;text-align: center;">
                      </p>

                      <div class="py-3">
                          <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0.2%; width: 99.8%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0.2%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span></div>
                      </div>

                  </div>
              </div>

              <!-- end sidebar -->

              <script>
                  function openNav() {
                      document.getElementById("mySidenav").style.width = "330px";
                  }

                  function closeNav() {
                      document.getElementById("mySidenav").style.width = "0";
                  }
              </script>
          </div>
          ', 'type' => 'Sidebar', 'row_id' => '99.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '34', 'title_ar' => 'First Subscribes', 'title_en' => 'First Subscribes', 'link' => 'subscribe1', 'preview' => '<div class="subscribe_THREE">
              <div class="parent-wrapper">
                  <span class="close-btn glyphicon glyphicon-remove">
                      <i class="icon-unsubscribe"></i>
                  </span>
                  <div class="subscribe-wrapper">
                      <h4>SUBSCRIBE TO OUR MATJR</h4>
                      <input type="email" name="email" class="subscribe-input" placeholder="Your e-mail">
                      <div class="submit-btn">SUBMIT</div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Subscribe', 'row_id' => '9.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '35', 'title_ar' => 'Second Subscribes', 'title_en' => 'Second Subscribes', 'link' => 'subscribe2', 'preview' => '<div class="subscribe_two py-4 shadow">
              <div class="container position-relative">
                  <span class="to_top_border"></span>
                  <div class="title text-center py-4">
                      <h3 class="fw-bold third_color">الإشتراك</h3>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-12 col-md-8 col-lg-6">
                          <div class="custom_input_3 position-relative my-4">
                              <input type="text" class="shadow border-0 rounded-pill w-100 p-4 mt-2" style="background-color: #2eafc61a;">
                              <label>البريد الإلكترونى</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Subscribe', 'row_id' => '9.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '36', 'title_ar' => 'Third Subscribes', 'title_en' => 'Third Subscribes', 'link' => 'subscribe3', 'preview' => '<div class="subscribe py-4">
              <div class="container">
                  <div class="title text-center">
                      <h3 class="fw-bold second_color">الإشتراك</h3>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-12 col-md-8 col-lg-6">
                          <div class="custom_input_2 position-relative my-4">
                              <input type="text" class="border-0 rounded-pill w-100 p-4 second_bg mt-2" style="background-color: #2eafc61a;">
                              <label>البريد الإلكترونى</label>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Subscribe', 'row_id' => '9.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '37', 'title_ar' => 'First Testimonials', 'title_en' => 'First Testimonials', 'link' => 'testimonial1', 'preview' => '<div class="customer_one my-5 py-3" style="display: block;">
              <div class="container">
                  <div class="py-1 my_border_right my-5">
                      <h5 class="fw-bold mb-0 pe-4 main_color">اراء العملاء</h5>
                  </div>

                  <!-- start in large screen -->
                  <div class="my-4 in_section d-none d-md-none d-lg-block">
                      <div id="carouselExampleControls_tow_client" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <div class="row">
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="carousel-item">
                                  <div class="row">
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-4">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center mt-4">
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_tow_client" data-bs-slide="next">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-right"></i>
                                  </div>
                              </button>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_tow_client" data-bs-slide="prev">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-left"></i>
                                  </div>
                              </button>
                          </div>
                      </div>
                  </div>

                  <!-- start in md screen -->
                  <div class="my-4 in_section d-none d-md-block d-lg-none">
                      <div id="carouselExampleControls_md_client" class="carousel slide px-4" data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <div class="row">
                                      <div class="col-12 col-md-6">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="carousel-item">
                                  <div class="row">
                                      <div class="col-12 col-md-6">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                      <div class="col-12 col-md-6">
                                          <div class="in_customer w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_md_client" data-bs-slide="next">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-right"></i>
                                  </div>
                              </button>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_md_client" data-bs-slide="prev">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-left"></i>
                                  </div>
                              </button>
                          </div>
                      </div>
                  </div>

                  <!-- start in md screen -->
                  <div class="my-4 in_section d-block d-md-none d-lg-none">
                      <div id="carouselExampleControls_sm_client" class="carousel slide px-5" data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <div class="in_customer w-100 my-4">
                                      <div class="d-flex align-items-center">
                                          <div class="customer_img">
                                              <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                          </div>
                                          <div class="me-3">
                                              <h5 class="fw-bold mb-0">محمد احمد</h5>
                                              <span class="our_opacity">المنامة</span>
                                          </div>
                                      </div>
                                      <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                  </div>
                              </div>
                              <div class="carousel-item">
                                  <div class="in_customer w-100 my-4">
                                      <div class="d-flex align-items-center">
                                          <div class="customer_img">
                                              <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                          </div>
                                          <div class="me-3">
                                              <h5 class="fw-bold mb-0">محمد احمد</h5>
                                              <span class="our_opacity">المنامة</span>
                                          </div>
                                      </div>
                                      <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center">
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_sm_client" data-bs-slide="next">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-right"></i>
                                  </div>
                              </button>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_sm_client" data-bs-slide="prev">
                                  <div class="my_arrow">
                                      <i class="icon-cheveron-left"></i>
                                  </div>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Testimonial', 'row_id' => '9.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '38', 'title_ar' => 'Second Testimonials', 'title_en' => 'Second Testimonials', 'link' => 'testimonial2', 'preview' => '<div class="customer_two my-5 py-3" style="display: block;">
              <div class="container">
                  <div class="py-1 my-5 text-center">
                      <h5 class="fw-bold mb-0 pe-4 main_color">اراء العملاء</h5>
                  </div>

                  <!-- start in large screen -->
                  <div class="in_section">
                      <div id="carouselExampleControls_other" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <div class="row justify-content-center">
                                      <div class="col-12 col-md-8 col-lg-5">
                                          <div class="in_customer new w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="carousel-item">
                                  <div class="row justify-content-center">
                                      <div class="col-12 col-md-8 col-lg-5">
                                          <div class="in_customer new w-100 my-4">
                                              <div class="d-flex align-items-center">
                                                  <div class="customer_img">
                                                      <img src="/assets/img/person.jpg" class="img-fluid rounded-circle" alt="image">
                                                  </div>
                                                  <div class="me-3">
                                                      <h5 class="fw-bold mb-0">محمد احمد</h5>
                                                      <span class="our_opacity">المنامة</span>
                                                  </div>
                                              </div>
                                              <p class="tiny_font mt-4">كما أن وقام وبدأت، لم أدوات للمجهود بلا. إذ لها الأول الستار، تحت وصغار مدينة عل. أي بحشد ليرتفع الساحلية أما، ليركز الهادي للأسطول ما هذا، أسابيع الروسية وتم عن. وفي مع شدّت فكان أدوات. سمّي تعداد ونستون هذا ما. به، بـ الخاصّة هيروشيما، وربع جندي الشهير الساحل.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center mt-4">
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_other" data-bs-slide="next">
                                  <div class="last_my_arrow">
                                      <i class="icon-cheveron-right"></i>
                                  </div>
                              </button>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_other" data-bs-slide="prev">
                                  <div class="last_my_arrow">
                                      <i class="icon-cheveron-left"></i>
                                  </div>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          ', 'type' => 'Testimonial', 'row_id' => '9.00', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
            ['id' => '39', 'title_ar' => 'First Toolbars', 'title_en' => 'First Toolbars', 'link' => 'toolbar1', 'preview' => '<div class="container d-none d-md-block">
              <div class="toolbar_tow third_bg py-2" style="display: block;">

                  <!-- start media screen -->
                  <div class="row justify-content-center">
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">هواتف ذكية</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">اكسسوارات هواتف</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">مكياج واكسسوارات</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">العاب كمبيوتر</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">صبغات شعر</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">محافظ وشنط</a>
                          </div>
                      </div>
                      <div class="col-md-4 col-lg">
                          <div class="my-2 text-center">
                              <a href="#" class="fw-bold text-decoration-none tiny_font">ملابس واحذية</a>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- start small screen -->
              <div class="container py-3 d-block d-md-none">
                  <div class="d-flex justify-content-start align-items-center">
                      <span class="toggle_bt">
                          <span class="the_bar"></span>
                          <span class="the_bar"></span>
                          <span class="the_bar"></span>
                      </span>
                      <h5 class="second_color fw-bold mb-0 me-5">فئات المنتجات</h5>
                  </div>
                  <div class="toolbar_list">
                      <ul class="list-unstyled">
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">هواتف ذكية</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">اكسسوارات هواتف</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">مكياج واكسسوار</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">العاب كمبيوتر</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">صبغات شعر</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">محافظ وشنط</a>
                          </li>
                          <li>
                              <a href="#" class="fw-bold text-decoration-none">ملابس واحذية</a>
                          </li>
                      </ul>
                  </div>
              </div>

          </div>
          ', 'type' => 'Toolbar', 'row_id' => '1.50', 'path' => '', 'created_at' => '2022-08-22 10:47:54', 'updated_at' => '2022-08-22 10:47:54'],
        ]);
    }
}
