<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<style>
  #weather-info {
    font-family: 'Segoe UI', sans-serif;
  }
  .weather-current {
    background: #4facfe;
    color: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
  }
  .weather-current .icon {
    font-size: 50px;
    margin-bottom: 10px;
  }
  .weather-forecast {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 10px;
  }
  .forecast-day {
    background: #00f2fe;
    color: white;
    border-radius: 10px;
    padding: 10px;
    width: 100px;
    text-align: center;
  }
  .forecast-day .icon {
    font-size: 30px;
    margin-bottom: 5px;
  }
</style>


<div>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="#">FAQs</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="#">Help</a>
                        <span class="text-white">|</span>
                        <a class="text-white pl-3" href="#">Support</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-secondary">
                        <span class="text-primary">
                            <img src="https://lgubangar.gov.ph/wp-content/uploads/2021/10/cropped-tablogo.png" alt="Logo" style="height: 90px;">
                        </span>
                    </h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#visimisi" class="nav-item nav-link">Vision Mission</a>
                        <a href="#struktur" class="nav-item nav-link">Organizational Structure</a>
                        <a class="nav-link" href="#mapCarousel">Map Gallery</a>
                        <a href="#desa" class="nav-item nav-link">Barangay/Village Data</a>
                        <a href="#lahan" class="nav-item nav-link">Land Data</a>
                        <a href="#potensi" class="nav-item nav-link">Agcricultural Map</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div id="home" class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="w-100" style="height: 700px; object-fit: cover;" src="https://www.manilatimes.net/manilatimes/uploads/images/2024/04/10/328013.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Welcome to the website</h4>
                            <h2 class="display-4 text-white mb-md-4 text-bold text-uppercase ">AGRI BANGAR <br> OFFICE FOR AGRICULTURAL SERVICES</h2>
                            {{-- <a href="#" class="btn btn-primary py-md-3 px-md-5 mt-2">Learn More</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Contact Info Start -->
    <div class="container-fluid contact-info mt-5 mb-4">
        <div class="container" style="padding: 0 30px;">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-secondary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex">
                        <i class="fa fa-2x fa-map-marker-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Location</h5>
                            <p class="m-0 text-white">Maria Cristina East Bangar, La Union</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-primary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-envelope text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Email</h5>
                            <p class="m-0 text-white">agricultureservice@lgubangar.gov.ph</p>
                            <p class="m-0 text-white">oasbangar@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-center bg-secondary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-phone-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Contact Number</h5>
                            <p class="m-0 text-white">0995-750-1093</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Info End -->

    <!-- About Start -->
    <div id="visimisi" class="container-fluid py-5">
        <div class="container pt-0 pt-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img src="https://pia.gov.ph/wp-content/uploads/2025/02/From-soil-to-soul_-How-a-La-Union-farm-cultivates-hope-and-inspires-change.jpeg"  alt="LGU Bangar Logo" class="img-fluid m-2" style="max-height: 500px; width: auto;">

                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 pl-lg-5">
                    <h6 class="text-secondary text-uppercase font-weight-medium mb-3">About Vision Mission</h6>
                    <h1 class="mb-4">Vision</h1>
                    <h5 class="font-weight-medium font-italic mb-5">"To be a quality agri-industrial and commercial center in the north, with a peaceful, healthy, and safe environment"</h5>
                    <h1 class="mb-3">Mision</h1>
                    <div class="row">
                        <div class="col-sm-12 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">To optimize resources for sustainable economic growth and improve the quality of life for its residents</p>
                            </div>
                        </div>
                        <div class="col-sm-12 pt-3">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary mr-2"></i>
                                <p class="text-secondary font-weight-medium m-0">To optimize resources for sustainable economic growth and improve the quality of life for its residents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Testimonial Start -->
    <div id="struktur" class="container-fluid py-5">
        <div class="container">
            <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About </h6>
            <h1 class="display-4 text-center mb-5">Organizational Structure</h1>

            {{-- img struktur --}}
            <div class="row">
                <div class="col-md-12 mb-3">
                    <img class="img-fluid" src="{{ url('/') }}/img/struktur.png" alt="">
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel mt-2">
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/regina.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Regina M.Labiano</h5>
                        <p class="text-muted font-italic">Municipal Agriculturist</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/violeta.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Violeta M. Acido</h5>
                        <p class="text-muted font-italic">Agricultural Tech</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/comelia.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Comelia M. Olpinaldo</h5>
                        <p class="text-muted font-italic">Agricultural Tech</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/rowena.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Rowena D. Dieza</h5>
                        <p class="text-muted font-italic">Agricultural Tech</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/katrina.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Katrina P. Cabalona</h5>
                        <p class="text-muted font-italic">Agricultural Tech</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
                <div class="testimonial-item">
                    <img class="position-relative rounded-circle bg-white shadow mx-auto" src="{{ url('/') }}/img/roland.jpg" style="width: 100px; height: 100px; padding: 12px; margin-bottom: -50px; z-index: 1;" alt="">
                    <div class="bg-light text-center p-4 pt-0">
                        <h5 class="font-weight-medium mt-5">Roland L. Lardizabal</h5>
                        <p class="text-muted font-italic">Agricultural Tech</p>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor ipsum clita</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Pricing Plan Start -->
<div id="mapCarousel" class="container-fluid pt-5 pb-3">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About</h6>
        <h1 class="display-4 text-center mb-5">Map Gallery</h1>

        <div id="mapImagesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/maps/map1.jpg') }}" class="d-block w-100 rounded" alt="Map 1" style="max-height: 1000px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/maps/map2.jpg') }}" class="d-block w-100 rounded" alt="Map 2" style="max-height: 1000px; object-fit: cover;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/maps/map3.jpg') }}" class="d-block w-100 rounded" alt="Map 3" style="max-height: 1000px; object-fit: cover;">
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#mapImagesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mapImagesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mapImagesCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#mapImagesCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#mapImagesCarousel" data-bs-slide-to="2"></button>
            </div>
        </div>
    </div>
</div>

<script>
// Add swipe support for Bootstrap Carousel
const carousel = document.querySelector('#mapImagesCarousel');
let startX = 0;

carousel.addEventListener('touchstart', e => {
    startX = e.touches[0].clientX;
});

carousel.addEventListener('touchend', e => {
    const endX = e.changedTouches[0].clientX;
    if (startX - endX > 50) {
        // Swipe left -> Next
        bootstrap.Carousel.getInstance(carousel).next();
    } else if (endX - startX > 50) {
        // Swipe right -> Prev
        bootstrap.Carousel.getInstance(carousel).prev();
    }
});
</script>





    <!-- Pricing Plan End -->

    <!-- Services Start -->
    <div id="desa" class="container-fluid pt-5 pb-3">
        <div class="container">
            <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About</h6>
            <h1 class="display-4 text-center mb-5">Barangays / Village</h1>
            <div class="row">
                @foreach($desas as $desa)
                <div class="col-lg-3 col-md-6 pb-1">
                    {{-- <div class="d-flex flex-column align-items-center justify-content-center text-center bg-light mb-4 px-4" style="height: 100px;"> --}}
                        <div class="d-inline-flex align-items-center justify-content-center bg-white shad~ow rounded-circle mb-4 shadow" style="width: 100px; height: 100px;">
                            <span class="text-secondary font-weight-bold">
                                {{ $desa->luas_wilayah }} m<sup>2</sup>
                            </span>
                        </div>
                        <h3 class = "font-weight-bold m-0 mb-1 text-uppercase">{{ $desa->nama_desa }}</h3>
                        <h5 class = "mt-2"> {{ $desa->nama_kecamatan }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Features Start -->
    <div id="lahan" class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-0 my-lg-5 pt-0 pt-lg-5 pr-lg-5">
                    <h6 class="text-secondary text-uppercase font-weight-medium mb-3">About</h6>
                    <h1 class="mb-4">Land Data</h1>
                    <p>The following is land data based on data from the Municipality Of Bangar Agricultural Office:</p>
                    <div class="row">
                        <h5 class="font-weight-bold">Total Land Owners:</h5>
                        <div class="col-sm-6 mb-4 d-flex">
                            <h1 class="text-secondary" data-toggle="counter-up">{{ $pemiliktanah->count() }}  </h1>
                            <span class="text-center font-weight-bold align-items-center text-secondary" style="display:flex">    Farmers</span>
                        </div>
                        <h5 class="font-weight-bold">Total Land Area:</h5>
                        <div class="col-sm-6 mb-4 d-flex">
                            <h1 class="text-secondary" data-toggle="counter-up">{{ $sum_luas_tanah }} </h1>
                            <span class="text-center font-weight-bold align-items-center text-secondary" style="display:flex"> m<sup>2</sup></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex flex-column align-items-center justify-content-center bg-secondary h-100 py-5 px-3">
                        <img src="https://lgubangar.gov.ph/wp-content/uploads/2021/10/cropped-tablogo.png" alt="LGU Bangar Logo" class="img-fluid m-2" style="max-height: 500px; width: auto;">

                        <img src="https://files01.pna.gov.ph/ograph/2024/04/16/sab00188.jpg" alt="" class="img-fluid m-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
<div id="crop-ai" class="container py-5">
  <h1 class="display-4 text-center mb-4">Crop Recommendation</h1>
  <div class="row">
    <!-- Manual Input Form -->
    <div class="col-lg-6 mb-4">
      <div class="bg-light p-4 rounded shadow-sm">
        <h4 class="mb-3">Manual Input</h4>
        <form id="cropForm">
          <div class="form-row">
            <div class="form-group col-6"><label>Nitrogen (N)</label><input step="any" class="form-control" name="nitrogen" required></div>
            <div class="form-group col-6"><label>Phosphorus (P)</label><input step="any" class="form-control" name="phosphorus" required></div>
            <div class="form-group col-6"><label>Potassium (K)</label><input step="any" class="form-control" name="potassium" required></div>
            <div class="form-group col-6"><label>pH</label><input step="any" class="form-control" name="ph" required></div>
            <div class="form-group col-6"><label>Temperature (°C)</label><input step="any" class="form-control" name="temperature" required></div>
            <div class="form-group col-6"><label>Humidity (%)</label><input step="any" class="form-control" name="humidity" required></div>
            <div class="form-group col-6"><label>Rainfall (mm)</label><input step="any" class="form-control" name="rainfall" required></div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Get Recommendation</button>
        </form>
        <div id="cropResult" class="alert alert-info mt-3 d-none"></div>
      </div>
    </div>

    <!-- Weather Widget Section -->
    <div class="col-lg-6 mb-4">
      <div class="p-4 rounded shadow-sm text-center">
        <h4 class="mb-3">Current Weather</h4>

        <!-- WeatherWidget.org Embed -->
        <div id="ww_53ffc80b510b9" v='1.3' loc='id' a='{"t":"horizontal","lang":"en","sl_lpl":1,"ids":["wl5403"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>
          <a href="https://weatherwidget.org/" id="ww_53ffc80b510b9_u" target="_blank">Weather widget</a>
        </div>
        <script async src="https://app3.weatherwidget.org/js/?id=ww_53ffc80b510b9"></script>
      </div>
    </div>
  </div>
</div>




<script>
(async function(){
  const cropForm = document.getElementById("cropForm");
  const cropResult = document.getElementById("cropResult");
  const API_BASE = "https://crop-ml-api-1-xuhr.onrender.com";

  const nameMap = { nitrogen:"N", phosphorus:"P", potassium:"K", ph:"pH", temperature:"temperature", humidity:"humidity", rainfall:"rainfall" };
  const latitude = 16.8921;
  const longitude = 120.4266;

  // Fetch current weather from Open-Meteo and auto-fill crop form
  try{
    const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true&daily=temperature_2m_max,temperature_2m_min,rain_sum&timezone=Asia/Manila`);
    const data = await res.json();
    if(data.current_weather){
      const cur = data.current_weather;
      cropForm.querySelector('[name="temperature"]').value = cur.temperature;
      cropForm.querySelector('[name="humidity"]').value = Math.round(cur.temperature * 0.7);
      cropForm.querySelector('[name="rainfall"]').value = data.daily.rain_sum[0] || 0;
    }
  } catch(err){
    console.error("Weather fetch failed:", err);
  }

  // Crop form submit
  cropForm.addEventListener('submit', async e=>{
    e.preventDefault();
    const fd = new FormData(cropForm);
    const payload = Object.fromEntries([...fd.entries()].map(([k,v])=>[nameMap[k]||k, parseFloat(v)]));
    cropResult.classList.add('d-none');
    try{
      const res = await fetch(`${API_BASE}/predict`, {
        method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload)
      });
      const data = await res.json();
      const cropName = data.recommended_crop || JSON.stringify(data);
      cropResult.textContent = `Recommended crop: ${cropName}`;
      cropResult.classList.remove('d-none');
      cropResult.classList.remove('alert-danger');
      cropResult.classList.add('alert-info');
    }catch(err){
      cropResult.textContent = 'Error: '+err.message;
      cropResult.classList.remove('d-none');
      cropResult.classList.remove('alert-info');
      cropResult.classList.add('alert-danger');
    }
  });

})();
</script>






    <!-- Pricing Plan Start -->
   <div id="potensi" class="container-fluid pt-5 pb-3">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About</h6>
        <h1 class="display-4 text-center mb-5">Agricultural Land Map</h1>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="bg-light text-center mb-2 pt-4">
                    <!-- Map -->
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark text-white py-4 px-sm-3 px-md-5">
    <p class="m-0 text-center text-white">
        &copy; <a class="text-white font-weight-medium" href="#">Geographical Information System Bangar</a>. All Rights Reserved
        <a class="text-white font-weight-medium" href="#"></a>
    </p>
</div>

<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    

  


<script>
var map = L.map('map').setView([16.8921, 120.4266], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/">2025</a>',
    maxZoom: 23,
    id: 'mapbox/satellite-streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoib2tpbmluYW0iLCJhIjoiY21lYTZxazBqMGFzZjJpc2l5b2dyeHN0dCJ9.-nx4JkNuM_zjmW_Tq9RE3w'
}).addTo(map);

var polygonLayers = {};
var markerLayers = {};
var originalColors = {};
var petas = {!! json_encode($petas->toArray()) !!};

// Debug: Log data to console to check for missing crop types
console.log('Peta data loaded:', petas);
console.log('Total farms found:', petas.length);

// Collect all unique crop types for debugging
const uniqueCrops = new Set();
petas.forEach(function(item, index) {
    console.log(`Farm ${index}:`, {
        id: item.id,
        crop: item.jenis_tanah,
        owner: item.nama_pemiliklahan,
        barangay: item.nama_desa,
        hasBoundary: !!item.batas_lahan
    });
    
    if (item.jenis_tanah) {
        uniqueCrops.add(item.jenis_tanah);
    }
    
    if (!item.jenis_tanah) {
        console.warn(`Item ${index} (ID: ${item.id}) missing crop type:`, item);
    }
    if (!item.batas_lahan) {
        console.warn(`Item ${index} (ID: ${item.id}) missing boundary data:`, item);
    }
});

console.log('All unique crop types found:', Array.from(uniqueCrops));

// Simple emoji crop icons with better matching
function getCropIcon(type){
    const t = (type || '').toString().toLowerCase().trim();
    let emoji = '🌱'; // default
    
    console.log('Getting icon for crop type:', t); // Debug log
    
    if(t.includes('padi') || t.includes('rice') || t.includes('beras')) emoji = '🌾';
    else if(t.includes('jagung') || t.includes('corn') || t.includes('maize')) emoji = '🌽';
    else if(t.includes('sayur') || t.includes('veget') || t.includes('kangkung') || t.includes('bayam')) emoji = '🥬';
    else if(t.includes('kopi') || t.includes('coffee')) emoji = '☕';
    else if(t.includes('kelapa') || t.includes('coco') || t.includes('coconut')) emoji = '🥥';
    else if(t.includes('kakao') || t.includes('cocoa') || t.includes('coklat')) emoji = '🍫';
    else if(t.includes('tebu') || t.includes('sugarcane')) emoji = '🎋';
    else if(t.includes('kacang') || t.includes('bean') || t.includes('soy')) emoji = '🫘';
    else if(t.includes('tomat') || t.includes('tomato')) emoji = '🍅';
    else if(t.includes('cabai') || t.includes('chili') || t.includes('pepper')) emoji = '🌶️';
    else if(t.includes('pisang') || t.includes('banana')) emoji = '🍌';
    else if(t.includes('mangga') || t.includes('mango')) emoji = '🥭';
    else if(t.includes('calamasi') || t.includes('calamansi')) emoji = '🍋‍🟩';
    else if(t.includes('durian')) emoji = '🟫';
    else if(t.includes('rambutan')) emoji = '🔴';
    else if(t.includes('singkong') || t.includes('cassava') || t.includes('tapioka')) emoji = '🥔';
    else if(t.includes('ubi') || t.includes('sweet potato')) emoji = '🍠';
    else if(t.includes('kentang') || t.includes('potato')) emoji = '🥔';
    else if(t.includes('bawang') || t.includes('onion') || t.includes('garlic')) emoji = '🧅';
    else if(t.includes('padi sawah') || t.includes('wet rice')) emoji = '🌾';
    else if(t.includes('padi gogo') || t.includes('dry rice')) emoji = '🌾';
    else if(t.includes('padi ladang') || t.includes('upland rice')) emoji = '🌾';

    return L.divIcon({
        className: 'crop-div-icon-' + Math.random().toString(36).substr(2, 9),
        html: `<div style="display:flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:#ffffffcc;border:2px solid #2e7d32;font-size:20px;box-shadow: 0 2px 4px rgba(0,0,0,0.3);">${emoji}</div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 16]
    });
}

// Unique colors based on ID
function getColorFromId(id) {
    var hue = (id * 137.508) % 360; // golden angle
    return `hsl(${hue}, 70%, 50%)`;
}

petas.forEach(function(item) {
    // Skip if no boundary data or if data is invalid
    if (!item.batas_lahan || item.batas_lahan.trim() === '') {
        console.log(`Skipping item ${item.id} - no boundary data`);
        return;
    }

    try {
        var geojson = JSON.parse(item.batas_lahan);
        
        // Skip if geojson is empty or invalid
        if (!geojson || !geojson.features || geojson.features.length === 0) {
            console.log(`Skipping item ${item.id} - invalid geojson`);
            return;
        }

        var strokeColor = getColorFromId(item.id);
        var fillColor = getColorFromId(item.id + 1000);

        var layer = L.geoJSON(geojson, {
            style: { color: strokeColor, fillColor: fillColor, fillOpacity: 0.6 }
        }).addTo(map);

        polygonLayers[item.id] = layer;
        originalColors[item.id] = { stroke: strokeColor, fill: fillColor };

        // Detailed popup for polygon
        const popupHtml = `
            <div style="min-width:220px">
                <div style="font-weight:700;margin-bottom:4px;">${item.jenis_tanah || 'Unknown Crop'}</div>
                <div><strong>Barangay:</strong> ${item.nama_desa || '-'}</div>
                <div><strong>Owner:</strong> ${item.nama_pemiliklahan || '-'}</div>
                <div><strong>Land Area:</strong> ${item.luas_lahan || '-'} m²</div>
            </div>`;
        layer.bindPopup(popupHtml);

        // Get centroid using multiple methods for accuracy
        var centroid;
        
        // Method 1: Try to get centroid from GeoJSON feature
        try {
            if (geojson.features && geojson.features.length > 0) {
                var feature = geojson.features[0];
                if (feature.geometry && feature.geometry.coordinates) {
                    var coords = feature.geometry.coordinates[0]; // First ring of polygon
                    if (coords && coords.length > 0) {
                        var sumLat = 0, sumLng = 0;
                        coords.forEach(function(coord) {
                            sumLng += coord[0]; // longitude
                            sumLat += coord[1]; // latitude
                        });
                        centroid = L.latLng(sumLat / coords.length, sumLng / coords.length);
                        console.log(`Method 1 - GeoJSON centroid for farm ${item.id}:`, centroid);
                    }
                }
            }
        } catch (e) {
            console.log('Method 1 failed:', e);
        }
        
        // Method 2: Try to get centroid from layer geometry
        if (!centroid) {
            try {
                if (layer.getLayers && layer.getLayers().length > 0) {
                    var polygon = layer.getLayers()[0];
                    if (polygon.getLatLngs && polygon.getLatLngs().length > 0) {
                        var latlngs = polygon.getLatLngs()[0];
                        if (latlngs && latlngs.length > 0) {
                            var sumLat = 0, sumLng = 0;
                            latlngs.forEach(function(point) {
                                sumLat += point.lat;
                                sumLng += point.lng;
                            });
                            centroid = L.latLng(sumLat / latlngs.length, sumLng / latlngs.length);
                            console.log(`Method 2 - Layer centroid for farm ${item.id}:`, centroid);
                        }
                    }
                }
            } catch (e) {
                console.log('Method 2 failed:', e);
            }
        }
        
        // Method 3: Fallback to bounds center
        if (!centroid) {
            var bounds = layer.getBounds();
            centroid = bounds.getCenter();
            console.log(`Method 3 - Bounds center for farm ${item.id}:`, centroid);
        }

        // Create crop icon
        var cropIcon = getCropIcon(item.jenis_tanah);
        console.log(`Creating marker for farm ${item.id} with crop: ${item.jenis_tanah}, icon:`, cropIcon);
        
        var marker = L.marker(centroid, { 
            icon: cropIcon,
            title: item.jenis_tanah || 'Unknown Crop'
        }).addTo(map);

        // Marker popup
        marker.bindPopup(popupHtml);
        marker.bindTooltip(`${item.jenis_tanah || 'Unknown Crop'} — ${item.nama_pemiliklahan || 'Unknown Owner'}`, { direction: 'top' });
        markerLayers[item.id] = marker;
        
        console.log(`Marker created for farm ${item.id} at:`, centroid);

        // Zoom feature on polygon click
        layer.on('click', function() {
            map.fitBounds(layer.getBounds());
            layer.openPopup();
            marker.openPopup();
        });

        // Zoom feature on marker click
        marker.on('click', function() {
            map.setView(marker.getLatLng(), 18, { animate: true });
            marker.openPopup();
            layer.openPopup();
        });

    } catch(err) {
        console.error('Invalid GeoJSON for ID '+item.id, err);
    }
});

// Summary of markers created
console.log(`Total markers created: ${Object.keys(markerLayers).length}`);
console.log('Marker layers:', markerLayers);

// SEARCH BAR
var searchControl = L.control({ position: 'topright' });
searchControl.onAdd = function(map) {
    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.style.background = '#fff';
    div.style.padding = '5px';
    div.style.minWidth = '200px';
    div.innerHTML = `
        <input type="text" id="petaSearch" placeholder="Search land..." 
               style="width: 100%; padding: 5px; margin-bottom: 5px;">
        <div id="searchResults" style="max-height:150px; overflow-y:auto; font-size: 13px;"></div>
    `;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
searchControl.addTo(map);

// Legend control for crop icons
const legend = L.control({ position: 'bottomright' });
legend.onAdd = function(){
    const div = L.DomUtil.create('div', 'info legend');
    div.style.background = '#ffffffcc';
    div.style.padding = '8px 10px';
    div.style.border = '1px solid #ccc';
    div.style.borderRadius = '6px';
    div.style.maxHeight = '180px';
    div.style.overflowY = 'auto';

    const entries = [
        ['Rice', '🌾'],
        ['Corn', '🌽'],
        ['Vegetables', '🥬'],
        ['calamansi', '🍋‍🟩'],
        ['Coffee', '☕'],
        ['Coconut', '🥥'],
        ['Cocoa', '🍫'],
        ['Sugarcane', '🎋'],
        ['Beans', '🫘'],
        ['Tomato', '🍅'],
        [' Chili', '🌶️'],
        ['Banana', '🍌'],
        ['Mango', '🥭'],
        ['Cassava', '🥔'],
        ['Sweet Potato', '🍠'],
        ['Onion', '🧅'],
        ['🌱 Other Crops', '🌱'],
    ];
    div.innerHTML = entries.map(([label, svg]) => (
        `<div style="display:flex;align-items:center;gap:8px;margin:4px 0;">
            <span style="display:inline-block;width:20px;height:20px;">${svg}</span>
            <span style="font-size:12px;">${label}</span>
        </div>`
    )).join('');
    return div;
};
legend.addTo(map);

function searchPeta(query) {
    var resultsDiv = document.getElementById('searchResults');
    resultsDiv.innerHTML = '';
    var foundAny = false;

    petas.forEach(function(item) {
        if (
            item.nama_desa.toLowerCase().includes(query.toLowerCase()) ||
            item.nama_pemiliklahan.toLowerCase().includes(query.toLowerCase()) ||
            item.jenis_tanah.toLowerCase().includes(query.toLowerCase())
        ) {
            foundAny = true;

            var resultItem = document.createElement('div');
            resultItem.style.padding = '4px';
            resultItem.style.cursor = 'pointer';
            resultItem.style.borderBottom = '1px solid #ddd';
            resultItem.innerHTML = `<b>${item.nama_desa}</b><br>Owner: ${item.nama_pemiliklahan}<br>Soil: ${item.jenis_tanah}`;

            resultItem.addEventListener('click', function() {
                var polygon = polygonLayers[item.id];
                var marker = markerLayers[item.id];

                if(polygon.getBounds) map.fitBounds(polygon.getBounds());

                polygon.setStyle({ color: 'yellow', weight: 5 });
                setTimeout(() => {
                    polygon.setStyle({ color: originalColors[item.id].stroke, fillColor: originalColors[item.id].fill, weight: 2 });
                }, 2000);

                marker.openPopup();
                polygon.openPopup();
                resultsDiv.innerHTML = '';
            });

            resultsDiv.appendChild(resultItem);
        }
    });

    if (!foundAny && query.trim() !== '') {
        resultsDiv.innerHTML = '<div style="padding:4px;color:#999;">No matches found</div>';
    }
}

document.getElementById('petaSearch').addEventListener('input', function() {
    searchPeta(this.value);
});

// Refresh map when Livewire updates
document.addEventListener('livewire:load', function() {
    console.log('Livewire loaded - peta map should be ready');
});

document.addEventListener('livewire:update', function() {
    console.log('Livewire updated - refreshing peta map data');
    // Clear existing layers
    Object.values(polygonLayers).forEach(layer => map.removeLayer(layer));
    Object.values(markerLayers).forEach(marker => map.removeLayer(marker));
    polygonLayers = {};
    markerLayers = {};
    
    // Reload data (this will be handled by the page refresh)
    location.reload();
});
</script>





</div>

