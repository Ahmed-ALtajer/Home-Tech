<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
</head>
<style> 
 footer {
     background-color: #1f2533;
     color: #ffffff;
     padding: 2rem 0;
     font-family: Arial, sans-serif;
 }

 .footer-container {
     display: flex;
     flex-wrap: wrap;
     justify-content: space-around;
     max-width: 1200px;
     margin: auto;
 }

 .footer-column {
     flex: 1;
     min-width: 250px;
     padding: 20px;
 }

     .footer-column h3 {
         margin-bottom: 20px;
         color: #ffA500;
     }

     .footer-column ul, .footer-column p, .footer-column .social-icons {
         list-style-type: none;
         padding: 0;
         margin: 0 0 20px 0;
     }

         .footer-column ul li a, .footer-column p, .footer-column .social-icons a {
             color: #ffffff;
             text-decoration: none;
             opacity: 0.8;
             transition: opacity 0.3s;
         }

             .footer-column ul li a:hover, .footer-column .social-icons a:hover {
                 opacity: 1;
             }

 .social-icons {
     display: flex;
     align-items: center;
 }

     .social-icons a {
         margin-right: 10px;
     }

     .social-icons i {
         font-size: 24px; 
     }

 @media (max-width: 768px) {
     .footer-container {
         flex-direction: column;
         align-items: center;
     }

     .footer-column {
         max-width: 300px;
         margin-bottom: 20px;
     }
 }</style>
<body>
<footer>
        <div class="footer-container">
            <div class="footer-column">
                <img src="/project/images/logoreb.png" alt="Logo" style="max-width: 100px; margin-bottom: 20px;">
                <p>
                    At HomeTech, we bring the future of home convenience to your doorstep with our cutting-edge selection of dryers, air conditioners, and more. Elevate your living space with the latest in home technology, designed to make your life easier and more comfortable. Explore our range today and discover the perfect blend of innovation and functionality at HomeTech.
                </p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="footer-column" id="services">
                <h3>Services</h3>
                <ul>
                    <li><a href="#">Illustration</a></li>
                    <li><a href="#">Creatives</a></li>
                    <li><a href="#">Poster Design</a></li>
                    <li><a href="#">Card Design</a></li>
                </ul>
            </div>

            <div class="footer-column" id="useful-links">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Our Policy</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>

            <div class="footer-column" id="contact">
                <h3>Contact</h3>
                <ul>
                    <li><a href="contact us page.html">Contact us now</a></li>
                </ul>
                <p><i class="fa fa-location-arrow"></i> FF-42, Riyadh, KSA</p>
                <p><i class="fa fa-phone"></i> +966 324 3242</p>
            </div>

        </div>
        <p><center>© 2024 Store Website. All rights reserved.</center></p>
    </footer>
</body>
</html>