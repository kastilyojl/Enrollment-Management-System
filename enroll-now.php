<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../reset.css">
    <link rel="stylesheet" href="../enroll-now/enroll-now.css">
    <link rel="stylesheet" href="styles.css">
    <title>Enrollment Guidelines</title>
    <style>
        /* Hide images by default */
        .steps img {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="images">
            <!-- Add data-src attribute to store image source -->
            <div class="steps"><img data-src="../../images/enrollment-guide/1.png" alt="Step 1"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/2.png" alt="Step 2"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/3.png" alt="Step 3"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/4.png" alt="Step 4"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/5.png" alt="Step 5"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/6.png" alt="Step 6"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/7.png" alt="Step 7"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/8.png" alt="Step 8"></div>
            <div class="steps"><img data-src="../../images/enrollment-guide/9.png" alt="Step 9"></div>
        </div>
        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
    <section class="footer">
        <div class="credit">created by: <span>castillo and clareon</span> | all rights reserved</div>
    </section>
    <script src="../enroll-now/enroll-now.js"></script>
    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll('.steps img');

        // Preload images
        slides.forEach(img => {
            const src = img.getAttribute('data-src');
            const preloadImg = new Image();
            preloadImg.src = src;
            preloadImg.onload = () => {
                img.src = src;
                img.style.display = 'block'; // Show the image once loaded
            };
        });

        function moveSlide(n) {
            slideIndex += n;
            showSlides();
        }

        function showSlides() {
            if (slideIndex >= slides.length) {
                slideIndex = 0;
            }
            if (slideIndex < 0) {
                slideIndex = slides.length - 1;
            }
            const offset = -slideIndex * 100;
            document.querySelector('.images').style.transform = `translateX(${offset}%)`;
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSlides();
        });
    </script>
</body>

</html>