async function LoadNewArrivals(){
    const response = await fetch("loadNewArrivals.php" );
    const data = await response.json();

    const productGrid = document.getElementById("productGrid");
    
    data.data.forEach(  (data) => {
        productGrid.innerHTML += `
            <div class="product-card">
                <img src="${data.image}" alt="Product 1" />
                <h3>${data.name}</h3>
                <p>${data.price}</p>
                <a href="product-veiw.php?id=${data.product_id}" class="view-button">View Product</a>
            </div>
        `;

    });
}
async function LoadProductById() {
    const urlParams = new URLSearchParams(window.location.search);
    const product_id = urlParams.get('id');
    console.log(product_id);

    const response = await fetch(`loadProductById.php?id=${product_id}`);
    const data = await response.json();

    console.log(data);

    const productDetails = document.getElementById("productDetails");

    data.data.forEach((data) => {
        productDetails.innerHTML += `
            <h2 id="productName">${data.name}</h2>
            <p id="productPrice">${data.price}</p>
            <p id="productDescription">
                ${data.description}
            </p>
            <div class="actions">
                <button class="btn-buy" id="buyNow">Buy Now</button>
                <button class="btn-cart" id="addToCart">Add to Cart</button>
            </div>
        `;
    });

    console.log(data);

    const addToCartButton = document.getElementById("addToCart");
    addToCartButton.addEventListener("click", async () => {
        // Check login status
        const loginStatus = await checkLoginStatus();

        if (!loginStatus) {
            showRegisterPopup();
        } else {
            console.log("User is logged in. Proceeding to checkout...");
        }
    });
    const buyNowButton = document.getElementById("buyNow");
    buyNowButton.addEventListener("click", async () => {
        // Check login status
        const loginStatus = await checkLoginStatus();

        if (!loginStatus) {
            showRegisterPopup();
        } else {
            console.log("User is logged in. Proceeding to checkout...");
        }
    });
}


async function checkLoginStatus() {
    const response = await fetch("checkLoginStatus.php"); // Replace with your server-side endpoint
    const data = await response.json();
    return data.loggedIn; // Assume the response is { loggedIn: true/false }
}


async function LoadProductImage() {
    const urlParams = new URLSearchParams(window.location.search);
    const product_id = urlParams.get('id');
    console.log(product_id);

    const response = await fetch(`loadProductById.php?id=${product_id}`);
    const data = await response.json();

    const productImages = document.getElementById("productImages");

    data.data.forEach((data) => {
        productImages.innerHTML += `
            <div class="image-slider">
                <button id="prev" class="slider-button"><</button>
                <div class="product-image-container">
                    <img class="slider-image" src="${data.image}" alt="Product Image 1" style="display: block;" />
                    <img class="slider-image" src="${data.image2}" alt="Product Image 2" style="display: none;" />
                    <img class="slider-image" src="${data.image3}" alt="Product Image 3" style="display: none;" />
                    <div id="magnifier"></div>
                </div>
                <button id="next" class="slider-button">></button>
            </div>
        `;
    });
    console.log(data);

    // Add slider functionality
    const images = document.querySelectorAll(".slider-image");
    let currentIndex = 0;

    function showImage(index) {
        images.forEach((img, i) => {
            img.style.display = i === index ? "block" : "none";
        });
    }

    document.getElementById("next").addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    });

    document.getElementById("prev").addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(currentIndex);
    });

    // Show the first image initially
    showImage(currentIndex);

    // Add the magnifier effect after the image loads
    const magnifier = document.getElementById("magnifier");

    images.forEach((image) => {
        image.addEventListener("mousemove", function(event) {
            const { left, top, width, height } = image.getBoundingClientRect();
            const x = event.pageX - left - window.scrollX;
            const y = event.pageY - top - window.scrollY;

            // Show the magnifier
            magnifier.style.display = "block";
            magnifier.style.left = `${x}px`;
            magnifier.style.top = `${y}px`;

            // Calculate background position for the zoom effect
            const bgX = ((x / width) * 100).toFixed(2);
            const bgY = ((y / height) * 100).toFixed(2);

            magnifier.style.backgroundImage = `url(${image.src})`;
            magnifier.style.backgroundSize = `${width * 2}px ${height * 2}px`; // Zoom level
            magnifier.style.backgroundPosition = `${bgX}% ${bgY}%`;
        });

        // Hide the magnifier when the mouse leaves the image
        image.addEventListener("mouseleave", function() {
            magnifier.style.display = "none";
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    // Handle login form submission
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(loginForm);

            fetch("login.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    if (data === "success") {
                        alert("Login successful!");
                        window.location.href = "product-view.php";
                    } else if (data === "invalid_password") {
                        alert("Invalid password. Please try again.");
                    } else if (data === "invalid_email") {
                        alert("Invalid email. Please check your credentials.");
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        });
    }

    // Handle register form submission
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(registerForm);

            fetch("register.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((data) => {
                    if (data === "success") {
                        alert("Registration successful! Please log in.");
                        closeRegisterPopup();
                        showLoginPopup();
                    } else if (data === "email_exists") {
                        alert("This email is already registered.");
                    } else {
                        alert("Registration failed. Please try again later.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An unexpected error occurred.");
                });
        });
    }
});




// Open the login modal
function showLoginPopup() {
    const loginModal = document.getElementById("loginModal");
    loginModal.style.display = "flex";
    document.body.classList.add("modal-open");
  }
  
  // Close the login modal
  function closeLoginPopup() {
    const loginModal = document.getElementById("loginModal");
    loginModal.style.display = "none";
    document.body.classList.remove("modal-open");
  }
  
  // Open the register modal
  function showRegisterPopup() {
    const registerModal = document.getElementById("registerModal");
    registerModal.style.display = "flex";
    document.body.classList.add("modal-open");
  }
  
  // Close the register modal
  function closeRegisterPopup() {
    const registerModal = document.getElementById("registerModal");
    registerModal.style.display = "none";
    document.body.classList.remove("modal-open");
  }
  





document.addEventListener("DOMContentLoaded", () => {
    LoadNewArrivals();
    LoadProductById();
    LoadProductImage();
});






