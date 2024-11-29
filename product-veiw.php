<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product View - Velvet Vogue</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <?php include 'header.php'; ?>
    <?php include 'login_modal.html'; ?>
    <?php include 'register_modal.html'; ?>

    <main>
      <section class="product-view">
        <div class="product-images" id="productImages">
         <!-- product images are loaded dynamically -->
        </div>
        <div class="product-veiw-details">
          <div class="product-details"  id="productDetails">
            <!-- product is loaded dynamically -->
          </div>
        </div>
      </section>

      <section class="reviews">
        <h3>Customer Reviews</h3>
        <div id="reviewList">
          <!-- Reviews are loaded dynamically -->
        </div>
         <!-- Review Submission Form -->
    <div class="add-review">
        <h4>Leave a Review</h4>
        <form id="reviewForm">
            <input type="text" id="customerName" name="customerName" placeholder="Your Name" required />
            <select id="rating" name="rating" required>
                <option value="" disabled selected>Rating</option>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Good</option>
                <option value="3">3 - Average</option>
                <option value="2">2 - Poor</option>
                <option value="1">1 - Terrible</option>
            </select>
            <textarea id="reviewText" name="reviewText" placeholder="Write your review here" required></textarea>
            <button type="submit">Submit Review</button>
        </form>
    </div>
      </section>

      <section class="recommended-products">
        <h3>Recommended Products</h3>
        <div class="product-grid" id="recommendedProducts">
          <!-- Recommended products will be loaded here -->
        </div>
      </section>
    </main>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
  </body>
</html>
