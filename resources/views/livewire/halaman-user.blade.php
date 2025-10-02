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
            <!-- Logo + Bold Title for Small Screens -->
            <a href="" class="navbar-brand d-flex align-items-center">
                <img src="https://lgubangar.gov.ph/wp-content/uploads/2021/10/cropped-tablogo.png" alt="Logo" style="height: 90px;">
                <!-- Page title: show on small screens only -->
                <span class="d-lg-none ms-2 fw-bold text-primary fs-5" style="white-space: nowrap;">Bangar GIS Dashboard</span>
            </a>

            <!-- Burger Menu -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav ml-auto py-0">
                    <a href="#home" class="nav-item nav-link active">Home</a>
                    <a href="#vision_mission" class="nav-item nav-link">Vision Mission</a>
                    <a href="#orgcharts" class="nav-item nav-link">Organizational Structure</a>
                    <a class="nav-link" href="#mapCarousel">Map Gallery</a>
                    <a href="#barangayss" class="nav-item nav-link">Barangay/Village Data</a>
                    <a href="#land_Data" class="nav-item nav-link">Land Data</a>
                    <a href="#maps" class="nav-item nav-link">Agricultural Map</a>
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                            <a href="#" class="btn btn-primary py-md-3 px-md-5 mt-2">Learn More</a>
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
                <div class="col-md-4 d-flex align-items-center justify-content-left bg-secondary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex">
                        <i class="fa fa-2x fa-map-marker-alt text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Location</h5>
                            <p class="m-0 text-white">Maria Cristina East Bangar, La Union</p>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-left bg-primary mb-4 mb-lg-0" style="height: 100px;">
                    <div class="d-inline-flex text-left">
                        <i class="fa fa-2x fa-envelope text-white m-0 mr-3"></i>
                        <div class="d-flex flex-column">
                            <h5 class="text-white font-weight-medium">Email</h5>
                            <p class="m-0 text-white">agricultureservice@lgubangar.gov.ph</p>
                            <p class="m-0 text-white">oasbangar@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-left bg-secondary mb-4 mb-lg-0" style="height: 100px;">
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
    <div id="vision_mission" class="container-fluid py-5">
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
    <div id="orgcharts" class="container-fluid py-5">
        <div class="container">
            <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About </h6>
            <h1 class="display-4 text-center mb-5">Organizational Structure</h1>

            {{-- img orgchart --}}
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
<div id="barangayss" class="container-fluid pt-5 pb-3">
    <div class="container">
        <h6 class="text-secondary text-uppercase text-center font-weight-medium mb-3">About</h6>
        <h1 class="display-4 text-center mb-5">Barangays / Village</h1>

        <div class="chart-container" style="position: relative; width: 100%; height: 600px; max-width: 900px; margin: auto;">
            <canvas id="farmersMultiPieChart"></canvas>
        </div>
    </div>
</div>

@php
    $labels = $barangays->pluck('barangay_name');
    $data = $barangays->map(fn($item) => \App\Models\Pemiliklahan::where('barangay_id', $item->id)->count());

    $colors = [];
    foreach($barangays as $index => $item) {
        $hue = ($index * 360 / count($barangays));
        $colors[] = "hsl($hue, 90%, 50%)"; // bright colors
    }
@endphp

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($labels) !!};
    const data = {!! json_encode($data) !!};
    const colors = {!! json_encode($colors) !!};

    const ctx = document.getElementById('farmersMultiPieChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut', // still using multi-series pie style
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Farmers',
                data: data,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // allows resizing
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw + ' farmers';
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Farmers per Barangay',
                    font: {
                        size: 24,
                        weight: 'bold'
                    }
                }
            },
            cutout: '30%'
        }
    });
</script>


    <!-- Services End -->


    <!-- Features Start -->
    <div id="land_Data" class="container-fluid py-5">
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
                            <span class="text-center font-weight-bold align-items-center text-secondary" style="display:flex">Farmers</span>
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
        <h4 class="mb-3">Input Data</h4>
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
   <div id="maps" class="container-fluid pt-5 pb-3">
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

