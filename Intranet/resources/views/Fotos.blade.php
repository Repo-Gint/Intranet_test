@extends('layouts.app')
@section('content')

<!-- Page breadcrumb -->
 <section id="mu-page-breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2>Galeria</h2>
           <ol class="breadcrumb">
            <li><a href="{{ url('Indice') }}">Inicio</a></li>     
            <li><a href="{{ url('Galeria_GI') }}">Galeria</a></li>         
            <li class="active">Fiesta de Fin de Año 2019</li>
          </ol>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- Start gallery  -->
 <section id="mu-gallery">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-gallery-area">
          <!-- start gallery content -->
          <div class="mu-gallery-content">

            <div class="mu-gallery-body">
              <ul id="mixit-container" class="row">
                <!-- start single gallery image -->
                @foreach($fotos as $foto)
                <li class="col-md-4 col-sm-6 col-xs-12 mix lab">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="{{ asset('img/Galeria/'.$album->Name.'/'.$foto->Name_picture) }}"></a>
                      </div>
                      <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Samuel Lechuga</h4>
                          <p>
                            Analista de Sistemas<br>
                            Samuel.Lechuga@grupointerconsult.com<br>
                            Ext.: 1222
                          </p>
                          <a href="{{ asset('img/persona.jpg') }}" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-download"></span></a>
                        </div>
                      </div>                  
                    </div>
                  </div>
                </li>
                @endforeach
                <!-- start single gallery image -->
               <li class="col-md-4 col-sm-6 col-xs-12 mix library">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/2.jpg"></a>
                      </div>
                       <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Animation</p>
                          <a href="assets/img/gallery/big/2.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div> 
                    </div>
                  </div>
               </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix lab">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/3.jpg"></a>
                      </div>
                      <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Math</p>
                          <a href="assets/img/gallery/big/3.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix classroom">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/4.jpg"></a>
                      </div>
                       <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>English</p>
                          <a href="assets/img/gallery/big/4.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix others">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/5.jpg"></a>
                      </div>
                      <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Graphics</p>
                          <a href="assets/img/gallery/big/5.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix cafe">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/6.jpg"></a>
                      </div>
                       <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Health</p>
                          <a href="assets/img/gallery/big/6.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix others">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/7.jpg"></a>
                      </div>
                      <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Sports</p>
                          <a href="assets/img/gallery/big/7.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>             
                    </div>
                  </div> 
                </li>
                 <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix library">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/8.jpg"></a>
                      </div>
                       <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Health</p>
                          <a href="assets/img/gallery/big/8.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- start single gallery image -->
                <li class="col-md-4 col-sm-6 col-xs-12 mix lab">
                  <div class="mu-single-gallery">                  
                    <div class="mu-single-gallery-item">
                      <div class="mu-single-gallery-img">
                        <a href="#"><img alt="img" src="assets/img/gallery/small/9.jpg"></a>
                      </div>
                      <div class="mu-single-gallery-info">
                        <div class="mu-single-gallery-info-inner">
                          <h4>Image Title</h4>
                          <p>Sports</p>
                          <a href="assets/img/gallery/big/9.jpg" data-fancybox-group="gallery" class="fancybox"><span class="fa fa-eye"></span></a>
                          <a href="#" class="aa-link"><span class="fa fa-link"></span></a>
                        </div>
                      </div>             
                    </div>
                  </div> 
                </li>
              </ul>            
            </div>
          </div>
          <!-- end gallery content -->
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End gallery  -->

@endsection