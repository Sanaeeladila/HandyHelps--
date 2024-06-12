<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link href="style1.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/1e94604817.js" crossorigin="anonymous"></script>
</head>
</style>
<body>
    <section class="sec1">
        <div class="content">
            <nav>
                <ul>
                    <li><img src="img/logo.png" style="height:50px;"></li>
                    <li class="handyhelps">HandyHelps</li>
                </ul>
            </nav>
            <p>Crafting Your Moments, Mastering Every Detail!</p>
            <a href="{{ url('login') }}"><button class="btn btn-primary"><strong>Login</strong></button></a>
        </div>
        <div class="image-container" ></div>
    </section>
    
  
    <section class="sec2">
        <img src="img/logo.png" style=" width:15% ; padding-left: 41%;">
        <h2>Who we are ?</h2>
        <p> At HandyHelps, we're committed to simplifying the daily lives of our customers<br> 
            by providing easy access to a comprehensive range of home services. Our <br>
            revolutionary platform connects individuals with skilled experts in various <br> 
            fields, from handyman services to pet care, gardening, household assistance, <br>
            and event organization. With HandyHelps, you can rely on reliable and <br> 
            professional assistance to meet all your domestic needs
        </p>
    </section>


    <section class="sec3">
        <p class="services">Our services</p>
        <div class="row">
            <div class="col-4">
                <a href="{{ url('gardening') }}" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;"><div class="card">
                    <img src="img/service1.jpg" class="card-img-top" >
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 10px;" >GARDENING</h5>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-4">
                <a href="{{ url('petCare') }}" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;"><div class="card">
                    <img src="img/service2.jpg" class="card-img-top" >
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 10px;">PET CARE</h5>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-4">
                <a  href="{{ url('bricolage') }}" style="text-decoration: none; color: #000000; font-size: 20px; text-align: center;"><div class="card">
                    <img src="img/service3.jpg" class="card-img-top" >
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: 10px;">BRICOLAGE</h5>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </section>

    <section class="sec4">
        <div class="slide-container">
          <div class="card-wrapper" id="cardWrapper">
            <div class="cardd">
              <div class="comment-box">
                <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 24px;"></i>
                <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 24px;"></i>
                <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 24px;"></i>
                <i class="fa-solid fa-star" style="color: #FFD43B; font-size: 24px;"></i>
                <p style="font-size: 25px;">"I recently used HandyHelps for home maintenance and was impressed! Prompt service, precise work, and smooth booking. Great experience overall! Room for improvement, hence four stars. Keep up the good work, HandyHelps team!"</p>
              </div>
            </div>
          </div>
          <!-- Flèches de navigation -->
          <div class="arrow arrow-left" onclick="slide('left')">&#10094;</div>
          <div class="arrow arrow-right" onclick="slide('right')">&#10095;</div>
        </div>
      </section>
      

    
    <footer>
        <div class="image-container-footer" ></div>
        <div class="footer-content">
            <p class="title">Let's do things together</p>
            <p><strong>ADDRESS</strong></p>
            <p>6, Mhanech I, Tetouan</p> <br>
            <p><strong>CONTACT</strong></p>
            <p>07 23 45 67 89</p>
            <p>HandyHelps@gamil.com</p>

        </div>
        
    </footer>

        
</body>
</html>