// Get unique barangays & crops
var barangaySet = new Set();
var cropSet = new Set();
petas.forEach(item => {
    if(item.barangay_name) barangaySet.add(item.barangay_name);
    if(item.crop_type) cropSet.add(item.crop_type);
});

// Function to generate crop icons
function getCropIcon(type){
    const t = (type || '').toLowerCase();
    let emoji = '🌱';
    if(t.includes('padi') || t.includes('rice')) emoji = '🌾';
    else if(t.includes('jagung') || t.includes('corn')) emoji = '🌽';
    else if(t.includes('sayur') || t.includes('veget')) emoji = '🥬';
    else if(t.includes('kopi') || t.includes('coffee')) emoji = '☕';
    else if(t.includes('eggplant') || t.includes('eggplant')) emoji = '🍆';
    else if(t.includes('kelapa') || t.includes('coco')) emoji = '🥥';
    else if(t.includes('kakao') || t.includes('cocoa')) emoji = '🍫';
    else if(t.includes('tebu') || t.includes('sugarcane')) emoji = '🎋';
    else if(t.includes('kacang') || t.includes('bean')) emoji = '🫘';
    else if(t.includes('tomat') || t.includes('tomato')) emoji = '🍅';
    else if(t.includes('cabai') || t.includes('chili')) emoji = '🌶️';
    else if(t.includes('pisang') || t.includes('banana')) emoji = '🍌';
    else if(t.includes('mangga') || t.includes('mango')) emoji = '🥭';
    else if(t.includes('calamasi') || t.includes('calamansi')) emoji = '🍋‍🟩';
    else if(t.includes('durian')) emoji = '🟫';
    else if(t.includes('rambutan')) emoji = '🔴';
    else if(t.includes('singkong') || t.includes('cassava')) emoji = '🥔';
    else if(t.includes('ubi') || t.includes('sweet potato')) emoji = '🍠';
    else if(t.includes('kentang') || t.includes('potato')) emoji = '🥔';
    else if(t.includes('bawang') || t.includes('onion') || t.includes('garlic')) emoji = '🧅';
    return L.divIcon({
        className: 'crop-icon',
        html: `<div style="display:flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:50%;background:#fff;border:2px solid #2e7d32;font-size:16px;box-shadow:0 2px 4px rgba(0,0,0,0.3);">${emoji}</div>`,
        iconSize: [28, 28],
        iconAnchor: [14, 14]
    });
}

// Color function
function getColorFromId(id) {
    var hue = (id * 137.508) % 360;
    return `hsl(${hue},70%,50%)`;
}

// Create polygons and markers
petas.forEach(function(item) {
    if (!item.land_boundaries || item.land_boundaries.trim() === '') return;
    try {
        var geojson = JSON.parse(item.land_boundaries);
        if (!geojson || !geojson.features || geojson.features.length === 0) return;

        var strokeColor = getColorFromId(item.id);
        var fillColor = getColorFromId(item.id + 1000);

        var layer = L.geoJSON(geojson, { style: { color: strokeColor, fillColor: fillColor, fillOpacity: 0.6 } }).addTo(map);
        polygonLayers[item.id] = layer;
        originalColors[item.id] = { stroke: strokeColor, fill: fillColor };

        var bounds = layer.getBounds();
        var centroid = bounds.getCenter();

        var popupHtml = `<div style="min-width:180px">
            <b>${item.crop_type || 'Unknown Crop'}</b><br>
            Barangay: ${item.barangay_name || '-'}<br>
            Owner: ${item.farmer_name || '-'}<br>
            Land Area: ${item.land_area || '-'} m²
        </div>`;

        var marker = L.marker(centroid, { icon: getCropIcon(item.crop_type) }).addTo(map);
        marker.bindPopup(popupHtml);
        layer.bindPopup(popupHtml);
        markerLayers[item.id] = marker;

        layer.on('click', () => map.fitBounds(bounds));
        marker.on('click', () => map.setView(centroid, 18));

    } catch(e) { console.error('Invalid GeoJSON for ID '+item.id, e); }
});

