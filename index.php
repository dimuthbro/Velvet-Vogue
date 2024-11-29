<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Velvet Vogue - Home</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <?php include 'header.php'; ?>
    <?php include 'login_modal.html'; ?>
    <?php include 'register_modal.html'; ?>

    <main>
      <section class="banner">
        <div class="slider">
          <div class="slides">
            <img src="images/banner1.jpg" alt="Fashion Promotion 1" />
            <img src="images/banner2.jpg" alt="Fashion Promotion 2" />
            <img src="images/banner.jpg" alt="Fashion Promotion 3" />
          </div>
        </div>
      </section>
      <script>
        const slides = document.querySelector(".slides");
        const images = document.querySelectorAll(".slides img");
        let currentIndex = 0;

        function showNextImage() {
          currentIndex = (currentIndex + 1) % images.length;
          const offset = -currentIndex * 100;
          slides.style.transform = `translateX(${offset}%)`;
        }

        setInterval(showNextImage, 5000);
      </script>

      <section class="categories">
        <h2>Featured Categories</h2>
        <div class="category-grid">
          <div class="category-item">
            <div class="image-container">
              <img src="images/casual-wear.jpg" alt="Casualwear" />
              <div class="overlay"></div>
              <span>Casualwear</span>
            </div>
          </div>
          <div class="category-item">
            <div class="image-container">
              <img src="images/formal-wear.jpg" alt="Formalwear" />
              <div class="overlay"></div>
              <span>Formalwear</span>
            </div>
          </div>
          <div class="category-item">
            <div class="image-container">
              <img src="images/accesories.jpg" alt="Accessories" />
              <div class="overlay"></div>
              <span>Accessories</span>
            </div>
          </div>
          <div class="category-item">
            <div class="image-container">
              <img src="images/new-arrivals.jpg" alt="New Arrivals" />
              <div class="overlay"></div>
              <span>New Arrivals</span>
            </div>
          </div>
        </div>
      </section>

      <section class="new-arrivals">
        <h2>New Arrivals</h2>
        <div class="product-grid" id="productGrid">
          <!-- This section loaded using php and javascript -->
        </div>
      </section>

      <section class="promotions">
        <h2>Current Promotions</h2>
        <p>Get 20% off on your first order! Use code: WELCOME20</p>
      </section>
    </main>
    <script src="script.js"></script>

    <?php include 'footer.php'; ?>
    
  </body>
</html>
