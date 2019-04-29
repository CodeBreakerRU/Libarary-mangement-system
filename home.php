<xmlns="https://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

  <head>
    <title> ARD public library </title>
    <?php include_once("main-menu-guest.html"); ?>

    <link rel="stylesheet" href="css/style-home.css" type="text/css">
  </head>
<body>
<div class="slideshow-container">

    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="images/img1.jpg" style="width:100%" alt="">
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="images/img2.jpg" style="width:100%" alt="">
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="images/img3.jpg" style="width:100%" alt="">
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>


<style>
    div.gallery {
        border: 1px solid #ccc;
    }

    div.gallery:hover {
        border: 0px solid #777;
    }

    div.gallery img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
    }

    * {
        box-sizing: border-box;
    }

    .responsive {
        padding: 0 6px;
        float: left;
        width: 20%;
    }

    @media only screen and (max-width: 700px) {
        .responsive {
            width: 49.99999%;
            margin: 6px 0;
        }
    }

    @media only screen and (max-width: 500px) {
        .responsive {
            width: 70%;
        }
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
 <br />

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="images/book1.jpg">
                <img src="images/book1.jpg" alt="Interment" width="400" height="400">
            </a>
            <div class="desc">INTERMENT</div>
        </div>
    </div>


    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="images/book2.jpg">
                <img src="images/book2.jpg" alt="Forest" width="400" height="400">
            </a>
            <div class="desc">BIG Magic</div>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="images/book3.jpg">
                <img src="images/book3.jpg" alt=" Caraval" width="400" height="400">
            </a>
            <div class="desc">Caraval</div>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="images/book4.jpg">
                <img src="images/book4.jpg" alt="Cold day in the sun" width="400" height="400">
            </a>
            <div class="desc">Cold day in the sun</div>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="images/book5.jpg">
                <img src="images/book5.jpg" alt="Again, But Better" width="400" height="400">
            </a>
            <div class="desc">Again, But Better</div>
        </div>
    </div>

</body>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 3000); // time
    }
</script>


</html>


<?php include_once("main-footer.html"); ?>