// === SEARCH & FILTER CONTROL (Smaller UI) ===
var searchControl = L.control({ position: 'topright' });
searchControl.onAdd = function() {
    var div = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    div.style.background = '#fff';
    div.style.padding = '4px';
    div.style.minWidth = '180px';
    div.style.fontSize = '12px';
    div.innerHTML = `
        <select id="barangayFilter" style="width:100%;margin-bottom:3px;padding:3px;font-size:12px;">
            <option value="">All Barangays</option>
        </select>
        <select id="cropFilter" style="width:100%;margin-bottom:3px;padding:3px;font-size:12px;">
            <option value="">All Crops</option>
        </select>
        <input type="text" id="petaSearch" placeholder="Search land..." 
            style="width:100%;padding:3px;margin-bottom:3px;font-size:12px;">
        <div id="searchResults" 
            style="max-height:120px;overflow-y:auto;font-size:12px;line-height:1.3;"></div>
    `;
    L.DomEvent.disableClickPropagation(div);
    return div;
};
searchControl.addTo(map);

// Populate dropdowns
const barangayFilter = document.getElementById('barangayFilter');
Array.from(barangaySet).sort().forEach(b => barangayFilter.innerHTML += `<option value="${b}">${b}</option>`);
const cropFilter = document.getElementById('cropFilter');
Array.from(cropSet).sort().forEach(c => cropFilter.innerHTML += `<option value="${c}">${c}</option>`);

// === FILTER FUNCTION ===
function applyFilters() {
    var query = document.getElementById('petaSearch').value.toLowerCase();
    var selectedBarangay = barangayFilter.value;
    var selectedCrop = cropFilter.value;
    var resultsDiv = document.getElementById('searchResults');
    resultsDiv.innerHTML = '';

    var foundAny = false;

    petas.forEach(item => {
        var matchesSearch = !query || item.barangay_name.toLowerCase().includes(query) || 
            item.farmer_name.toLowerCase().includes(query) || 
            item.crop_type.toLowerCase().includes(query);
        var matchesBarangay = !selectedBarangay || item.barangay_name === selectedBarangay;
        var matchesCrop = !selectedCrop || item.crop_type === selectedCrop;

        var visible = matchesSearch && matchesBarangay && matchesCrop;

        // Show/hide layers
        if (polygonLayers[item.id]) {
            if (visible) map.addLayer(polygonLayers[item.id]); else map.removeLayer(polygonLayers[item.id]);
        }
        if (markerLayers[item.id]) {
            if (visible) map.addLayer(markerLayers[item.id]); else map.removeLayer(markerLayers[item.id]);
        }

        // Add to search results
        if (visible) {
            foundAny = true;
            var div = document.createElement('div');
            div.style.padding = '3px';
            div.style.borderBottom = '1px solid #ddd';
            div.style.cursor = 'pointer';
            div.innerHTML = `<b>${item.barangay_name}</b><br>Owner: ${item.farmer_name}<br>Crop: ${item.crop_type}`;
            div.onclick = function() {
                map.fitBounds(polygonLayers[item.id].getBounds());
                polygonLayers[item.id].openPopup();
                markerLayers[item.id].openPopup();
            };
            resultsDiv.appendChild(div);
        }
    });

    if (!foundAny && query.trim() !== '') {
        resultsDiv.innerHTML = '<div style="padding:3px;color:#999;">No matches found</div>';
    }
}

// Event listeners
document.getElementById('petaSearch').addEventListener('input', applyFilters);
barangayFilter.addEventListener('change', applyFilters);
cropFilter.addEventListener('change', applyFilters);

// Initial render
applyFilters();
</script>






</div>

